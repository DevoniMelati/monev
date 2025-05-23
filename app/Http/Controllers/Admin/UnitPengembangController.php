<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class UnitPengembangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function read(){
        $unitpengembang = DB::table('unit_pengembang')->orderBy('id','ASC')->get(); // ASC agar urut

        return view('admin.unit_pengembang.index', [
            'unit_pengembang' => $unitpengembang
        ]);
    }

    public function add(){
        return view('admin.unit_pengembang.tambah');
    }

    public function create(Request $request){
         DB::table('unit_pengembang')->insert([
        'nama' => $request->nama,
        'created_at' => now(),
        ]);

        return redirect('/admin/unit_pengembang')->with("success", "Data Berhasil Ditambah !");
    }

    public function edit($id){
        $unitpengembang = DB::table('unit_pengembang')->where('id', $id)->first();

        return view('admin.unit_pengembang.edit', [
            'unit_pengembang' => $unitpengembang
        ]);
    }

    public function update(Request $request, $id) {
        DB::table('unit_pengembang')
        ->where('id', $id)
        ->update([
            'nama' => $request->nama,
            'updated_at' => now(),
            ]);

        return redirect('/admin/unit_pengembang')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('unit_pengembang')->where('id', $id)->delete();

        return redirect('/admin/unit_pengembang')->with("success", "Data Berhasil Dihapus !");
    }
}
