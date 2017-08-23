<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class GoogleMapCitiesTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($data)
    {
        return [
            'description' => $data['description'],
            'place_id' => $data['place_id'],
            'main_text' => $data['structured_formatting']['main_text'],
            'lat' => $data['geometry']['location']['lat']
        ];
    }
}
