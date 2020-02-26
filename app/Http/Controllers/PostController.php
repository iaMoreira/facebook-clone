<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\PostCollectionResource;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friend::friendships();
        if ($friends->isEmpty()) {
            return new PostCollectionResource(request()->user()->posts);
        }

        return new PostCollectionResource(
            Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => '',
            'image' => '',
            'width' => '',
            'height' => '',
        ]);

        if(isset($data['image'])){
            $image = $data['image']->store('post-images', 'public');

            Image::make($data['image'])
                ->fit($data['width'], $data['height'])
                ->save(storage_path('app/public/post-images/'.$data['image']->hashName()));

        }

        $post = request()->user()->posts()->create([
            'body' => $data['body'],
            'image' => $image ?? null,
        ]);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
