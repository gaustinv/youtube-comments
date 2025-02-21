<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class CommentService {

    /**
     * Like a comment by the authenticated user.
     *
     * @param int $commentId The ID of the comment to be liked.
     */
    public function likeComment($commentId) {
        return CommentLike::create([
            'comment_id' => $commentId,
            'user_id' => Auth::id(),
            'type' => 'like'
        ]);
    }

    /**
     * Dislike a comment by the authenticated user.
     *
     * @param int $commentId The ID of the comment to be disliked.
     */
    public function dislikeComment($commentId) {
        return CommentLike::create([
            'comment_id' => $commentId,
            'user_id' => Auth::id(),
            'type' => 'dislike'
        ]);
    }

    /**
     * Store a new comment by the authenticated user.
     *
     * @param int $videoId The ID of the video the comment belongs to.
     * @param array $data The comment data to be stored.
     * @return \App\Models\Comment
     */
    public function storeComment($videoId, $data) {
        return Comment::create([
            'video_id' => $videoId,
            'user_id' => Auth::id(),
            'comment_text' => $data['comment_text'],
            'parent_id' => $data['parent_id'] ?? null,
        ]);
    }
    /**
     * Get the top comments for a given video, ordered by the difference in number of likes and dislikes,
     * then by the length of the comment text, and finally by the time of creation. The comments are
     * returned with all their replies, and the number of likes and dislikes for each comment.
     * Each comment is also assigned a rank.
     *
     * @param int $videoId The ID of the video to get the top comments for.
     * @return \Illuminate\Support\Collection|\App\Models\Comment[]
     */
    
    public function getTopComments($videoId) {
        $comments = Comment::where('video_id', $videoId)
            ->whereNull('parent_id')
            ->with([
                'replies' => function ($query) {
                    $query->with([
                        'replies' => function ($query) {
                            $query->with([
                                'replies' => function ($query) {
                                    $query->with('replies'); 
                                }
                            ]);
                        }
                    ]);
                }
            ])
            ->withCount([
                'likes as likes_count' => function ($query) {
                    $query->where('type', 'like');
                },
                'likes as dislikes_count' => function ($query) {
                    $query->where('type', 'dislike');
                }
            ])
            ->orderByRaw('(COALESCE(likes_count, 0) - COALESCE(dislikes_count, 0)) + (LENGTH(comment_text) / 100) DESC, created_at DESC')
            ->get();
        
        // Assign ranking to comments
        $rank = 1;
        $comments->transform(function ($comment) use (&$rank) {
            $comment->rank = $rank++;
            return $comment;
        });
        
        return $comments;
    }
}