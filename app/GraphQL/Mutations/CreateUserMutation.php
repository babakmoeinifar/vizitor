<?php


namespace App\GraphQL\Mutations;


use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function rules(array $args = []): array
    {
        return [
            'name' => [
                'required', 'max:50'
            ],
            'mobile' => [
                'required', 'digits:11', 'unique:users,mobile',
            ],
            'password' => [
                'required', 'string', 'min:8'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'mobile' => [
                'name' => 'mobile',
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
        $user = new User();
        $user->fill($args);
        $user->save();

        return $user;
    }

}
