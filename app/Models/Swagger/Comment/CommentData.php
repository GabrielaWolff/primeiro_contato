<?php

namespace App\Models\Swagger\Comment;

/**
 * @OA\Schema(schema="CommentData")
 */
class CommentData
{
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
}
