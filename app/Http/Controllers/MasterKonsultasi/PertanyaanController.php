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

namespace App\Http\Controllers\MasterKonsultasi;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Question;

class PertanyaanController extends Controller
{
    protected $route = 'pertanyaan.';
    protected $title = 'Pertanyaan';
    protected $view  = 'pages.masterKonsultasi.pertanyaan.';

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
        $questions = Question::orderBy('id', 'DESC')->get();

        return DataTables::of($questions)
            ->editColumn('email', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Show Data'>" . $p->email . "</a>";
            })
            ->addColumn('status', function ($p) {
                if ($p->status == 1) {
                    return '<span class="badge badge-success">Sudah</span>';
                } else {
                    return '<span class="badge badge-danger">Belum</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'email'])
            ->toJson();
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = Question::find($id);

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data'
        ));
    }

    public function updateStatus($id)
    {
        $data = Question::find($id);
        $data->update([
            'status' => 1,
            'read_by' => Auth::user()->id
        ]);

        return redirect()
            ->route($this->route . 'show', $id)
            ->withSuccess('Selamat! Status berhasil diubah.');
    }
}
