<?php

namespace App\Http\Controllers;

use App\Helpers\AuthManager;
use App\Models\SystemUserGuard;
use App\Models\UserGuard;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $providerId = AuthManager::getProvider($request->input('providerId'));
        $system_user_guard = SystemUserGuard::whereKey($providerId)->first();
        if ($providerId && $system_user_guard) {
            $uid = $request->input('uid');
            $user_guard = UserGuard::whereGuardId($system_user_guard->id)->where('key', $uid)->first();
            if (is_null($user_guard)) {
                return [
                    'success' => False,
                    'error' => [
                        'code' => 'ACCOUNT_NOT_EXISTS',
                    ],
                ];
            }
            return [
                'success' => True,
            ];
        }
        return [
            'success' => False,
            'error' => [
                'code' => 'NOT_SUPPORT_PROVIDER',
            ]
        ];
    }
}
