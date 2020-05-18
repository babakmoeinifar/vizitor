<?php


namespace App\GraphQL\Types;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
      'name' => 'User',
      'description' => 'A User',
      'model' => User::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of User',
//                'alias' => 'user_id',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'name of User'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'email of User'
            ],
        ];
    }

}
