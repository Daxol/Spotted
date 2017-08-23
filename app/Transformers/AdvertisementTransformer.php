<?php

namespace App\Transformers;

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
        return [
            'title' => $advertisements['title'],
            'country' => $advertisements['country'],
            'category' => $advertisements['category'],
            'place_id' => $advertisements['place_id'],
            'user_id' => $advertisements['user_id'],
            'status' => $advertisements['status'],
            'content' => $advertisements['content'],
            'city_pl' => $advertisements['city_pl'],
            'city_en' => $advertisements['city_en']
        ];
    }
}
