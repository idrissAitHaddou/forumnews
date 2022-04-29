<?php

namespace App\GraphQl\Types;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentType extends GraphQLType {


    protected $attributes = [
        'name'          => 'comment',
        'description'   => 'comment',
        'model'         => Comment::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of the comment',
            ],
            'comment' => [
                'type' => Type::string(),
                'description' => 'The comment',
            ]
            // ,
            // 'user_id' => [
            //     'type' => Type::string(),
            //     'description' => 'The id of the user',
            // ],
            // 'post_id' => [
            //     'type' => Type::string(),
            //     'description' => 'The id of the post',
            // ],
        ];
    }

}