@extends('layouts.dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-4 mb-4">Modifica Post</h1>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titolo">Titolo Post</label>
                        <input type="text" name='title' class="form-control" id="titolo" placeholder="Scrivi il Titolo del post" value="{{old('title', $post->title)}}">
                    </div>
                    <div class="form-group">
                        <label for="testo">Testo Articolo</label>
                        <textarea type="text" name="content" class="form-control" id="testo" placeholder="Scrivi qualcosa"> {{ old('content', $post->content) }}</textarea>
                    </div>

                    {{-- <div class="form-group">
                        <label for="id">ID Matricola</label>
                        <input type="text" name='freshman_id' class="form-control" id="id" placeholder="Scrivi ID Matricola" value="{{old('freshman_id')}}">
                        @error('freshman_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Salva il Post</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection