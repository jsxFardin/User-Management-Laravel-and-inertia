<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait UserNameGenerator
{
    /**
     *  Max id should be unique to generate formated unique ID
     */
    public function getUserName($userName = null, $email)
    {
        if (is_null($userName)) {
            $userName = $email;
        }
        $output = $userName;
        if (Str::contains($userName, '@')) {
            $data = explode('@', $userName);
            $output = $data[0];
        }
        $user = User::where('username', $output)->first();
        if (!is_null($user)) {
            $output = $output . rand(10, 99);
        }
        return $output;
    }
}
