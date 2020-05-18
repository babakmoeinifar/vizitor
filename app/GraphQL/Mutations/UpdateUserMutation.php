<?php


namespace App\GraphQL\Mutations;


use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserMutation extends Mutation
{

    protected $attributes = [
        'name' => 'updateUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:users,id'
            ],
            'name' => [
                'required', 'max:50'
            ],
            'password' => [
                'sometimes', 'string', 'min:8'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::findOrFail($args['id']);
        $user->fill($args);
        $user->save();

        return $user;
    }
}
