<?php

namespace App\Models\Swagger\Store;

/**
 * @OA\Schema(schema="StoreUpdate")
 */
class StoreUpdate
{
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
