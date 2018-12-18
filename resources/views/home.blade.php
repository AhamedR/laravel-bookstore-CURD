@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Books</h3>
                    @if(count($books)>0)
                    <table class="table table-striped">
                        <tr>

                            <th>
                                Title
                            </th>
                            <th>ISBN</th>
                            <th></th>
                        </tr>
                        @foreach($books as $book)
                            <tr>

                                <td>
                                    {{$book->name}}
                                </td>
                                <td>
                                    {{$book->isbn}}
                                </td>
                                <td><a href="/book/{{$book->id}}" class="btn btn-outline-primary">Manage Book</a> </td>

                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>No Books Added yet!!</p>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
