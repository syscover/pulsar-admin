<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class FieldGroup
 * @package Syscover\Pulsar\Models
 */

class FieldGroup extends CoreModel
{
	protected $table        = 'field_group';
    protected $fillable     = ['id', 'name', 'resource_id'];
    public $timestamps      = false;
    public $with            = ['resource', 'fields'];

    private static $rules   = [
        'name'          => 'required|between:2,50',
        'resource_id'   => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('resource', 'field_group.resource_id', '=', 'resource.id')
            ->select('resource.*', 'field_group.*', 'resource.name as resource_name', 'field_group.name as field_group_name');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'field_group_id');
    }
}