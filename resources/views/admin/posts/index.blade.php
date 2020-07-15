@extends('layouts.dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mt-4 mb-4">Lista dei Post</h1>
                    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Inserisci Post</a>
                </div>
                <h1>Tutti i Post</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titolo Post</th>
                            <th>Slug</th>
                            <th>Categoria</th>
                            <th>Tags</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>
                                    {{ $post->category->name ?? '-'}}
                                    
                                    {{-- potevo usare anche questa funzione per verificare se ha o meno la categoria NULL --}}
                                    {{-- @if ($post->category)
                                        {{ $post->category->name }}
                                    @else
                                        {{ $post->category->name ?? '-'}}
                                    @endif --}}
                                    {{-- sotto, forma abbreviata della funzione "if" sopra --}}
                                    {{-- {{ $post->category ? $post->category->name : '-'}} --}}
                                </td>
                                <td>
                                    @forelse ($post->tags as $tag)
                                        {{$tag->name}}{{$loop->last ? '' : ','}}
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td>
                                <a class="btn btn-small btn-info" href="{{ route('admin.posts.show',['post'=> $post->id])}}">Dettaglio</a>
                                <a class="btn btn-small btn-warning" href="{{ route('admin.posts.edit', ['post'=> $post->id]) }}">Modifica</a>
                                <form class="d-inline" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-small btn-danger" value="Elimina">
                                </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Non ci sono ancora post</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection