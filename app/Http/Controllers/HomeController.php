<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $books = DB::select('SELECT tblbooks.id,tblbooks.name,
                                      year_of_publish,
                                      amount,
                                      isbn,
                                      medium,
                                      image,
                                      users.name as userName,
                                      tblcatagories.name as catName
                                    FROM tblbooks,users,tblcatagories
                                    WHERE tblbooks.author_id=users.id 
                                    AND cat_id=tblcatagories.id AND tblbooks.author_id='.$user_id);

        return view('home')->with('books',$books);
    }
    public function getIndexDetails()
    {
        $cats = DB::select('SELECT tblcatagories.name 
                                    FROM tblcatagories');

        return view('Pages.index')->with('cats',$cats);
    }
}
