@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">{{$post->title}}</h1>
            <p>{{$post->content}}</p>
        </div>
    </div>
</div>
@endsection
