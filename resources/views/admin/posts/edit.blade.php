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
                <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
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

                    <div class="form-group">
                        <label for="images">Immagine di Copertina</label>
                        <input type="file" name="image" class="form-control-file">
                        @if ($post->cover_image)
                            <p><strong>Copertina Attuale</strong></p>
                            <img class="img-fluid" src="{{asset('storage/' . $post->cover_image)}}" alt="">
                        @else
                            <p>Copertina non presente</p>
                        @endif
                        
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select class="form-control" id="categoria" name="category_id">
                            <option value="">Seleziona Categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" 
                                    {{(old('category_id', ($post->category->id ?? '')) == $category->id ? 'selected' : '')}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="inlineCheckbox1">
                                    <input
                                    @if ($errors->any())
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                                    @else
                                        {{$post->tags->contains($tag) ? 'checked' : ''}}
                                    @endif 
                                        class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}">
                                        {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
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
