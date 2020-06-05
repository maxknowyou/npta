<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionHelper;
use App\Book;
use App\Borrow;
use App\Lost;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function changeLanguage($language){
        \Session::put('website_language', $language);
        return redirect()->back();
    }
    public function HomeGetInfo()
    {
        $book_active = Book::where('active', 1)->sum('total');
        $book_borrow = Borrow::where('active', 1)->where('status',1)->sum('amount');
        $book_lost = Lost::where('active', 1)->sum('amount');
        $book_total = $book_active + $book_borrow + $book_lost;
        $borrow = [];
        $lost = [];
        for ($i = 1; $i <= 12; $i++){
            
            array_push($borrow,(int)Borrow::whereMonth('from', '=', $i)->sum('amount') );
            array_push($lost,(int)Lost::whereMonth('time', '=', $i)->sum('amount'));
        }
        $json_data = array(
            "active"            => $book_active,
            "borrow"    => $book_borrow,
            "lost" =>  $book_lost,
            "total"            => $book_total,
            "borrowyear" => $borrow,
            "lostyear" => $lost
        );
        echo json_encode($json_data);
    }
}
