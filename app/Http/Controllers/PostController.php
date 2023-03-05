<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // return $request->file('photo')->store('post-images');
        $data = $request->validate([
            'body' => 'required|max:1500',
            'photo' => 'image|file|max:13000'
        ]);
        if ($request->file('photo')) {
            $data['photo'] = $request->file('photo')->store('post-images');
        }

        $request->user()->posts()->create($data);
        // emotify('success', 'You are awesome, your data was successfully created');
        notify()->success('Success create post');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('detail', [
            // 'post' => Post::with('comments')
            'post' => $post,
            // 'replies' => Reply::latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('components.form.edit-post', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|max:1500',
            'photo' => 'image|file|max:13000'
        ]);

        if ($request->file('photo')) {
            if ($request->old_photo) {
                Storage::delete($request->old_photo);
            }
            $data['photo'] = $request->file('photo')->store('post-images');
        }


        $post->update($data);
        notify()->success('Success update post');
        return redirect()->to('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->photo) {
            Storage::delete($post->photo);
        }
        $post->delete();
        notify()->success('Success delete post');
        return redirect()->back();
    }
}
