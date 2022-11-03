<?php

namespace App\Models\Swagger\Article;

/**
 * @OA\Schema(schema="ArticleData")
 */
class ArticleData
{
    /**
     * user_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $user_id;

    /**
     * name
     * @OA\Property(type="string")
     * @var string
     */
    public $name;

    /**
     * slug
     * @OA\Property(type="string")
     * @var string
     */
    public $slug;

    /**
     * order
     * @OA\Property(type="string")
     * @var string
     */
    public $order;
}
