<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use App\Models\userPundi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $route = '';
    protected $view  = 'pages.masterUser.';
    protected $title = 'user';
    protected $path  = 'images/ava';

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
        $userPundi = userPundi::all();

        return DataTables::of($userPundi)
            ->addColumn('action', function ($p) {
                return "
                    <a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
