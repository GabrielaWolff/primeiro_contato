<?php

namespace App\Models\Swagger\User;

/**
 * @OA\Schema(schema="UserUpdate")
 */
class UserUpdate
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
}
