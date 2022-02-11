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

namespace App\Http\Controllers\MasterPengguna;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// Model
use App\User;
use App\Models\AdminDetail;
use App\Models\ModelHasRole;
use Spatie\Permission\Models\Role;

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

        $roles = Role::select('id', 'name')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'path',
            'roles'
        ));
    }

    public function api()
    {
        $pengguna = AdminDetail::all();

        return DataTables::of($pengguna)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='show(" . $p->id . ")' title='show data'><i class='icon icon-eye3 mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
            })
            ->editColumn('nama', function ($p) {
                return "<a href='" . route($this->route . 'edit', $p->id) . "' class='text-primary' title='Show Data'>" . $p->nama . "</a>";
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
            'nama'  => 'required|max:100',
            'email' => 'required|max:100|email|unique:admin_details,email',
            'no_telp' => 'required|max:20'
        ]);

        // Get Data
        $username = $request->username;
        $password = $request->password;
        $nama  = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;

        /* Tahapan : 
         * 1. admins
         * 2. admin_details
         * 3. model_has_roles
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

        // Tahap 3
        $path = 'app\User';
        $role_id = $request->role_id;

        $model_has_role = new ModelHasRole();
        $model_has_role->role_id = $role_id;
        $model_has_role->model_type = $path;
        $model_has_role->model_id = $admin->id;
        $model_has_role->save();

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
        $route = $this->route;
        $title = $this->title;
        $path  = $this->path;

        $pengguna = AdminDetail::find($id);
        $roles = Role::select('id', 'name')->get();

        return view($this->view . 'edit', compact(
            'route',
            'title',
            'path',
            'roles',
            'pengguna'
        ));
    }

    public function update(Request $request, $id)
    {
        $admin_detail = AdminDetail::find($id);

        $request->validate([
            'username' => 'required|max:50|unique:admins,username,' . $admin_detail->admin_id,
            'nama'  => 'required|max:100',
            'email' => 'required|max:100|email|unique:admin_details,email,' . $id,
            'no_telp' => 'required|max:20'
        ]);

        // Get Data
        $username = $request->username;
        $role_id  = $request->role_id;
        $nama  = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;

        /* Tahapan : 
         * 1. admins
         * 2. admin_details
         * 3. model_has_roles
         */

        //  Tahap 1
        $admin = User::find($admin_detail->admin_id);
        $admin->update([
            'username' => $username
        ]);

        // Tahap 2
        $admin_detail->update([
            'namae' => $nama,
            'email' => $email,
            'no_telp' => $no_telp
        ]);

        // Tahap 3
        $model_has_role = ModelHasRole::where('model_id', $admin_detail->admin_id);
        $model_has_role->update([
            'role_id' => $role_id
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil diperbaharui."
        ]);
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

    public function editPassword($id)
    {
        $route = $this->route;
        $title = $this->title;

        $admin = User::find($id);

        return view($this->view . 'editPassword', compact(
            'route',
            'title',
            'admin'
        ));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $admin = User::find($id);
        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
