<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function create($new_comment)
    {
        $comment = Comment::create(
            [
                'answer_id'         => $new_comment->answer_id,
                'text'              => $new_comment->text,
            ]
        );
        return $comment;
    }

    public function update($id,$text)
    {
        $comment = Comment::where('id', $id)
            ->update([
                'text'          => $text,
                'updated_at'    => now(),
            ]);

        return $comment;
    }

    public function updateOrCreate($new_comment)
    {

        $arrayToCreate = [
            'answer_id'             => $new_comment['answer_id'],
            'text'                  => $new_comment['text'],
        ];


        $result = Comment::firstOrCreate(
            [
                'answer_id' => $new_comment['answer_id'],
            ],
            $arrayToCreate
        );


        if ($result->wasRecentlyCreated) {
            // Do nothing
        } else {
            Comment::where('id', $result->id)
                ->update($arrayToCreate);
        }

        return $result->id;

    }

}
