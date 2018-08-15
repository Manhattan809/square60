<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Membership;

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
        $silver = Membership::where('membership', 'silver')
                            ->where('status', 1)
                            ->get();
        $gold = Membership::where('membership', 'gold')
                            ->where('status', 1)
                            ->get();
        $diamond = Membership::where('membership', 'diamond')
                            ->where('status', 1)
                            ->get();

        $data = [
            'membership' => $membership,
            'users' => $users,
            'silver' => $silver,
            'gold' => $gold,
            'diamond' => $diamond,
        ];

        return view('dashboard/index', $data);
    }
}
