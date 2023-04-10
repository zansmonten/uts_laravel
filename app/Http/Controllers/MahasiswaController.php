<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;


class MahasiswaController extends Controller
{
    
    public function index(){
      $res = Http::get('http://localhost:1323/mahasiswa');

      $mahasiswa = $res->json();

      return view('VMahasiswa', ['mahasiswa' => $mahasiswa]);

    }

    public function tampilkan(){
        $res = Http::get('http://localhost:1323/mahasiswa');

        $mahasiswa = $res->json();

        return view('tablemahasiswa', ['mahasiswa' => $mahasiswa]);
    }

    public function tambah(Request $request){

        $request->validate(
          [
              'npm'=>'required',
              'nama'=>'required',
              'nohp'=>'required',
              'alamat'=>'required',
          ],
          [
              'npm.required'=>'NPM is Required *',
              'nama.required'=>'Nama is Required *',
              'nohp.required'=>'No HP is Required *',
              'alamat.required'=>'Alamat is Required *',
          ]
        );
        
        $res = Http::post('http://localhost:1323/mahasiswa', [
          'npm' => $request->npm,
			    'name' => $request->nama,
			    'phone' => $request->nohp,
			    'address' => $request->alamat,
        ]);

    }

    public function hapus(Request $request)
    {

    $res = Http::delete('http://localhost:1323/mahasiswa/' . $request->npm);
      
    }

    public function edit(Request $request)
    {
    	$request->validate(
        [
            'nama'=>'required',
            'nohp'=>'required',
            'alamat'=>'required',
        ],
        [
            'nama.required'=>'Nama is Required *',
            'nohp.required'=>'No HP is Required *',
            'alamat.required'=>'Alamat is Required *',
        ]
      );
      
      $res = Http::put('http://localhost:1323/mahasiswa/' . $request->npm, [
        'name' => $request->nama,
        'phone' => $request->nohp,
        'address' => $request->alamat,
      ]);
    }
}