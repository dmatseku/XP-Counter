<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TelegramAuthService
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
        //
    }

    /**
     * @param array $data
     * @return User
     * @throws AuthenticationException
     */
    public function getOrCreateUser(array $data): User
    {
        $name = $data['username'];
        $email = $data['username'] . '@mail.com';
        $password = Hash::make(Str::random(24));

        if (Config::get('telegram.token') != '') {
            if (!$this->validateTelegramUser($data)) {
                throw new AuthenticationException('Invalid telegram credentials');
            }
        }

        $user = $this->userRepository->getOrCreate($name, $email, $password);
        Auth::login($user, true);

        return $user;
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function validateTelegramUser(array $data): bool
    {
        //TODO: implement real telegram auth
        return true;
    }
}