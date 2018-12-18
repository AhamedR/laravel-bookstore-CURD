@extends('layouts.app')

@section('content')

    <h1>Add a Books</h1>
    {!! Form::open(['action' => 'BookController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-row">
            <div class="form-group col-sm-9">
                {{Form::label('title','Name')}}
                {{Form::text('name','',['class'=>'form-control','placeholder'=>'Title of the Book'])}}
            </div>
            <div class="form-group col-sm-3">
                {{Form::label('title','ISBN')}}
                {{Form::number('isbn','',['class'=>'form-control','placeholder'=>'ISBN'])}}
            </div>
            <div class="form-group col-sm-3">
                {{Form::label('title','Year of Publish')}}
                {{Form::selectRange('year_p', 1990, 2018,'', array('class' => 'form-control '))}}
            </div>
            <div class="form-group col-sm-3">
                {{Form::label('title','Price')}}
                {{Form::number('price','',['class'=>'form-control ','placeholder'=>'Price'])}}
            </div>
            <div class="form-group  col-sm-3">
                {{Form::label('title','Medium')}}
                {{Form::select('medium', ['English' => 'English'
                , 'Sinhala' => 'Sinhala'
                , 'Tamil' => 'Tamil'
                , 'Hindi' => 'Hindi']
                , '', array('class' => 'form-control'))}}
            </div>
            <div class="form-group  col-sm-3">
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
                , '', array('class' => 'form-control'))}}
            </div>
            <div class="form-group  col-sm-12">
                {{Form::file('cover_image',['class' => 'btn-sm btn btn-outline-primary'])}}
            </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary '])}}
        </div>
    {!! Form::close() !!}
@endsection