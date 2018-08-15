<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PropertyRepository;

class SearchHomeController extends Controller
{
    private $property;

    public function __construct(PropertyRepository $property)
    {
        $this->property = $property;
    }

    public function index($id)
    {
        $property = $this->property->find($id);

        if (!$property) {
            abort(404);
        }

//        echo '<pre>'
//        var_dump($property);
//        die();

        return view('search_home', [
            'property' => $property,
        ]);
    }
}
