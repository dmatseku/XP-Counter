<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function getOrCreate(string $name, string $email, string $password): User
    {
        return User::firstOrCreate([
            'email' => $email,
            'name' => $name
        ], [
            'password' => $password
        ]);
    }

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void
    {
        $user->save();
    }
}