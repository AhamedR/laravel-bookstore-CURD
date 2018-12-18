<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['category']]);
    }

    public function index()
    {
        $category = Input::get('search_query','ahamed');

        $query = "'%".$category."%'";
        $books_bookName = DB::select('SELECT tblbooks.id
                                    ,tblbooks.name
                                    ,author_id
                                    , year_of_publish
                                    , amount
                                    , isbn
                                    , medium
                                    , image
                                    , users.name as userName
                                    , tblcatagories.name as catName 
                                FROM tblbooks
                                    ,users
                                    ,tblcatagories 
                                WHERE tblbooks.author_id=users.id 
                                AND cat_id=tblcatagories.id 
                                AND tblbooks.name 
                                LIKE '.$query.' GROUP BY tblbooks.id');

        $books_author = DB::select('SELECT tblbooks.id
                                    ,tblbooks.name
                                    ,author_id
                                    , year_of_publish
                                    , amount
                                    , isbn
                                    , medium
                                    , image
                                    , users.name as userName
                                    , tblcatagories.name as catName 
                                FROM tblbooks
                                    ,users
                                    ,tblcatagories 
                                WHERE tblbooks.author_id=users.id 
                                AND cat_id=tblcatagories.id 
                                AND users.name 
                                LIKE '.$query.' GROUP BY tblbooks.id');

        $books = array_merge($books_bookName,$books_author);

        return view('book.search')->with('books',$books);

    }
    public function category($cat)
    {
        $books = DB::select('SELECT tblbooks.id
                                    ,tblbooks.name
                                    ,author_id
                                    , year_of_publish
                                    , amount
                                    , isbn
                                    , medium
                                    , image
                                    , users.name as userName
                                    , tblcatagories.name as catName 
                                FROM tblbooks
                                    ,users
                                    ,tblcatagories 
                                WHERE tblbooks.author_id=users.id 
                                AND cat_id=tblcatagories.id 
                                AND tblcatagories.name =  '."'".$cat."'".' GROUP BY tblbooks.id');
        if (count($books)>0)
        {
            return view('book.search')->with('books',$books);
        }
        else
            {
            return redirect('/book')->with('error','Books Not Found!');
        }

    }
}
