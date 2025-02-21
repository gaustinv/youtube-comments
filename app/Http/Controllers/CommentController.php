<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\CommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $videoId
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, $videoId) {
        $comment = $this->commentService->storeComment($videoId, $request->validated());
        return response()->json($comment, 201);
    }

    /**
     * Get the top comments for a given video.
     *
     * @param int $videoId The ID of the video to get the top comments for.
     * @return \Illuminate\Http\JsonResponse
     */
    public function topComments($videoId) {
        $comments = $this->commentService->getTopComments($videoId);
        return response()->json($comments, 201);
    }
}
