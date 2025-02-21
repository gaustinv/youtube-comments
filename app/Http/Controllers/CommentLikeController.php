<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentLikeController extends Controller
{
    protected $commentService;
    
    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }
    /**
     * Like a comment by the authenticated user.
     *
     * @param int $commentId The ID of the comment to be liked.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($commentId) {
        $like = $this->commentService->likeComment($commentId);
        return response()->json(['message' => 'Comment liked successfully', 'data' => $like]);
    }
    
    /**
     * Dislike a comment by the authenticated user.
     *
     * @param int $commentId The ID of the comment to be disliked.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislike($commentId) {
        $dislike = $this->commentService->dislikeComment($commentId);
        return response()->json(['message' => 'Comment disliked successfully', 'data' => $dislike]);
    }
}
