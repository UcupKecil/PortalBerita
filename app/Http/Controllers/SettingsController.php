<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->get();

        $data = [
            'settings' => $settings,
            'script'   => 'components.scripts.settings'
        ];

        return view('pages.settings', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('settings')->where('id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('settings')

            ->select([
                'settings.*'
            ])
            ->orderBy('settings.id', 'desc')->limit(1);

        return DataTables::of($data)
            ->editColumn(
                 'logo', //'favicon', 'foto',
                function($row) {
                    $data = [
                        'src' => $row->logo,
                        // 'favi' => $row->favicon,
                        // 'ft' => $row->foto
                    ];

                    return view('components.image', $data);
                }
            )

           ->editColumn(
            'favicon',
           function($row) {
               $data = [

                   'favi' => $row->favicon,
               ];

               return view('components.imagefavicon', $data);
           }
       )

                ->editColumn(
                'photo',
               function($row) {
                   $data = [

                       'ft' => $row->photo
                   ];

                   return view('components.imagefoto', $data);
               }
           )
            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.settings', $data);
                }
            )
            ->addIndexColumn()
            ->rawColumns(['logo'], ['favicon'], ['foto'])
            ->make(true);
    }

    public function edit(Request $request, $id)
    {

      $extension = $request->file('logo')->getClientOriginalExtension();
      $extension = $request->file('favicon')->getClientOriginalExtension();
      $extension = $request->file('photo')->getClientOriginalExtension();
      $logoEdit = date('YmdHis').'.'.$extension;
      $faviconEdit = date('YmdHis').'.'.$extension;
      $photoEdit = date('YmdHis').'.'.$extension;
      $path = base_path('public/photo_settings');
      $request->file('logoEdit')->move($path, $logoEdit);
      $request->file('faviconEdit')->move($path, $faviconEdit);
      $request->file('photoEdit')->move($path, $photoEdit);

        if($request->shortdes == NULL) {
            $json = [
                'msg'       => 'Mohon masukan deskripsi pendek',
                'status'    => false
            ];
        } elseif($request->addressedit == NULL) {
            $json = [
                'msg'       => 'Mohon pilih alamat',
                'status'    => false
            ];
        } elseif($request->notelp == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nomer telepon',
                'status'    => false
            ];
        }elseif($request->email == NULL) {
            $json = [
                'msg'       => 'Mohon masukan email',
                'status'    => false
            ];
        } elseif(strpos($request->email, '@') == false ){
            $json = [
                'msg'       => 'Mohon masukan format email',
                'status'    => false
            ];
        }elseif($request->layananedit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan layanan',
                'status'    => false
            ];
        } elseif($request->maps == NULL) {
            $json = [
                'msg'       => 'Mohon masukan peta',
                'status'    => false
            ];
        }else {
            try{
              DB::transaction(function() use($request, $id, $logoEdit, $faviconEdit, $photoEdit) {
                  DB::table('settings')->where('id', $id)->update([
                      'short_des' => $request->shortdes,
                      'logo' => $logoEdit,
                      'favicon' => $faviconEdit,
                      'photo' => $photoEdit,
                      'address' => $request->addressedit,
                      'phone' => $request->notelp,
                      'email' => $request->email,
                      'layanan' => $request->layananedit,
                      'maps' => $request->maps,
                      'updated_at' => date('Y-m-d H:i:s'),
                  ]);
              });

                $json = [
                    'msg' => 'Settings berhasil dirubah',
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

}
