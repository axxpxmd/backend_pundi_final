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

namespace App\Http\Controllers\MasterKomen;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Comment;

class KomenController extends Controller
{
    protected $route = 'komentar.';
    protected $title = 'Komentar';
    protected $view  = 'pages.komentar.';

    public function index()
    {
        $title = $this->title;
        $route = $this->route;

        return view($this->view . 'index', compact(
            'title',
            'route'
        ));
    }

    public function api()
    {
        $comment = Comment::all();

        return DataTables::of($comment)
            ->addColumn('action', function ($p) {
                if ($p->status == 1) {
                    return '-';
                } else {
                    return "<a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
                }
            })
            ->addColumn('name', function ($p) {
                return $p->userPundi->name;
            })
            ->addColumn('status', function ($p) {
                if ($p->status == 1) {
                    return '<span class="badge badge-danger">Ditarik</span>';
                } else {
                    return '-';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    public function destroy($id)
    {
        Comment::where('id', $id)->update([
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditarik.'
        ]);
    }
}
