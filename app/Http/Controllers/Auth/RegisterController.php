<?php

namespace App\Http\Controllers\Auth;

use App\Gelombang;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'hp' => ['required', 'string', 'max:50'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $gelombang = Gelombang::where('aktif', 'Y')->first();
        // dd($gelombang->mst_th_akademik_id);
        // dd($gelombang);
        $user = User::create([
            'nisn' => $data['nisn'],
            'telp' => $data['hp'],
            'asal_sekolah' => $data['asal_sekolah'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'th_akademik_id' => @$gelombang->mst_th_akademik_id,
            'pmb_gelombang_id' => @$gelombang->id,
            'biaya' => @$gelombang->biaya,
        ]);

        // Mail::to($user->email)->send(new MailNotify($user->email));
        try {
            //code...
            Mail::send('email.register_notify', [
                'nama' => $data['name'],
                'nisn' => $data['nisn'],
                'telp' => $data['hp'],
                'asal_sekolah' => $data['asal_sekolah'],
                'password' => $data['password'],
                'email' => $data['email'],
                'gelombang' => @$gelombang->gelombang,
            ], function ($message) use ($user) {
                $message->subject('Selamat Bergabung di Universitas Cahaya Bangsa');
                $message->from('noreply.youcb@gmail.com', 'PMB yoUCB');
                $message->to($user->email);
            });
        } catch (\Throwable $th) {
            //throw $th;
            // return response(['status' => false, 'errors' => $e->getMessage()]);
            return route('register');
        }

        return $user;
    }
}
