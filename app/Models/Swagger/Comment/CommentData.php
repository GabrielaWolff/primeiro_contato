<?php

namespace App\Models\Swagger\Comment;

/**
 * @OA\Schema(schema="CommentData")
 */
class CommentData
{
    /**
     * id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $id;

    /**
     * user_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $user_id;

    /**
     * article_id
     * @OA\Property(type="integer")
     * @var string
     */
    public $article_id;

    /**
     * product_id
     * @OA\Property(type="integer")
     * @var string
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
     * @var string
     */
    public $visible;

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

