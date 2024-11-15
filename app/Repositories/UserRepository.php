<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    /**
     * Get cached list of users with id and name.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCachedUsers()
    {
        return Cache::remember('users_list', 3600, function () {
            return User::select('id', 'name')->get();
        });
    }
}
