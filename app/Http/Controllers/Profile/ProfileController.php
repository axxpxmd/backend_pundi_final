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

namespace App\Http\Controllers\Profile;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

// Model
use App\User;
use App\Models\AdminDetail;

class ProfileController extends Controller
{
    protected $view  = 'pages.profile.';
    protected $path  = 'images/ava/';
    protected $title = 'Profile';
    protected $route = 'profile.';

    public function index()
    {
        $route = $this->route;
        $path  = $this->path;
        $title = $this->title;

        $adminDetail = AdminDetail::where('admin_id', Auth::user()->id)->first();

        return view($this->view . 'index', compact(
            'route',
            'path',
            'title',
            'adminDetail'
        ));
    }

    public function update(Request $request, $id)
    {
        $adminId = Auth::user()->id;
        $adminDetail = AdminDetail::findOrFail($id);

        $request->validate([
            'username'  => 'required|max:50|unique:admins,username,' . $adminId,
            'nama' => 'required|max:100',
            'email' => 'required|max:100|email|unique:admin_details,email,' . $id,
            'no_telp' => 'required|max:20'
        ]);

        // Get Data
        $username  = $request->username;
        $nama = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;

        /* Tahapan :
         * 1. admins
         * 2. admin_details
         */

        // Tahap 1
        User::where('id', $adminId)->update([
            'username' => $username
        ]);

        // Tahap 2
        if ($request->photo != null) {
            $request->validate([
                'photo' => 'required|max:2024|mimes:png,jpg,jpeg'
            ]);

            // Proses Saved Foto
            $file     = $request->file('photo');
            $fileName = time() . "." . $file->getClientOriginalName();
            $request->file('photo')->storeAs($this->path, $fileName, 'ftp', 'public');

            if ($adminDetail->photo != 'default.png') {
                // Proses Delete Foto
                $exist = $adminDetail->photo;
                $path  = "images/ava/" . $exist;
                Storage::disk('ftp')->delete($path);
            }

            $adminDetail->update([
                'nama' => $nama,
                'email' => $email,
                'no_telp' => $no_telp,
                'photo' => $fileName
            ]);
        } else {
            $adminDetail->update([
                'nama' => $nama,
                'email' => $email,
                'no_telp' => $no_telp,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }

    public function editPassword()
    {
        $route  = $this->route;
        $title  = $this->title;

        $userId = Auth::user()->id;

        return view($this->view . 'editPassword', compact(
            'route',
            'title',
            'userId'
        ));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $password = $request->password;

        User::where('id', $id)->update([
            'password' => Hash::make($password)
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
