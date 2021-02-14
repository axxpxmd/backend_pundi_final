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

namespace App\Http\Controllers\MasterKategori;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Category;

class KategoriController extends Controller
{
    protected $route = 'kategori.';
    protected $view  = 'pages.masterKategori.kategori.';
    protected $title = 'Kategori';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        return view($this->view . 'index', compact(
            'route',
            'title'
        ));
    }

    public function api()
    {
        $kategori = Category::all();

        return DataTables::of($kategori)
            ->addColumn('action', function ($p) {
                return "
                    <a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store()
    {
        return response()->json([
            'message' => 'Maaf tidak bisa menambah, Silahkan edit.'
        ], 422);
    }

    public function edit($id)
    {
        $kategori = Category::find($id);

        return $kategori;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'n_category' => 'required|max:50|unique:category,n_category,' . $id,
        ]);

        $kategori = Category::find($id);
        $kategori->update([
            'n_category' => $request->n_category
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
