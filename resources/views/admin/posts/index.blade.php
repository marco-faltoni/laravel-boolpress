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
                                    <a class="btn btn-small btn-info" href="">Dettaglio</a>
                                    <a class="btn btn-small btn-warning" href="">Modifica</a>
                                    <a class="btn btn-small btn-danger" href="">Elimina</a>
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