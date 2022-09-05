<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'config' => [
                'appName' => config('app.name'),
                'logo' => asset(env('APP_LOGO', 'assets/image/erp_logo.jpg')),
                'avatar' => asset(env('APP_AVATAR', 'assets/image/user2-160x160.jpg')),
            ],
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    resource_path('lang/' . app()->getLocale() . '.json')
                    // resource_path('lang/' . 'bn.json')
                );
            },
            'flash' => [
                'message' => session('message')
            ],
            'toast' => session('toast')
        ]);
    }
}
