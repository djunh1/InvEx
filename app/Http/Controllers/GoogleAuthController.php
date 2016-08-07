<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

class GoogleAuthController extends Controller {

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/login');
        }

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

        return redirect()->route('home');
    }

    private function findOrCreateUser($googleUser)
    {
        $authUser = User::where('facebook_id', $googleUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        return User::Create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'avatar' => $googleUser->avatar
        ]);
    }

}
