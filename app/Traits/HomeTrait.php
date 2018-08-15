<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait HomeTrait
{
    private function getPropertyIdByRequest($request)
    {
        $type = $request->input('type');

        switch($type) {
            case 'address':
                $id = $this->getIdByAddress($request);
                break;

            case 'bbl':
                $id = $this->getIdByBBL($request);
                break;

            default:
                $id = 0;
        }

        return $id;
    }

    private function getIdByAddress($request)
    {
        $rule = [
            'borough'      => 'required',
            'house_number' => 'required',
            'street_name'  => 'required',
        ];

        if ($this->validator($request, $rule)) {
            throw new \Exception();
        }

        $houseNumber = trim($request->house_number);
        $streetName = trim($request->street_name);
        $id = $this->property->findIdByAddress($request->borough, $houseNumber . ' ' . $streetName);

        return $id;
    }

    private function getIdByBBL($request)
    {
        $rule = [
            'borough' => 'required',
            'block'   => 'required|numeric',
            'lot'     => 'required|numeric',
        ];

        if ($this->validator($request, $rule)) {
            throw new \Exception();
        }

        $id = $this->property->findIdByBBL($request->borough, trim($request->block), trim($request->lot));

        return $id;
    }

    private function validator($request, $rule)
    {
        $errors = Validator::make($request->all(), $rule)->errors()
            ->messages();

        return $errors;
    }

    private function getLoadStreets($request)
    {
        $rule = [
            'borough' => 'required',
            'address' => 'required',
        ];

        if ($this->validator($request, $rule)) {
            throw new \Exception();
        }

        $streets = $this->property->getSimilarStreets($request->borough, $request->address);

        $address = strtolower($request->address);

        $streetsCollection = collect($streets)->map(function ($street) {
            return preg_replace('/^[0-9]*\s/i', '', $street);
        })->reject(function ($street) use ($address) {
            return strpos(strtolower($street), $address) === false;
        })->unique()
            ->sort();

        return $streetsCollection->values()->all();
    }
}