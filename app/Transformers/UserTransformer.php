<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($user)
    {
        return [
            'user' => [

                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_surname' => $user->surname,
                'email' => $user->email,
            ]
        ];
    }
}
