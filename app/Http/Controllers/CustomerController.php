<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Membership;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$customers = User::where('rol', 'customer')->get();

        return view('dashboard/customers', ['customers' => $customers]);
    }
}
