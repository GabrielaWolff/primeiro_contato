<?php

namespace App\Models\Swagger\Tag;

/**
 * @OA\Schema(schema="TagData")
 */
class TagData
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
     * update_at
     * @OA\Property(type="boolean")
     * @var string
     */
    public $update_at;

    /**
     * created_at
     * @OA\Property(type="string")
     * @var string
     */
    public $created_at;

    /**
     * id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $id;

}
