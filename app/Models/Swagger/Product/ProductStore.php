<?php

namespace App\Models\Swagger\Product;

/**
 * @OA\Schema(schema="ProductStore")
 */
class ProductStore
{
    /**
     * store_id
     * @OA\Property(type="integer")
     * @var integer
     */
    public $store_id;

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
     * price
     * @OA\Property(type="number")
     * @var number
     */
    public $price;

    /**
     * amount
     * @OA\Property(type="integer")
     * @var integer
     */
    public $amount;
}
