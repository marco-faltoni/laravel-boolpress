@extends('layouts.dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    <h1 class="mt-4 mb-4">Dettagli del Post</h1>
                </div>

                <div class="card text-center">
                    <div class="card-body">
                    <h5 class="card-title"> <strong>Titolo:</strong> {{ $post->title }}</h5>
                    @if ($post->cover_image)
                    <div>
                        <img class="img-fluid" src="{{asset('storage/' . $post->cover_image)}}" alt="">
                    </div>
                    @else
                    
                    @endif
                    <p class="card-text"> <strong> Contenuto del post:</strong><br>{{ $post->content }}</p>
                    <p class="card-text"><strong>Slug:</strong>{{ $post->slug }}</p>
                    <p class="card-text"><strong>Categoria:</strong>{{ $post->category->name ?? '-'}}</p>
                    <p class="card-text"><strong>Tags:</strong>
                        @forelse ($post->tags as $tag)
                            {{$tag->name}}{{$loop->last ? '' : ','}}
                        @empty
                            -
                        @endforelse
                    </p>
                    <p class="card-text"><small class="text-muted">Creato il: <strong>{{ $post->created_at }}</strong></small></p>
                    <p class="card-text"><small class="text-muted">Ultima modifica: <strong>{{ $post->updated_at }}</strong></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection