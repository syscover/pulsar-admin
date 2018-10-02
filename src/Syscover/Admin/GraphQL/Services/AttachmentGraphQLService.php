<?php namespace Syscover\Admin\GraphQL\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Syscover\Admin\Models\Attachment;
use Syscover\Admin\Services\AttachmentService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;
use function GuzzleHttp\Psr7\mimetype_from_extension;

class AttachmentGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Attachment::class;
    protected $serviceClassName = AttachmentService::class;

    public function crop($root, array $args)
    {
        // encode stdClass to change to array
        $args['object'] = json_decode(json_encode($args['object']), true);


        // TODO: Manejar error 500 por llegar al límite de memoria (php_value memory_limit 256M)
        /**
         * config http://image.intervention.io with imagemagick
         */
        Image::configure(['driver' => 'imagick']);
        $image = Image::make($args['object']['attachment']['attachment_library']['base_path'] . '/' . $args['object']['attachment']['attachment_library']['file_name']);

        // set format from attachment family
        // TODO este if se puede hacer una función, código usado en AttachmentService line 345
        if(! empty($args['object']['attachment_family']['format']) && mimetype_from_extension($args['object']['attachment_family']['format']) !== $args['object']['attachment']['mime'])
        {
            $image = $image->encode($args['object']['attachment_family']['format'], 100); // set format image

            $args['object']['attachment']['file_name']  = basename($args['object']['attachment']['file_name'], '.' . $args['object']['attachment']['extension']) . '.' . $args['object']['attachment_family']['format'];
            $args['object']['attachment']['extension']  = $args['object']['attachment_family']['format']; // change extension file

            // change extension file of url
            $url = pathinfo($args['object']['attachment']['url']);
            $args['object']['attachment']['url']    = $url['dirname'] . '/' . $url['filename'] . '.' . $args['object']['attachment_family']['format'];
            // get mime type
            $args['object']['attachment']['mime']   = mimetype_from_extension($args['object']['attachment']['extension']);
        }


        // crop
        $image->crop($args['object']['crop']['width'], $args['object']['crop']['height'], $args['object']['crop']['x'], $args['object']['crop']['y']);

        // resize
        if($args['object']['attachment_family']['width'] === null || $args['object']['attachment_family']['height'] === null)
        {
            $image->resize($args['object']['attachment_family']['width'], $args['object']['attachment_family']['height'], function($constraint) {
                $constraint->aspectRatio(); // Constraint the current aspect-ratio of the image.
                $constraint->upsize(); // Keep image from being upsized.
            });
        }
        else
        {
            $image->resize($args['object']['attachment_family']['width'], $args['object']['attachment_family']['height']);
        }

        // save
        $image->save(
            $args['object']['attachment']['base_path'] . '/' . $args['object']['attachment']['file_name'],
            ! empty($args['object']['attachment_family']['quality']) ? 90 : $args['object']['attachment_family']['quality'] // set quality image
        );

        // get new properties from image cropped
        $args['object']['attachment']['width']  = $image->width();
        $args['object']['attachment']['height'] = $image->height();
        $args['object']['attachment']['size']   = $image->filesize();
        $args['object']['attachment']['data']   = ['exif' => collect($image->exif())->only(config('pulsar-core.exif_fields_allowed'))];

        return $args['object'];
    }

    public function delete($root, array $args)
    {
        $attachmentInput = $args['attachment'];

        if(
            ! empty($attachmentInput['id']) &&
            ! empty($attachmentInput['lang_id'])
        )
        {
            $attachment = Attachment::where('id', $attachmentInput['id'])
                ->where('lang_id', $attachmentInput['lang_id'])
                ->first();

            // delete attachment file
            File::delete($attachment->base_path . '/' . $attachment->file_name);

            // if has sizes, delete your files
            if(isset($attachment->data['sizes']))
            {
                foreach ($attachment->data['sizes'] as $size)
                    File::delete($size['base_path'] . '/' . $size['file_name']);
            }

            if(count(File::files($attachment->base_path)) === 0)
                // delete directory if has not any file
                File::deleteDirectory($attachment->base_path);


            // delete attachment from database
            Attachment::where('id', $attachment->id)
                ->where('lang_id', $attachment->lang_id)
                ->delete();

            return $attachment;
        }
        else
        {
            // delete attachment file, use properties from input,
            // because it may not to be created in database
            File::delete($attachmentInput['base_path'] . '/' . $attachmentInput['file_name']);
            File::delete($attachmentInput['attachment_library']['base_path'] . '/' . $attachmentInput['attachment_library']['file_name']);

            return $attachmentInput;
        }
    }
}