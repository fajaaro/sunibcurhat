<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreComment;
use App\Http\Requests\Comment\UpdateComment;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('author')->only(['update', 'destroy']);
    }

    public function store(StoreComment $request)
    {
        $newComment = Comment::create($request->all());

        $arrayResponse = $this->getOneComment($newComment->id);

        return response()->json(
            $arrayResponse,
        );
    }

    public function update(UpdateComment $request, $id)
    {
        if (!$this->validateAuthor($request->user(), $id)) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);            
        }
        
        unset($request['user']);

        $comment = Comment::find($id);
        $comment->fill($request->all());
        $comment->save();

        $arrayResponse = $this->getOneComment($id);

        return response()->json(
            $arrayResponse,
        );
    }

    public function destroy(Request $request, $id)
    {
        if (!$this->validateAuthor($request->user(), $id)) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);            
        }

        unset($request['user']);

        Comment::destroy($id);

        $comments = CommentResource::collection(
            Comment::withRelations()->get()
        );

        return response()->json([
            'status' => 'success',
            'message' => "Success delete comment with id {$id}!",
            'data' => $comments,
        ]);
    }

    private function getOneComment($id)
    {
        $comment = new CommentResource(
            Comment::withRelations()->find($id)
        );

        return array(
            'status' => 'success',
            'data' => $comment,
        );
    }

    private function validateAuthor($user, $commentId)
    {
        if ($user->is_admin) return true;

        $comment = Comment::find($commentId);

        return $user->id == $comment->user_id;
    }
}
