<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $roles= DB::table('roles')->where('id', '!=', 1)
        ->get();

        $data = [
            'roles' => $roles,
        ];

        return view('forms.register', $data);

    }

    public function register(Request $request) {


        $rules = [
            'name'  => 'required',
            'email'     => 'required|email|unique:users',
            'role'   => 'required',
            'password'  => 'required|min:8',
        ];

        $message = [
            'name.required'     => 'Mohon isikan nama anda',
            'email.required'     => 'Mohon isikan email anda',
            'email.email'       => 'Mohon isikan email valid',
            'email.unique'      => 'Email sudah terdaftar',
            'role.required' => 'Mohon isikan role anda',
            'password.required' => 'Mohon isikan password anda',
            'password.min'      => 'Password wajib mengandung minimal 8 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'created_at'    => date('Y-m-d H:i:s')
                ]);

                $user->syncRoles($request->role);

            });

            return redirect()->to('/login');
        } catch(Exception $e) {
           dd($e);                                  //NOTE COBA ALIHKAN KE HALAMAN TIDAK BISA MASUK DATANYA BIAR NGGA DI DD
        }
    }

}
