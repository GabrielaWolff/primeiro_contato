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
