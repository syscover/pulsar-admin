<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ActionInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'ActionInput',
        'description'   => 'Action that user can to do in application, this is for set permissions'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ]
        ];
    }
}