<?php

namespace App\Models\Swagger\Post;

/**
 * @OA\Schema(schema="PostData")
 */
class PostData
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
    
    /**
     * created_at
     * @OA\Property(type="string")
     * @var string
     */
    public $created_at;

    /**
     * update_at
     * @OA\Property(type="boolean")
     * @var string
     */
    public $update_at;
}
