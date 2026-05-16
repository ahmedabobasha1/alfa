<?php

namespace App\Helper;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Path
{
    public static function dashboardPath($path)
    {
        return asset('assets/dashboard/'.$path);
    }

    public static function dashboardImage()
    {
        return asset('assets/dashboard');
    }

    public static function css($file)
    {
        return asset('assets/website/css/'.$file);
    }

    public static function js($file)
    {
        return asset('assets/website/js/'.$file);
    }

    public static function imagesPath($image)
    {
        return asset('assets/website/images/'.$image);
    }

    public static function imgPath($image)
    {
        return asset('assets/website/img/'.$image);
    }

    public static function fontsPath($font)
    {
        return asset('assets/website/fonts/'.$font);
    }

    public static function uploadPath()
    {
        return asset('storage/uploads');
    }

    public static function noImagePath()
    {
        return asset('assets/dashboard/images/noimage.png');
    }

    public static function AppLogo($configKey = 'site_logo')
    {
        $file = config("configrations.{$configKey}");

        if ($file && filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }

        if ($file && \Illuminate\Support\Facades\Storage::disk('public')->exists("uploads/{$file}")) {
            return asset("storage/uploads/{$file}");
        }

        return self::noImagePath();
    }

    public static function FooterLogo($configKey = 'site_footer_logo')
    {
        $file = config("configrations.{$configKey}");

        if ($file && filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }

        if ($file && \Illuminate\Support\Facades\Storage::disk('public')->exists("uploads/{$file}")) {
            return asset("storage/uploads/{$file}");
        }

        return self::noImagePath();
    }

    public static function FavIcon($configKey = 'site_favicon')
    {
        $file = config("configrations.{$configKey}");

        if ($file && filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }

        if ($file && \Illuminate\Support\Facades\Storage::disk('public')->exists("uploads/{$file}")) {
            return asset("storage/uploads/{$file}");
        }

        return self::noImagePath();
    }

    public static function PreLoader($configKey = 'site_pre_loader')
    {
        $file = config("configrations.{$configKey}");

        if ($file && filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }
    }

    public static function lang()
    {
        return app()->getLocale();
    }

    public static function AppUrl($path = '/', $locale = null)
    {
        return LaravelLocalization::localizeUrl($path, $locale);
    }
}
