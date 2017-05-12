<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class FieldValue
 * @package Syscover\Pulsar\Models
 */

class FieldValue extends CoreModel
{
	protected $table        = 'field_value';
    protected $fillable     = ['id', 'lang_id', 'field_id', 'counter', 'sort', 'featured', 'name', 'data_lang', 'data'];
    public $timestamps      = false;
    protected $casts        = [
        'featured'  => 'boolean',
        'data_lang' => 'array',
        'data'      => 'array'
    ];
    public $with            = ['lang'];

    private static $rules   = [
        'name'          => 'required|between:2,50',
        'field_id'      => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query;
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class, 'lang_id_027');
    }
}