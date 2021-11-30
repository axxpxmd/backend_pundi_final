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

use Auth;
use DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;

class UnverifikasiController extends Controller
{
    protected $route = 'artikel.publish.';
    protected $view  = 'pages.masterArtikel.belumTerverifikasi.';
    protected $path  = '/images/ava/';
    protected $pathArticle = '/images/artikel/';
    protected $title = 'Publish Artikel';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path  = $this->path;

        $categorys = Category::select('id', 'n_category')->whereNotIn('id', [5])->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'path',
            'categorys'
        ));
    }

    public function api(Request $request)
    {
        // get param
        $category_id = $request->category_id;

        $article = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status', 'created_at')
            ->where('status', 0)
            ->orderBy('id', 'DESC')
            ->get();

        if ($category_id != 0) {
            $article = Article::select('id', 'title', 'author_id', 'category_id', 'sub_category_id', 'views', 'status', 'created_at')
                ->where('status', 0)
                ->where('category_id', $category_id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return DataTables::of($article)
            ->addColumn('action', function ($p) {
                return "
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
            ->addIndexColumn()
            ->rawColumns(['action', 'title'])
            ->toJson();
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;
        $path  = $this->path;
        $showEdit = 'true';

        $article = Article::find($id);

        $categorys = Category::select('id', 'n_category')->get();

        return view('pages.masterArtikel.show', compact(
            'route',
            'title',
            'path',
            'article',
            'showEdit',
            'categorys'
        ));
    }

    public function subCategoryByCategory($category_id)
    {
        $data = SubCategory::select('id', 'n_sub_category', 'category_id')->where('category_id', $category_id)->get();

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200|unique:articles,title,' . $id,
            'content' => 'required'
        ]);

        // get param
        $tag = $request->tag;
        $title = $request->title;
        $content = $request->content;
        $editor_id = $request->editor_id;
        $title_slug = str_slug($title, '-');

        $article = Article::where('id', $id)->first();

        if ($request->image != null) {
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg|max:2024'
            ]);

            // Saved Photo to Storage
            $file     = $request->file('image');
            $fileName = time() . "." . $file->getClientOriginalName();
            $request->file('image')->storeAs($this->pathArticle, $fileName, 'ftp', 'public');

            // Delete old Photo from Storage
            $exist = $article->image;
            if ($exist != null) {
                Storage::disk('ftp')->delete($this->pathArticle . $exist);
            }

            // Saved to articles
            $article->update([
                'title' => $title,
                'title_slug' => $title_slug,
                'content' => $content,
                'image' => $fileName,
                'tag' => $tag,
                'editor_id' => $editor_id
            ]);
        } else {
            $article->update([
                'title' => $title,
                'title_slug' => $title_slug,
                'tag' => $tag,
                'content' => $content,
                'editor_id' => $editor_id
            ]);
        }

        return redirect()
            ->route($this->route . 'show', $id)
            ->withSuccess('Selamat! Artikel berhasil diperbaharui.');
    }

    public function publish($id)
    {
        $data = Article::find($id);

        $time = Carbon::now();
        $release_date = $time->toDateTimeString();

        /**
         * * Check release_date, if null create release_date
         */
        if ($data->release_date == null) {
            $data->update([
                'status' => 1,
                'editor_id' => Auth::user()->id,
                'release_date' => $release_date
            ]);
        } else {
            $data->update([
                'status' => 1,
                'editor_id' => Auth::user()->id,
            ]);
        }

        return redirect()
            ->route($this->route . 'show', $id)
            ->withSuccess('Selamat! Artikel berhasil terpublish.');
    }

    public function unPublish($id)
    {
        Article::where('id', $id)->update([
            'status' => 0,
            'editor_id' => Auth::user()->id
        ]);

        return redirect()
            ->route($this->route . 'show', $id)
            ->withSuccess('Selamat! Artikel berhasil ditarik.');
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
