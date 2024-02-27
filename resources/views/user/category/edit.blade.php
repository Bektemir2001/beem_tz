@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="header-action">
                    <i data-toggle="collapse" data-target="#form-element-1" aria-expanded="false">
                        <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </i>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse" id="form-element-1">
                    <div class="card">
                    </div>
                </div>
                <form action="{{route('categories.update', $category->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{route('categories.index')}}" class="btn bg-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.main')
@section('content')
@endsection
