<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Membership;
use App\Offer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	$memberships = Membership::where('user_id', Auth::user()->id)
    							->where('status', 1)
    							->get();
    	if (count($memberships)) $membership = $memberships[0]; else $membership = null;

        $users = User::all();

        $silver = Offer::where('membership', 'silver')->first();
        $gold = Offer::where('membership', 'gold')->first();
        $diamond = Offer::where('membership', 'diamond')->first();


        $silvers = Membership::where('offer_id', $silver->id)
                            ->where('status', 1)
                            ->get();
        $golds = Membership::where('offer_id', $gold->id)
                            ->where('status', 1)
                            ->get();
        $diamonds = Membership::where('offer_id', $diamond->id)
                            ->where('status', 1)
                            ->get();

        $data = [
            'membership' => $membership,
            'users' => $users,
            'silver' => $silver,
            'gold' => $gold,
            'diamond' => $diamond,
            'silvers' => $silvers,
            'golds' => $golds,
            'diamonds' => $diamonds,
        ];

        return view('dashboard/index', $data);
    }
}
