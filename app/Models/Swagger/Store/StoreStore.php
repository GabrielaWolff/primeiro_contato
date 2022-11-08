<?php

namespace App\Models\Swagger\Store;

/**
 * @OA\Schema(schema="StoreData")
 */
class StoreData
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
     * description
     * @OA\Property(type="string")
     * @var string
     */
    public $description;
}
