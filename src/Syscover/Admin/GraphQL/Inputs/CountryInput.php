<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CountryInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Action',
        'description'   => 'Action that user can to do in application.'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of country'
            ],
            'lang_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'lang of country'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of country'
            ],
            'sort' => [
                'type' => Type::int(),
                'description' => 'Sort of country'
            ],
            'prefix' => [
                'type' => Type::int(),
                'description' => 'Prefix of country'
            ],
            'territorial_area_1' => [
                'type' => Type::string(),
                'description' => 'Territorial area 1 name of country'
            ],
            'territorial_area_2' => [
                'type' => Type::string(),
                'description' => 'Territorial area 2 name of country'
            ],
            'territorial_area_3' => [
                'type' => Type::string(),
                'description' => 'Territorial area 3 name of country'
            ],
            'zones' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'JSON string that contain enabled zones'
            ],
            'data_lang' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'JSON string that contain information about object translations'
            ]
        ];
    }
}