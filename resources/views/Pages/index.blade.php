@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Book Store 3CS
            </div>

            <div class="links">
                @foreach($cats as $cat)
                    <a href="/category/{{$cat->name}}">{{$cat->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection