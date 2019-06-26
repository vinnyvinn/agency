<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 4/26/18
 * Time: 5:06 AM
 */

namespace App\Http\Controllers;


use App\User;

class EslPolicy
{
    public static function auth()
    {
        return new self;
    }

    public function checkPermission(User $user, array $permission)
    {
        return $user->hasAccess($permission);
    }
}