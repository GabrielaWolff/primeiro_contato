<?php

namespace App\Models\Swagger\Comment;

/**
 * @OA\Schema(schema="CommentStore")
 */
class CommentStore
{
    /**
     * user_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $user_id;

    /**
     * product_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $product_id;

    /**
     * body
     * @OA\Property(type="string")
     * @var string
     */
    public $body;

    /**
     * visible
     * @OA\Property(type="boolean")
     * @var boolean
     */
    public $visible;
}
