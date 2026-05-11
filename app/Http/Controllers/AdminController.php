<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function produk(){
        $path = storage_path('app/produk.json');
        $produk = file_exists($path)?json_decode(file_get_contents($path),true):[];
        return view('admin.produk', compact('produk'));
    }

    public function nego(){
        $path = storage_path('app/nego.json');
        $data = file_exists($path)?json_decode(file_get_contents($path),true):[];
        return view('admin.nego', compact('data'));
    }

    public function updateNego(Request $request,$id){
        $path = storage_path('app/nego.json');
        $data = json_decode(file_get_contents($path), true);

        foreach($data as &$n){
            if($n['id']==$id){

                if($request->aksi=='accept'){
                    $n['status']='accepted';
                    $n['tawaran_admin']=$n['tawaran_user'];
                }

                if($request->aksi=='reject'){
                    $n['status']='rejected';
                }

                if($request->aksi=='counter'){
                    $n['status']='counter';
                    $n['tawaran_admin']=$request->harga_admin;
                }
            }
        }

        file_put_contents($path,json_encode($data));
        return back();
    }

    public function laporan(){
        return view('admin.laporan');
    }
}