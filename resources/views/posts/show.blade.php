@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">{{$post->title}}</h1>
            @if ($post->cover_image)
                <div>
                    <img class="img-fluid" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">
                </div>
            @endif
            <p>{{$post->content}}</p>
            <p>Categoria: 
                @if ($post->category)
                    <a href="{{route('categories.show', ['slug'=> $post->category->slug]) }}">
                        {{$post->category->name ?? '-'}}</p>
                    </a>
                @else
                    -
                @endif
                <p>Tags:
                    @forelse ($post->tags as $tag)
                        {{$tag->name}}{{$loop->last ? '' : ','}}
                    @empty
                        -
                    @endforelse
                </p>
        </div>
    </div>
</div>
@endsection
