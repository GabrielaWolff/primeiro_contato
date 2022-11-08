<?php

namespace App\Models\Swagger\Tag;

/**
 * @OA\Schema(schema="TagUpdate")
 */
class TagUpdate
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

}
