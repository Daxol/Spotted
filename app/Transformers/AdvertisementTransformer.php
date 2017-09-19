<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class AdvertisementTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($advertisements)
    {
        $user = User::findOrFail($advertisements['user_id']);

        if (file_exists(public_path('img/advertisementsPhotos/' . $advertisements->id . '.jpg'))) {
            return [
                'id' => $advertisements['id'],
                'title' => $advertisements['title'],
                'country' => $advertisements['country'],
                'category' => $advertisements['category'],
                'place_id' => $advertisements['place_id'],
                'user' => [
                    'user_id' => $advertisements['user_id'],
                    'user_name' => $user->name,
                    'user_surname' => $user->surname,
                ],
                'status' => $advertisements['status'],
                'content' => $advertisements['content'],
                'city_pl' => $advertisements['city_pl'],
                'city_en' => $advertisements['city_en'],
                'image' => url('/img/advertisementsPhotos/' . $advertisements->id . '.jpg')];
        };

        return [
            'id' => $advertisements['id'],
            'title' => $advertisements['title'],
            'country' => $advertisements['country'],
            'category' => $advertisements['category'],
            'place_id' => $advertisements['place_id'],
            'user' => [
                'user_id' => $advertisements['user_id'],
                'user_name' => $user->name,
                'user_surname' => $user->surname,
            ],
            'status' => $advertisements['status'],
            'content' => $advertisements['content'],
            'city_pl' => $advertisements['city_pl'],
            'city_en' => $advertisements['city_en'],
            'image' => 'null'

        ];
    }
}
