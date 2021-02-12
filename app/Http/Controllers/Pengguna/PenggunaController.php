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

// Model
use App\User;
use App\Models\AdminDetail;

class PenggunaController extends Controller
{
    protected $route = 'pengguna.';
    protected $view  = 'pages.pengguna.';
    protected $path  = 'images/ava/';
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
            ->editColumn('full_name', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Show Data'>" . $p->full_name . "</a>";
            })
            ->editColumn('admin_id', function ($p) {
                return $p->admin->username;
            })
            ->editColumn('photo',  function ($p) {
                return "<img width='50' class='img-fluid mx-auto d-block rounded-circle img-circular' alt='foto' src='" . $this->path . $p->photo . "'>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'full_name', 'photo'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'  => 'required|max:50|unique:admins,username',
            'password'  => 'required|min:8',
            'full_name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:admin_details,email',
            'phone' => 'required|max:20'
        ]);

        // Get Data
        $username = $request->username;
        $password = $request->password;
        $full_name = $request->full_name;
        $email = $request->email;
        $phone = $request->phone;

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
        $admin_detail->admin_id  = $admin->id;
        $admin_detail->full_name = $full_name;
        $admin_detail->email = $email;
        $admin_detail->phone = $phone;
        $admin_detail->photo = 'default.png';
        $admin_detail->save();

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function show($id)
    {
        $pengguna = AdminDetail::getDataPengguna($id);

        return $pengguna;
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
            \File::delete(public_path($path));
        }
        $adminDetail->delete();

        // Tahap 2
        User::whereid($adminDetail->admin_id)->delete();

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
