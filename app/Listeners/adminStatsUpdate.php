<?php

namespace App\Listeners;

use App\Events\SessionExpired;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class adminStatsUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->guard == 'admin') {
            $user = $event->user;
            if ($user) {
                $user->status = 0;
                $user->save();
                Session::forget('admin');
                Session::flush();
            }
        }
    }
}
