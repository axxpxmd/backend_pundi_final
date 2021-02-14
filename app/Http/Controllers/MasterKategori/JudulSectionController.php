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
use App\Models\JudulSection;

class JudulSectionController extends Controller
{
    protected $route = 'judul-section.';
    protected $view  = 'pages.masterKategori.judulSection.';
    protected $title = 'Judul Section';

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
        $judulSection = JudulSection::all();

        return DataTables::of($judulSection)
            ->addColumn('action', function ($p) {
                return "<a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
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
        $judulSection = JudulSection::find($id);

        return $judulSection;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'card1' => 'required|max:50',
            'card2' => 'required|max:50',
            'card3' => 'required|max:50',
            'card4' => 'required|max:50'
        ]);

        $card1 = $request->card1;
        $card2 = $request->card2;
        $card3 = $request->card3;
        $card4 = $request->card4;

        $judulSection = JudulSection::find($id);
        $judulSection->update([
            'card1' => $card1,
            'card2' => $card2,
            'card3' => $card3,
            'card4' => $card4
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
