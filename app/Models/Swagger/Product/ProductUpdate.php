<?php

namespace App\Models\Swagger\Product;

/**
 * @OA\Schema(schema="ProductUpdate")
 */
class ProductUpdate
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
