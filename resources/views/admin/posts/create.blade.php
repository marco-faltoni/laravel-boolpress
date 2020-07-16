@extends('layouts.dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-4 mb-4">Nuovo Post - Post</h1>
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
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo Post</label>
                        <input type="text" name='title' class="form-control" id="titolo" placeholder="Scrivi il Titolo del post" value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="testo">Testo Articolo</label>
                        <textarea type="text" name='content' class="form-control" id="testo" placeholder="Scrivi del Testo" value="{{old('content')}}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="images">Immagine di Copertina</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select class="form-control" id="categoria" name="category_id">
                            <option value="">Seleziona Categoria</option>
                            @foreach ($categories as $category)
                                <option {{old('category_id')== $category->id ? 'selected' : ''}} value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="inlineCheckbox1">
                                    <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}">
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

                    <button type="submit" class="btn btn-primary">Pubblica il Post</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection