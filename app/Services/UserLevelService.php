<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Date;

class UserLevelService
{

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
        //
    }

    /**
     * @param User $user
     * @return User
     */
    public function updateXp(User $user): User
    {
        $now = Date::now();
        $period = Date::createFromTimeString($user->last_request_at)->setSeconds(0)->diffInMinutes($now);

        if (intval($period) > 0) {
            $user->xp += (Config::get('xplevel.xp_per_minute') * intval($period));

            $this->updateLevel($user);
            $user->last_request_at = $now->toDateTimeString();
            $this->userRepository->save($user);
        }

        return $user;
    }

    /**
     * @param User $user
     * @return void
     */
    protected function updateLevel(User $user): void
    {
        $xpToNextLevel = $this->calculateXpToNextLevel($user);

        while ($user->xp >= $xpToNextLevel) {
            $user->level++;
            $user->xp -= $xpToNextLevel;
            $xpToNextLevel = $this->calculateXpToNextLevel($user);
        }
    }

    /**
     * @param User $user
     * @return int
     */
    protected function calculateXpToNextLevel(User $user): int
    {
        return intval(Config::get('xplevel.first_level_xp') *
            (Config::get('xplevel.exponential_factor') ** ($user->level - 1)));
    }
}