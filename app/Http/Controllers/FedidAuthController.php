<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Spatie\Permission\Models\Role;

class FedidAuthController extends Controller
{
    /**
     * Redirect the user of the application to the provider's authentication screen.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('fedid')->redirect();
    }

    /**
     * Get the user returned by provider (url callback)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request)
    {
        try {
            $fedidUser = Socialite::driver('fedid')->user();

        } catch (InvalidStateException $ex) {
            abort(503, 'Authentication Error');
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            abort(503, 'Connection to Decathlon network unavailable');
        }

        $user = User::firstOrCreate(
            ['uuid' => $fedidUser->uuid],
            [
                'uuid'          => $fedidUser->uuid,
                'uid'           => $fedidUser->uid,
                'name'          => $fedidUser->name,
                'email'         => $fedidUser->email,
                'country'       => $fedidUser->country,
                'manager_email' => $fedidUser->managermail,
                'photourl'      => $fedidUser->photourl,
                'jobname'       => $fedidUser->jobname,
                'token'         => $fedidUser->token,
                'password'      => Hash::make(Str::random(10)),
                //'allFedidInfo'  => json_encode($fedidUser->allFedidInfo),
            ]
        );

        $site_id = Site::where('site', $fedidUser->site)->get('id')->first();

        User::where('uuid', $user->uuid)
            ->update([
                'site_id'       => $site_id->id,
                'name'          => $fedidUser->name,
                'email'         => $fedidUser->email,
                'country'       => $fedidUser->country,
                'manager_email' => $fedidUser->managermail,
                'photourl'      => $fedidUser->photourl,
                'jobname'       => $fedidUser->jobname,
                'token'         => $fedidUser->token,
                //'allFedidInfo'  => json_encode($fedidUser->allFedidInfo),
            ]);

        if ( !$user->hasRole( Role::all() )){
            $user->assignRole('user');
        }

        Auth::login($user, false);

        return redirect()->route('welcome');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
