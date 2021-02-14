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

namespace App\Http\Controllers\MasterUser;

use DataTables;

use App\Http\Controllers\Controller;

// Model
use App\Models\userPundi;

class UserController extends Controller
{
    protected $route = 'master-user.';
    protected $view  = 'pages.masterUser.';
    protected $title = 'User';
    protected $path  = 'images/ava/';

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
        $userPundi = userPundi::orderBy('id', 'DESC')->get();

        return DataTables::of($userPundi)
            ->addColumn('action', function ($p) {
                return "
                    <a href='#' onclick='show(" . $p->id . ")' title='show data'><i class='icon icon-eye3 mr-1'></i></a>
                    <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function show($id)
    {
        $userPundi = userPundi::find($id);

        return $userPundi;
    }

    public function destroy()
    {
        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil terhapus.'
        ]);
    }
}
