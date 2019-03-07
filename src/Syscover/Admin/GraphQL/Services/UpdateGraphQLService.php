<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\VersionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        $packages = Package::where('active', true)->get();

        // check local versions
        foreach ($packages as $package)
        {
            if (! $package->version)
            {
                $package->version = package_version($package);
                $package->save();
            }
        }

        // call to api update
        $versions = VersionService::check($packages);

        // transform string to array
        $versions = json_decode($versions, true);

        return $versions['data'];
    }
}
