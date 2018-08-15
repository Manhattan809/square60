<?php

namespace App\Repositories;

use App\Property;

class PropertyRepository
{
    public function findIdByAddress($borough, $address)
    {
        return Property::where('borough', $borough)->where('address', $address)
            ->value('id');
    }

    public function findIdByBBL($borough, $block, $lot)
    {
        return Property::where('borough', $borough)->where('block', $block)
            ->where('lot', $lot)
            ->value('id');
    }

    public function find($id)
    {
        return Property::find($id);
    }

    public function getSimilarStreets($borough, $address)
    {
        return Property::where('borough', $borough)->where('address', 'LIKE', '%' . $address . '%')
            ->get()
            ->pluck('address');
    }
}