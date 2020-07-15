<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        $tags = Tag::all();
        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|max:255|unique:posts,title',
            'content' => 'required'
        ]);
        $dati = $request->all();
        // genero slug a partire dal titolo
        $slug = Str::of($dati['title'])->slug('-')->__toString();
        $slug_vergine = $slug;
        // verifico che lo slug non sia già presente
        $post_trov = Post::where('slug', $slug)->first();
        $count = 0;
        // favvio ciclo while per concatenare allo slug un numero incrementale
        while($post_trov) {
            $count++;
            $slug = $slug_vergine . '-' . $count;
            $post_trov = Post::where('slug', $slug)->first();
        }

        // qua lo slug è uunico per forza
        $dati['slug'] = $slug;
        // salvo i nuovi dati del post
        $nuovo_post = new Post();
        $nuovo_post->fill($dati);
        $nuovo_post->save();
        if(!empty($dati['tags'])) {
            $nuovo_post->tags()->sync($dati['tags']);
        }
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post) {
            return view('admin.posts.show', compact('post'));
        } else {
            return abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post) {
            $categories= Category::all();
            $tags = Tag::all();
            $data=[
                'post' => $post,
                'categories' => $categories,
                'tags'=> $tags
            ];
            return view('admin.posts.edit', $data);
        } else {
            return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|max:255|unique:posts,title,'.$id,
            'content' => 'required'
        ]);

        $dati = $request->all();
        // genero slug a partire dal titolo
        $slug = Str::of($dati['title'])->slug('-')->__toString();
        $slug_vergine = $slug;
        // verifico che lo slug non sia già presente
        $post_trov = Post::where('slug', $slug)->first();
        $count = 0;
        // favvio ciclo while per concatenare allo slug un numero incrementale
        while($post_trov) {
            $count++;
            $slug = $slug_vergine . '-' . $count;
            $post_trov = Post::where('slug', $slug)->first();
        }
        $dati['slug'] = $slug;

        $post = Post::find($id);
        $post->update($dati);

        if(!empty($dati['tags'])) {
            $post->tags()->sync($dati['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post) {
            $post->tags()->detach();
            $post->delete();
            return redirect()->route('admin.posts.index');
        } else {
            return abort('404');
        }
    }
}
