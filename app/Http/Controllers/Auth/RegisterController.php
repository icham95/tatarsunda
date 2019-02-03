<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\DetailUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['religions' => Religion::get()]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'no_induk' => ['required'],
            'location' => ['required'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'address' => ['required'],
            'the_village' => ['required'],
            'sub_district' => ['required'],
            'pkb' => ['required'],
            'zip_code' => ['required'],
            'job' => ['required'],
            'graduates' => ['required'],
            'contact' => ['required'],
            'purpose' => ['required'],
            'reference' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 2
        ]);

        $file = $data['avatar'];
        $extension = $file->getClientOriginalExtension();
        $filename = md5($user->id . time()) . '.' . $extension;
        $path = public_path() . '/uploads/images';
        // $upload = $file->move($path, $filename);

        $img = \Storage::disk('dropbox')->putFileAs('avatars', $file, $filename);
        $dropbox = \Storage::disk('dropbox')
            ->getDriver() // `\League\Flysystem\Flysystem` instance
            ->getAdapter() // `\Spatie\FlysystemDropbox\DropboxAdapter` instance
            ->getClient(); // `\Spatie\Dropbox\Client` instance
        $img = $dropbox->createSharedLinkWithSettings('avatars/' . $filename, [
            'requested_visibility' => 'public'
        ]);
        $url = str_replace('dl=0', 'raw=1', $img['url']);

        $detailUser = DetailUser::create([
            'no_induk' => $data['no_induk'],
            'location' => $data['location'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'religion_id' => $data['religion'],
            'address' => $data['address'],
            'the_village' => $data['the_village'],
            'sub_district' => $data['sub_district'],
            'pkb' => $data['pkb'],
            'zip_code' => $data['zip_code'],
            'job' => $data['job'],
            'graduates' => $data['graduates'],
            'contact' => $data['contact'],
            'purpose' => $data['purpose'],
            'reference' => $data['reference'],
            'user_id' => $user->id,
            'avatar' => $url,
        ]);

        // send notif to admin
        $admins = new User();
        $admins = $admins->where([
            'role' => 1
        ])->get();

        foreach ($admins as $admin) {
            \OneSignal::sendNotificationToUser(
                "User baru bernama " . $data['name'],
                $admin->onesignal_id,
                $url = \URL::to("/user/" . $user->id),
                $data = null,
                $buttons = null,
                $schedule = null
            );
        }

        return $user;
    }

        /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Auth::logout();
    }

}
