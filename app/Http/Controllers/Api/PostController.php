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
        $this->middleware('author')->only(['update', 'destroy']);
    }

    // all users can access this function
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

    // all users can access this function
    public function store(StorePost $request)
    {
        $newPost = Post::create($request->all());

        $arrayResponse = $this->getOnePost($newPost->id);

        return response()->json(
            $arrayResponse,
        );
    }

    // all users can access this function
    public function show($id)
    {
        $arrayResponse = $this->getOnePost($id);

        return response()->json(
            $arrayResponse,
        );
    }

    // only post's user or admin can access this function
    public function update(UpdatePost $request, $id)
    {
        if (!$this->validateAuthor($request->user(), $id)) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);            
        }
        
        unset($request['user']);

        $post = Post::find($id);
        $post->fill($request->all());
        $post->save();

        $arrayResponse = $this->getOnePost($id);

        return response()->json(
            $arrayResponse,
        );
    }

    // only post's user or admin can access this function
    public function destroy($id)
    {
        if (!$this->validateAuthor($request->user(), $id)) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);            
        }

        unset($request['user']);

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
    
    // all users can access this function
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

    // all users can access this function
    private function validateAuthor($user, $post_id)
    {
        if ($user->is_admin) return true;

        $post = Post::find($post_id);

        return $user->id == $post->user_id;
    }
}