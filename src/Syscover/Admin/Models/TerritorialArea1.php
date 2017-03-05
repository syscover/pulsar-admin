<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea1
 * @package Syscover\Admin\Models
 */

class TerritorialArea1 extends CoreModel
{
    protected $table        = 'territorial_area_1';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'      => 'required|between:1,6|unique:001_003_territorial_area_1,id_003',
        'name'    => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule'])   static::$rules['id'] = 'required|between:1,6';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('country', 'territorial_area_1.country_id', '=', 'country.id')
            ->select('country.*','territorial_area_1.*','country.name as country_name', 'territorial_area_1.name as territorial_area_1_name');
    }

    public function territorialAreas2()
    {
        return $this->hasMany('Syscover\Admin\Models\TerritorialArea2', 'territorial_area_1_id');
    }
}