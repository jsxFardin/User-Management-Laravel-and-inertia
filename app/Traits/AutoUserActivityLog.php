<?php

namespace App\Traits;

use App\Models\UserActivityLog;
use Request;

trait AutoUserActivityLog
{

    public static function boot()
    {
        parent::boot();
        
        static::created(function (){
            if(auth()->check()):
                UserActivityLog::create([
                    'url'       => Request::fullUrl(),
                    'method'    => Request::method(),
                    'ip'        => Request::ip(),
                    'event'     => 'created',
                    'agent'     => Request::header('user-agent'),
                    'user_id'   => auth()->user()->id ?? null,
                ]);
            endif;
        });
        static::updated(function (){
            if(auth()->check()):
                UserActivityLog::create([
                    'url'       => Request::fullUrl(),
                    'method'    => Request::method(),
                    'ip'        => Request::ip(),
                    'event'     => 'updated',
                    'agent'     => Request::header('user-agent'),
                    'user_id'   => auth()->user()->id ?? null,
                ]);
            endif;
        });
    }

    public function userLogs($event)
    {
        if(auth()->check()):
            UserActivityLog::create([
                'url'       => Request::fullUrl(),
                'method'    => Request::method(),
                'ip'        => Request::ip(),
                'event'     => $event,
                'agent'     => Request::header('user-agent'),
                'user_id'   => auth()->user()->id ?? null,
            ]);
        endif;
    }
}