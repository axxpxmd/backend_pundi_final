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

namespace App\Http\Controllers\MasterGambar;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Poster;

class PosterController extends Controller
{
    protected $route = 'gambar.poster.';
    protected $view  = 'pages.masterGambar.poster.';
    protected $path  = '/images/poster/';
    protected $title = 'Poster';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;

        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $poster = Poster::all();

        return DataTables::of($poster)
            ->addColumn('action', function ($p) {
                return "<a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
            ->editColumn('poster',  function ($p) {
                return "<img width='100' class='mx-auto d-block rounded img-circular' alt='foto' src='" . config('app.ftp_src') . $this->path . $p->poster . "'>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'poster'])
            ->toJson();
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Maaf tidak bisa menambah, Silahkan edit.'
        ], 422);
    }

    public function edit($id)
    {
        $poster = Poster::select('id', 'poster')->where('id', $id)->first();

        return $poster;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'poster' => 'required|image|mimes:png,jpg,jpeg|max:1024'
        ]);

        $data = Poster::find($id);

        // Saved Photo to Storage
        $file     = $request->file('poster');
        $fileName = time() . "." . $file->getClientOriginalName();
        $request->file('poster')->storeAs($this->path, $fileName, 'ftp', 'public');

        // Delete old Photo from Storage
        $exist = $data->poster;
        if ($exist != null) {
            Storage::disk('ftp')->delete($this->path . $exist);
        }

        // Saved to posters
        $data->update([
            'poster' => $fileName
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
