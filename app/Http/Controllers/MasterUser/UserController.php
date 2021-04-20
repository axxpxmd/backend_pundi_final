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
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Article;
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

    public function destroy($id)
    {
        /* Tahapan : 
         * 1. users
         * 2. articles
         */

        // Tahap 1
        $user = userPundi::findOrFail($id);

        if ($user->photo != null) {
            // Proses Delete Foto
            $exist = $user->photo;
            $path  = "images/ava/" . $exist;
            Storage::disk('ftp')->delete($path);
        }

        // Tahap 2
        $articles = Article::where('author_id', $id)->get();

        if ($articles != null) {
            foreach ($articles as $i) {
                if ($i->image != null) {
                    // Proses Delete Foto
                    $exist = $i->image;
                    $path  = "images/artikel/" . $exist;
                    Storage::disk('ftp')->delete($path);

                    $articles = Article::where('id', $i->id)->delete();
                }
            }
        }

        // Tahap 1 (delete)
        $user->delete();

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil terhapus.'
        ]);
    }
}
