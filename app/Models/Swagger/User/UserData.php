<?php

namespace App\Models\Swagger\User;

/**
 * @OA\Schema(schema="UserData")
 */
class UserData
{
    /**
     * name
     * @OA\Property(type="string")
     * @var string
     */
    public $name;

    /**
     * email
     * @OA\Property(type="string")
     * @var string
     */
    public $email;

    /**
     * password
     * @OA\Property(type="string")
     * @var string
     */
    public $password;

    /**
     * image
     * @OA\Property(type="string")
     * @var string
     */
    public $image;

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