<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();

        if ($user->subscribed('default')) {
            return redirect('/profile')->with('info', 'Tev jau ir aktīvs AutoPlacis abonements.');
        }

        $checkout = $user->newSubscription('default', env('CASHIER_PLAN_AUTOPLACIS'))
            ->checkout([
                'success_url' => url('/subscription/success'),
                'cancel_url'  => url('/subscription/upgrade'),
            ]);

        return redirect($checkout->url);
    }

    public function success()
    {
        return redirect('/profile')->with('success', 'AutoPlacis abonements aktivizēts!');
    }

    public function upgrade()
    {
        return view('subscription.upgrade');
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();

        if ($user->subscribed('default')) {
            $user->subscription('default')->cancel();
        }

        return redirect('/profile')->with('success', 'Abonements atcelts. Tas paliks aktīvs līdz perioda beigām.');
    }
}
