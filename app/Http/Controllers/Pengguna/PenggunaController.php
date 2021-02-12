<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author Asip Hamdi
 * Github : axxpxmd
 */

namespace App\Http\Controllers\Pengguna;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// Model
use App\User;
use App\Models\AdminDetail;

class PenggunaController extends Controller
{
    protected $route = 'pengguna.';
    protected $view  = 'pages.pengguna.';
    protected $path  = '/images/ava/';
    protected $title = 'Pengguna';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path  = $this->path;

        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $pengguna = AdminDetail::all();

        return DataTables::of($pengguna)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>
                <a href='#' onclick='show(" . $p->id . ")' title='show data'><i class='icon icon-eye3 mr-1'></i></a>";
            })
            ->editColumn('nama', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Show Data'>" . $p->nama . "</a>";
            })
            ->editColumn('admin_id', function ($p) {
                return $p->admin->username;
            })
            ->editColumn('photo',  function ($p) {
                return "<img width='50' height='50' class='mx-auto d-block rounded-circle img-circular' alt='foto' src='" . config('app.ftp_src') . $this->path . $p->photo . "'>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama', 'photo'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50|unique:admins,username',
            'password' => 'required|min:8',
            'nama' => 'required|max:100',
            'email' => 'required|max:100|email|unique:admin_details,email',
            'no_telp' => 'required|max:20'
        ]);

        // Get Data
        $username = $request->username;
        $password = $request->password;
        $nama = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;

        /* Tahapan : 
         * 1. admins
         * 2. admin_details
         */

        // Tahap 1
        $admin = new User();
        $admin->username = $username;
        $admin->password = Hash::make($password);
        $admin->save();

        // Tahap 2
        $admin_detail = new AdminDetail();
        $admin_detail->admin_id = $admin->id;
        $admin_detail->nama = $nama;
        $admin_detail->email = $email;
        $admin_detail->no_telp = $no_telp;
        $admin_detail->photo = 'default.png';
        $admin_detail->save();

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function showDataModal($id)
    {
        $pengguna = AdminDetail::getDataPengguna($id);

        return $pengguna;
    }

    public function edit($id)
    {
        // 
    }

    public function destroy($id)
    {
        /* Tahapan : 
         * 1. admin_details
         * 2. admins
         */

        // Tahap 1
        $adminDetail = AdminDetail::findOrFail($id);

        if ($adminDetail->photo != 'default.png') {
            // Proses Delete Foto
            $exist = $adminDetail->photo;
            $path  = "images/ava/" . $exist;
            Storage::disk('ftp')->delete($path);
        }
        $adminDetail->delete();

        // Tahap 2
        User::whereid($adminDetail->admin_id)->delete();

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
