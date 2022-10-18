<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Egulias\EmailValidator\Validation\EmailValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use PharIo\Manifest\Email;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    public function index()
    {
        $roles= DB::table('roles')->where('id', '!=', 1)
        ->get();

        $data = [
            'roles' => $roles,
            'script'   => 'components.scripts.pengguna'
        ];

        return view('pages.pengguna', $data);

    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select([
                'users.*', 'roles.name as role'
            ])
            ->where('users.id', $id)
            ->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select([
                'users.*', 'roles.name as role'
            ])
            ->orderBy('users.id', 'desc');

        return DataTables::of($data)

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.pengguna', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data pengguna',
                'status'    => false
            ];

        } if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama pengguna',
                'status'    => false
            ];

        } elseif($request->email == NULL){
            $json = [
                'msg'       => 'Mohon masukan email pengguna',
                'status'    => false
            ];
        } elseif(strpos($request->email, '@') == false ){
            $json = [
                'msg'       => 'Mohon masukan format email',
                'status'    => false
            ];
        } elseif($request->role == NULL){
            $json = [
                'msg'       => 'Mohon masukan role pengguna',
                'status'    => false
            ];
        } elseif($request->password == NULL){
            $json = [
                'msg'       => 'Mohon masukan password pengguna',
                'status'    => false
            ];
        }
        else {


            try{

                DB::transaction(function() use($request) {
                    $user = User::create([
                        'name'          => $request->name,
                        'email'         => $request->email,
                        'password'      => Hash::make($request->password),
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);

                    $user->syncRoles($request->role);
                });

                $json = [
                    'msg' => 'Pengguna berhasil ditambahkan',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function edit(Request $request, $id)
    {
        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama pengguna',
                'status'    => false
            ];

        } elseif($request->email == NULL){
            $json = [
                'msg'       => 'Mohon masukan email pengguna',
                'status'    => false
            ];
        } elseif(strpos($request->email, '@') == false ){
            $json = [
                'msg'       => 'Mohon masukan format email',
                'status'    => false
            ];
        } else {
            try{

              DB::transaction(function () use ($request, $id) {
                $oldUser = User::where('id', $id)->first();

                $oldUser->roles()->detach();

                $user = User::where('id', $id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'updated_at'    => date('Y-m-d H:i:s')
                ]);

                $oldUser->syncRoles($request->role);

            });

                $json = [
                    'msg' => 'Pengguna berhasil dirubah',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function destroy($id)
    {

            try{

              DB::transaction(function() use($id) {
                  DB::table('users')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Pengguna berhasil dihapus',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }


        return Response::json($json);
    }


}
