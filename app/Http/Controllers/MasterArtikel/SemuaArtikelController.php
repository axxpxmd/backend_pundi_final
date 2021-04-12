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

namespace App\Http\Controllers\MasterArtikel;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Article;
use App\Models\Category;

class SemuaArtikelController extends Controller
{
    protected $route = 'artikel.semua.';
    protected $view  = 'pages.masterArtikel.semua.';
    protected $path  = '/images/ava/';
    protected $pathArticle = '/images/artikel/';
    protected $title = 'Artikel';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        $categorys = Category::select('id', 'n_category')->whereNotIn('id', [5])->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'categorys'
        ));
    }

    public function api(Request $request)
    {
        // get param
        $category_id = $request->category_id;

        $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
            ->orderBy('id', 'DESC')
            ->get();

        if ($category_id != 0) {
            $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
                ->where('category_id', $category_id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return DataTables::of($artikel)
            ->addColumn('action', function ($p) {
                return "
                    <a href='#' onclick='show(" . $p->id . ")' title='show data'><i class='icon icon-eye3 mr-1'></i></a>
                    <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>
                ";
            })
            ->editColumn('title', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Show Data'>" . $p->title . "</a>";
            })
            ->editColumn('author', function ($p) {
                return $p->author->name;
            })
            ->editColumn('category',  function ($p) {
                return $p->category->n_category;
            })
            ->editColumn('status',  function ($p) {
                if ($p->status == 1) {
                    return '<span class="badge badge-success">Sudah</span>';
                } else {
                    return '<span class="badge badge-danger">Belum</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'title', 'status'])
            ->toJson();
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;
        $path  = $this->path;
        $showEdit = 'false';

        $article = Article::find($id);
        // dd($article->author->photo);

        return view('pages.masterArtikel.show', compact(
            'route',
            'title',
            'path',
            'article',
            'showEdit'
        ));
    }
}
