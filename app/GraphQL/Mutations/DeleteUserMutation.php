<?php


namespace App\GraphQL\Mutations;


use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{

    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user'
    ];

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:users,id'
            ],
        ];
    }

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::findOrFail($args['id']);

        return  $user->delete() ? true : false;
    }
}
