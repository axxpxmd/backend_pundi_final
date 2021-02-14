<?php

namespace App\Http\Controllers\Kategori;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Category;
use App\Models\SubCategory;
use Spatie\Permission\Models\Role;

class SubKategoriController extends Controller
{
    protected $route = 'sub-kategori.';
    protected $view  = 'pages.masterKategori.subKategori.';
    protected $title = 'Sub Kategori';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        $categorys = Category::select('id', 'n_category')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'categorys'
        ));
    }

    public function api()
    {
        $subKategori = SubCategory::all();

        return DataTables::of($subKategori)
            ->addColumn('action', function ($p) {
                return "
                    <a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
            ->editColumn('category_id', function ($p) {
                return $p->category->n_category;
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
        $subKategori = SubCategory::find($id);

        return $subKategori;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'n_sub_category' => 'required|max:50|unique:sub_category,n_sub_category,' . $id,
            'category_id' => 'required'
        ]);

        $category_id = $request->category_id;
        $n_sub_category = $request->n_sub_category;

        $subKategori = SubCategory::find($id);
        $subKategori->update([
            'n_sub_category' => $n_sub_category,
            'category_id' => $category_id
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
