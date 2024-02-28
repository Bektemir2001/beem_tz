@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Er model</h4>
                </div>
                <div class="header-action">
                    <i  data-toggle="collapse" data-target="#images-1">
                        <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </i>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse" id="images-1">
                    <div class="card"></div>
                </div>

                <img src="{{asset('assets/er.png')}}" class="img-fluid rounded" alt="Responsive image">
            </div>
        </div>
    </div>
@endsection
