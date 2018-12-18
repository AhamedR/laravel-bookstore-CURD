@extends('layouts.app')

@section('content')


@foreach($book as $b)
    <a href="/book" class="btn btn-outline-info btn-sm">Go Back</a>
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <img style="width:100%" src="/storage/cover_images/{{$b->image}}">
        </div>
        <div class="col-md-4 col-sm-4">
            <h1>{{$b->name}}</h1>
            <p>Author : {{$b->userName}}</p>
            <p>ISBN : {{$b->isbn}}</p>
            <p>Year of Publish : {{$b->year_of_publish}}</p>
            <p>Medium : {{$b->medium}}</p>
            <p>Category : {{$b->catName}}</p>
            <h3> Rs {{$b->amount}}</h3>
            <hr>
            @if(\Illuminate\Support\Facades\Auth::id()==$b->author_id)
            <div class="form-group">
                <a href="/book/{{$b->id}}/edit" class="btn btn-outline-primary">Edit</a>

                <button onclick="deleteConfirm()" class="btn btn-outline-danger ">Delete</button>
            </div>
            <div id="myDIV">
                {!! Form::open(['action' => ['BookController@destroy',$b->id],'method' => 'POST']) !!}
                {{Form::hidden('_method','DELETE')}}
                <div class="form-group">
                    {{Form::label('title','Are you sure, Do you want to delete this Book? ')}}
                    {{Form::submit('Yes Delete it!',['class'=>'btn btn-danger btn-sm'])}}
                </div>
                {!! Form::close() !!}
            </div>
        @endif
        </div>
    </div>

    <script>
        var a = document.getElementById("myDIV");
        a.style.display = "none";
        function deleteConfirm() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endforeach

@endsection