<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BookController extends Controller
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
     * Display a listing of the Books.
     */
    public function index()
    {
        $books = DB::select('SELECT tblbooks.id,tblbooks.name,author_id,
                                      year_of_publish,
                                      amount,
                                      isbn,
                                      medium,
                                      image,
                                      users.name as userName,
                                      tblcatagories.name as catName
                                    FROM tblbooks,users,tblcatagories
                                    WHERE tblbooks.author_id=users.id 
                                    AND cat_id=tblcatagories.id');

        //var_dump($books);

        return view('book.index')->with('books',$books);
    }

    /**
     * Show the form for adding a new Book.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created Book in Database.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
            'year_p'=>'required',
            'price'=>'required|between:0,999999.99',
            'isbn'=>'required',
            'medium'=>'required',
            'category'=>'required',
            'isbn'=>'unique:tblbooks,isbn|digits_between:10,13',
            'cover_image' => 'image|nullable|max:19999'
        ]);

        //handle upload
        if ($request->hasFile('cover_image'))
        {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'no_image.jpg';
        }


        $book = new Book;
        $book->name = $request->input('name');
        $book->year_of_publish = $request->input('year_p');
        $book->amount = $request->input('price');
        $book->isbn = $request->input('isbn');
        $book->medium = $request->input('medium');
        $book->amount = $request->input('price');
        $book->author_id = Auth::id();
        $book->image = $fileNameToStore;
        $book->cat_id = $request->input('category');
        $book->save();

        return redirect('/book')->with('success','Book Added!!!');
    }

    /**
     * Display the specified Book.
     *
     */
    public function show($id)
    {
        $book = DB::select('SELECT tblbooks.id,tblbooks.name,author_id,
                                      year_of_publish,
                                      amount,
                                      isbn,
                                      medium,
                                      image,
                                      users.name as userName,
                                      tblcatagories.name as catName
                                    FROM tblbooks,users,tblcatagories
                                    WHERE tblbooks.author_id=users.id 
                                    AND cat_id=tblcatagories.id AND tblbooks.id='.$id);

        if (sizeof($book) > 0 )
        {
            return view('book.show')->with('book',$book);
        }
        else
        {
            return redirect('/book')->with('error','Book Does not exist!');
        }

    }

    /**
     * Show the form for editing the specified Book.
     *
     */
    public function edit($id)
    {
        $book = DB::select('SELECT tblbooks.id,tblbooks.name,author_id,
                                      year_of_publish,
                                      amount,
                                      isbn,
                                      medium,
                                      image,
                                      users.name as userName,
                                      tblcatagories.id as cate_id
                                    FROM tblbooks,users,tblcatagories
                                    WHERE tblbooks.author_id=users.id 
                                    AND cat_id=tblcatagories.id AND tblbooks.id='.$id);

       $check = Book::where('author_id',Auth::id())->first();


        if (sizeof($book) > 0 && $check->author_id == Auth::id())
        {
           return view('book.edit')->with('book',$book);
        }
        else
        {
            return redirect('/book')->with('error','Book Does not exist!');
        }
    }

    /**
     * Update the specified Book in Database.
     *
     */
    public function update(Request $request, $id)
    {


        $this->validate($request,[
            'name'=>'required',
            'year_p'=>'required',
            'price'=>'required|between:0,999999.99',
            'isbn'=>'required',
            'medium'=>'required',
            'category'=>'required',
            'isbn'=> Rule::unique('tblbooks')->ignore('1','isbn'),
            'isbn'=>'digits_between:10,13',
            'cover_image' => 'image|nullable|max:19999'
        ]);

        //handle upload
        if ($request->hasFile('cover_image'))
        {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        $book = Book::find($id);
        $book->name = $request->input('name');
        $book->year_of_publish = $request->input('year_p');
        $book->amount = $request->input('price');
        $book->isbn = $request->input('isbn');
        $book->medium = $request->input('medium');
        $book->amount = $request->input('price');
        if ($request->hasFile('cover_image')) {
            $book->image = $fileNameToStore;
        }
        $book->cat_id = $request->input('category');
        $book->save();

        return redirect('/book')->with('success','Book Updated!!!');
    }

    /**
     * Remove the specified Book from Database.
     *
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $check = Book::where('author_id',Auth::id())->first();

        if ($check->author_id == Auth::id()) {
            if ($book->cover_image != 'no_image.jpg') {
                Storage::delete('public/storage/cover_images/' . $book->cover_image);
            }

            $book->delete();
            return redirect('/book')->with('success', 'Book Deleted!!!');
        }
    }

}
