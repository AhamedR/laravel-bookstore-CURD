@extends('layouts.app')

@section('content')

    <h1>Search Result </h1>

    @if(count($books) > 0)
        @foreach($books as $book)

            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$book->image}}">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h4 class="card-title">{{$book->name}} | <small style="color: #1d68a7">{{$book->medium}}</small></h4>
                            <small>Author</small>
                            <p class="card-text">{{$book->userName}}</p>
                            <small>ISBN</small>
                            <p class="card-text">{{$book->isbn}}</p>
                            <small>Year of Publish</small>
                            <p class="card-text">{{$book->year_of_publish}}</p>
                            <h5><strong>Rs {{$book->amount}}</strong></h5>
                            <a href="/book/{{$book->id}}" class="btn btn-outline-primary">view</a>
                        </div>
                    </div>

                </div>
            </div>
            <br>

        @endforeach
    @else
        <p>No Books Found!</p>
    @endif
@endsection