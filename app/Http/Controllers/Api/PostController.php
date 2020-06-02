<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePost;
use App\Http\Requests\Post\UpdatePost;
use App\Http\Resources\Post as PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = PostResource::collection(
            Post::withRelations()->get()
        );

        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ]);
    }

    public function store(StorePost $request)
    {
        $newPost = Post::create($request->all());

        $arrayResponse = $this->getOnePost($newPost->id);

        return response()->json(
            $arrayResponse,
        );
    }

    public function show($id)
    {
        $arrayResponse = $this->getOnePost($id);

        return response()->json(
            $arrayResponse,
        );
    }

    public function update(UpdatePost $request, $id)
    {
        $post = Post::find($id);
        $post->fill($request->all());
        $post->save();

        $arrayResponse = $this->getOnePost($id);

        return response()->json(
            $arrayResponse,
        );
    }

    public function destroy($id)
    {
        Post::destroy($id);

        $posts = PostResource::collection(
            Post::withRelations()->get()
        );

        return response()->json([
            'status' => 'success',
            'data' => $posts,
            'message' => "Success delete post with id {$id}!",
        ]);
    }
    
    private function getOnePost($id)
    {
        $post = new PostResource(
            Post::withRelations()->find($id)
        );

        return array(
            'status' => 'success',
            'data' => $post,
        );
    }
}
