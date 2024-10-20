<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function getOrCreate(string $name, string $email, string $password): User;

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;
}