<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class AdvertisementCommentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($comment)
    {
        $user = User::findOrFail($comment['user_id']);
        return [
            'id' => $comment['id'],
            'user' => [
                'user_id' => $comment['user_id'],
                'user_name' => $user->name,
                'user_surname' => $user->surname,
            ],
            'advertisement_id' =>$comment['advertisement_id'],
            'content' => $comment['content'],
            'created_at' =>$comment['created_at']->toDateTimeString(),
            'updated_at' =>$comment['updated_at']->toDateTimeString(),
        ];
    }
}
