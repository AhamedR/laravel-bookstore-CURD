@extends('layouts.app')

@section('content')
    <h2>Update Book : {{$book[0]->name}}</h2>
    <hr>
    {!! Form::open(['action' => ['BookController@update',$book[0]->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-row">

        <div class="col-sm-4 col-md-4">
            <div class="col-md-12 col-sm-12">
                <img style="width:100%" src="/storage/cover_images/{{$book[0]->image}}">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group col-sm-12">
                {{Form::label('title','Name')}}
                {{Form::text('name',$book[0]->name,['class'=>'form-control','placeholder'=>'Title of the Book'])}}
            </div>
            <div class="form-group col-sm-12">
                {{Form::label('title','ISBN')}}
                {{Form::number('isbn',$book[0]->isbn,['class'=>'form-control','placeholder'=>'ISBN'])}}
            </div>
            <div class="form-group col-sm-12">
                {{Form::label('title','Year of Publish')}}
                {{Form::selectRange('year_p', 1990, 2018,$book[0]->year_of_publish, array('class' => 'form-control '))}}
            </div>

            <div class="form-group col-sm-12">
                {{Form::label('title','Price')}}
                {{Form::number('price',$book[0]->amount,['class'=>'form-control ','placeholder'=>'Price'])}}
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group  col-sm-12">
                {{Form::label('title','Medium')}}
                {{Form::select('medium', ['English' => 'English'
                , 'Sinhala' => 'Sinhala'
                , 'Tamil' => 'Tamil'
                , 'Hindi' => 'Hindi']
                , $book[0]->medium, array('class' => 'form-control'))}}
            </div>
            <div class="form-group  col-sm-12">
                {{Form::label('title','Category')}}
                {{Form::select('category',
                ['6' => 'Action and adventure'
                , '7' => 'Anthology'
                , '8' => 'Art'
                , '9' => 'Graphic novel'
                , '10' => 'Romance'
                , '11' => 'Thriller'
                , '12' => 'Science fiction'
                , '13' => 'History']
                , $book[0]->cate_id, array('class' => 'form-control'))}}

            </div>
            <div class="form-group  col-sm-12">
                {{Form::file('cover_image',['class' => 'btn-sm btn btn-block btn-outline-primary'])}}
            </div>
            <div class="form-group  col-sm-12">
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit',['class'=>'btn btn-outline-primary'])}}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection