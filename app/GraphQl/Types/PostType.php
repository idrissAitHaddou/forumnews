<?php

namespace App\GraphQl\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType {


    protected $attributes = [
        'name'          => 'Post',
        'description'   => 'Post',
        'model'         => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of the user',
            ],
            'user_id' => [
                'type' => Type::string(),
                'description' => 'The id of the user',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The id of the user',
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'The id of the user',
            ],
        ];
    }

}