<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class AplikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function read(){
        $aplikasi = DB::table('aplikasi')->orderBy('id','DESC')->get();

        return view('admin.aplikasi.index',['aplikasi'=>$aplikasi]);
    }

    public function add(){
        $pj = DB::table('users')->where('level','2')->orderBy('name')->get();
        $programmer = DB::table('users')->where('level','3')->orderBy('name')->get();
        return view('admin.aplikasi.tambah',['programmer'=>$programmer,'pj'=>$pj]);
    }

    public function create(Request $request){
        DB::table('aplikasi')->insert([  
            'nama' => $request->nama,
            'url' => $request->url,
            'username' => $request->username,
            'password' => $request->password,
            'status' => in_array($request->status, ['Aman', 'Maintenance', 'Rusak']) ? $request->status : 'Aman',
            'programmer' => $request->programmer,
            'pj' => $request->pj
        ]);

        return redirect('/admin/aplikasi')->with("success","Data Berhasil Ditambah !");
    }

    public function edit($id){
        $aplikasi = DB::table('aplikasi')->where('id',$id)->first();
        $pj = DB::table('users')->where('level','2')->orderBy('name')->get();
        $programmer = DB::table('users')->where('level','3')->orderBy('name')->get();
        
        return view('admin.aplikasi.edit',['aplikasi'=>$aplikasi,'programmer'=>$programmer,'pj'=>$pj]);
    }

    public function update(Request $request, $id) {
        DB::table('aplikasi')  
            ->where('id', $id)
            ->update([
            'nama' => $request->nama,
            'url' => $request->url,
            'username' => $request->username,
            'password' => $request->password,
            'status' => in_array($request->status, ['Aman', 'Maintenance', 'Rusak']) ? $request->status : 'Aman',
            'programmer' => $request->programmer,
            'pj' => $request->pj
        ]);

        return redirect('/admin/aplikasi')->with("success","Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('aplikasi')->where('id',$id)->delete();

        return redirect('/admin/aplikasi')->with("success","Data Berhasil Dihapus !");
    }
}
