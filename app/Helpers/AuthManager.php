<?php

namespace App\Helpers;

class AuthManager
{
    public const GOOGLE_PROVIDER = 'google';
    public const FACEBOOK_PROVIDER = 'facebook';

    protected static function getProviders()
    {
        return [static::GOOGLE_PROVIDER, static::FACEBOOK_PROVIDER];
    }

    public static function getProvider($providerId)
    {
        if (array_search($providerId, static::getProviders()) !== false) {
            return $providerId;
        }
        switch ($providerId) {
            case 'google.com':
                return static::GOOGLE_PROVIDER;
            case 'facebook.com':
                return static::FACEBOOK_PROVIDER;
        }
    }
}
