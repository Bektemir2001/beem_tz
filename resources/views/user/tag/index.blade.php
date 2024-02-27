@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>Tags</h2>
            <a href="{{route('tags.create')}}" class="btn btn-primary">add</a>
        </div>

        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->name}}</td>
                        <td>
                            <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-success">edit</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
