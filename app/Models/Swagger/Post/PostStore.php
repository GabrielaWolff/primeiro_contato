<?php

namespace App\Models\Swagger\Post;

/**
 * @OA\Schema(schema="PostStore")
 */
class PostStore
{
    /**
     * user_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $user_id;

    /**
     * title
     * @OA\Property(type="string")
     * @var string
     */
    public $title;

    /**
     * content
     * @OA\Property(type="string")
     * @var string
     */
    public $content;

    /**
     * tags
     * @OA\Property(type="string")
     * @var string
     */
    public $tags;
}
