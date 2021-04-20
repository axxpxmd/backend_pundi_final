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
use Illuminate\Support\Facades\Storage;

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
        $status = $request->status;

        $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
            ->orderBy('id', 'DESC')
            ->get();

        if ($category_id != 0) {
            $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
                ->where('category_id', $category_id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        if ($status != 99) {
            $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
                ->where('status', $status)
                ->orderBy('id', 'DESC')
                ->get();
            if ($status != 99 && $category_id != 0) {
                $artikel = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status')
                    ->where('status', $status)
                    ->where('category_id', $category_id)
                    ->orderBy('id', 'DESC')
                    ->get();
            }
        }

        return DataTables::of($artikel)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
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

        return view('pages.masterArtikel.show', compact(
            'route',
            'title',
            'path',
            'article',
            'showEdit'
        ));
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete old Photo from Storage
        $exist = $article->image;
        if ($exist != null) {
            Storage::disk('ftp')->delete($this->pathArticle . $exist);
        }

        // delete from table
        $article->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus.'
        ]);
    }
}
