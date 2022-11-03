<?php

namespace App\Models\Swagger\Comment;

/**
 * @OA\Schema(schema="CommentUpdateResponse")
 */
class CommentUpdateResponse
{
    /**
     * product_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $product_id;

    /**
     * user_id
     * @OA\Property(type="integer")
     * @var string
     */
    public $user_id;

    /**
     * article_id
     * @OA\Property(type="integer")
     * @var string
     */
    public $article_id;

    /**
     * body
     * @OA\Property(type="string")
     * @var string
     */
    public $body;
}