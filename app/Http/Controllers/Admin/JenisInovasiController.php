<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class JenisInovasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function read(){
        $jenisinovasi = DB::table('jenis_inovasi')->orderBy('id','DESC')->get();

        return view('admin.jenis_inovasi.index',['jenis_inovasi'=>$jenisinovasi]);
    }

    public function add(){
        return view('admin.jenis_inovasi.tambah');
    }

    public function create(Request $request){
        DB::table('jenis_inovasi')->insert([  
            'nama' => $request->nama]);

        return redirect('/admin/jenis_inovasi')->with("success","Data Berhasil Ditambah !");
    }

    public function edit($id){
        $jenisinovasi = DB::table('jenis_inovasi')->where('id',$id)->first();
        return view('admin.jenis_inovasi.edit',['jenis_inovasi'=>$jenisinovasi]);
    }

    public function update(Request $request, $id) {
        DB::table('jenis_inovasi')  
            ->where('id', $id)
            ->update([
            'nama' => $request->nama]);

        return redirect('/admin/jenis_inovasi')->with("success","Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('jenis_inovasi')->where('id',$id)->delete();

        return redirect('/admin/jenis_inovasi')->with("success","Data Berhasil Dihapus !");
    }
}
