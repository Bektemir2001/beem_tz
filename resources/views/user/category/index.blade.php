@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>Categories</h2>
            <a href="{{route('categories.create')}}" class="btn btn-primary">add</a>
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
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-success">edit</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
