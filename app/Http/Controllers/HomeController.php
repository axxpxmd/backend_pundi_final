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

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

// Models
use App\Models\Article;
use App\Models\CheckIp;
use App\Models\Comment;
use App\Models\Question;
use App\Models\userPundi;
use App\Models\Consultation;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Time
        $time  = Carbon::now();
        $date  = $time->toDateString();
        $month = $time->month;
        $day = Carbon::today();

        $categoryTotal = DB::select('SELECT category.n_category, COUNT(articles.category_id) as totalArtikel FROM articles,category WHERE articles.category_id = category.id GROUP BY category.n_category');
        $userTotal = userPundi::count();
        $commentTotal = Comment::count();
        $questionTotal = Question::count();
        $consultationTotal = Consultation::count();

        $ulasanTotal = Article::wherecategory_id(1)->count();
        $kajianTotal = Article::wherecategory_id(2)->count();
        $kreativitasTotal = Article::wherecategory_id(3)->count();
        $serbaserbiTotal = Article::wherecategory_id(4)->count();

        $totalView = Article::select('id', 'title', 'views')->orderBy('views', 'DESC')->get()->take(5);
        $todayTotalView = CheckIp::select('*', DB::raw("count(article_id) as totalView"))
            ->whereDate('created_at', $day)
            ->groupBy('article_id')
            ->orderBy('totalView', 'DESC')
            ->get();
        $monthTotalView = CheckIp::select('*', DB::raw("count(article_id) as totalView"))
            ->whereRaw('extract(month from created_at) = ?', [$month])
            ->groupBy('article_id')
            ->orderBy('totalView', 'DESC')
            ->get();

        $totalArticle = Article::count();
        $totalViewAll = Article::select('views')->sum('views');

        return view('home', compact(
            'categoryTotal',
            'userTotal',
            'commentTotal',
            'questionTotal',
            'consultationTotal',
            'ulasanTotal',
            'kajianTotal',
            'kreativitasTotal',
            'serbaserbiTotal',
            'todayTotalView',
            'monthTotalView',
            'totalView',
            'totalArticle',
            'totalViewAll'
        ));
    }
}
