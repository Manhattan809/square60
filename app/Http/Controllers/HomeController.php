<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BoroughRepository;
use App\Repositories\PropertyRepository;
use App\Traits\HomeTrait;

class HomeController extends Controller
{
    use HomeTrait;

    private $borough;

    private $property;

    public function __construct(BoroughRepository $borough, PropertyRepository $property)
    {
        $this->borough = $borough;
        $this->property = $property;
    }

    public function index()
    {
        return view('home', [
            'boroughs' => $this->borough->all(),
        ]);
    }

    public function search(Request $request)
    {
        try {
            $id = $this->getPropertyIdByRequest($request);
            $redirect = route('searchHomePage', $id);
        } catch (\Exception $e) {
            $redirect = '';
        }

        return response()->json([
            'redirect' => $redirect,
        ]);
    }

    public function loadStreets(Request $request)
    {
        try {
            $similar = $this->getLoadStreets($request);
        } catch (\Exception $e) {
            $similar = [];
        }

        return response()->json([
            'similar' => $similar,
        ]);
    }
}
