<?php


namespace App\GraphQL\Queries;


use App\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphqlType;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use Closure;


class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user'
    ];

    public function type(): GraphqlType
    {
        return GraphQL::type('User');
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => ['required', 'numeric', 'min:1', 'exists:users,id'],
        ];
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        return User::findOrFail($args['id']);
    }
}
