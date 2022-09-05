<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;

trait UniqueIdGenerator
{
    /**
     *  Max id should be unique to generate formated unique ID
     */
    public function getUniqueID($max_id = null, $length = 4,  $prefix = '', $pad = '0', $is_right = false)
    {
        if ($max_id == null || $max_id >= 0) :
            $max_id = (int)$max_id;
            $max_id++;
        else :
            $max_id = random_int(0, 999);
        endif;
        $prefix = $prefix != '' ? $prefix : '';
        return $prefix . str_pad($max_id, $length, $pad, $is_right);
    }

    public function getUserId($role)
    {
        $maxId = User::max('id');
        $prefix = '';
        if (!is_null($role)) {
            $prefix = 'AD';
            $newRole = gettype($role) == 'array' ? $role[0] : $role;
            if ($newRole != 1) {
                $userRole = Role::find($newRole);
                $prefix = substr($userRole->name, 0, 2);
            }
        }
        return $this->getUniqueID($maxId, 6, $prefix);
    }
}
