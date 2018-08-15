@extends('layouts.dashboard')

@section('cl-dashboard', 'is-active')

@section('css')
    @parent

    <link rel="stylesheet" type="text/css" href="{{ asset('css/pricingtable.css') }}">
    <style type="text/css" media="screen">
    </style>
@endsection

@section('main')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('dashboard') }}">Admin.</a></li>
            <li class="is-active"><a href="{{ url('dashboard') }}" aria-current="page">Dashboard</a></li>
        </ul>
    </nav>
    <section class="hero is-info welcome is-small">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                Hello, {{ Auth::user()->name }}.
                </h1>
                <h2 class="subtitle">
                I hope you are having a great day!
                </h2>
            </div>
        </div>
    </section>

    @if (Auth::user()->rol === 'admin')
        <section class="info-tiles">
            <div class="tile is-ancestor has-text-centered">
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($users) }}</p>
                        <p class="subtitle">Users</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($silver) }}</p>
                        <p class="subtitle">Silver members</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($gold) }}</p>
                        <p class="subtitle">Gold members</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($diamond) }}</p>
                        <p class="subtitle">Diamond members</p>
                    </article>
                </div>
            </div>
        </section>
        <div class="columns">
            <div class="column is-6">
            </div>
            <div class="column is-6">
            </div>
        </div>
    @else
        <div class="pricing-plans">
            <div class="wrap">
                <div class="pricing-grids">
                    <div class="pricing-grid1">
                        <div class="price-value">
                            <h2><a href="#"> SILVER</a></h2>
                            <h5><span>$ 10.00</span><lable> / month</lable></h5>
                            <div class="sale-box">
                                <span class="on_sale title_shop">BASIC</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt">
                                    <a href="#">
                                        <strong>Property info</strong> <br>
                                        <small>$</small>200.00<small> / month</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner info
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner's mailing list <br>
                                        <small>$</small>500.00<small> / month</small>
                                    </a>
                                </li>
                            </ul>
                            <div class="cart1">
                                <form method="GET" action="{{ url('payment/paypal') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="membership" value="silver">
                                    <input type="hidden" name="amount" value="710">
                                    @if (empty($membership))
                                        <button class="button is-warning popup-with-zoom-anim">
                                            Buy Monthly
                                        </button>
                                    @else 
                                        @if ($membership->membership === 'silver')
                                            <button class="button" disabled>
                                                Current Plan
                                            </button>
                                        @else
                                            <button class="button" disabled="">
                                                Disabled
                                            </button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid2">
                        <div class="price-value two">
                            <h3><a href="#">GOLD</a></h3>
                            <h5><span>$ 25.00</span><lable> / month</lable></h5>
                            <div class="sale-box two">
                                <span class="on_sale title_shop">STANDARD</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt">
                                    <a href="#">
                                        <strong>Property info</strong> <br>
                                        <small>$</small>250.00<small> / month</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner info
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        Map
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Comparible
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner's mailing list <br>
                                        <small>$</small>1,000.00<small> / month</small>
                                    </a>
                                </li>
                            </ul>
                            <div class="cart2">
                                <form method="GET" action="{{ url('payment/paypal') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="membership" value="gold">
                                    <input type="hidden" name="amount" value="1275">
                                    @if (empty($membership))
                                        <button class="button is-danger popup-with-zoom-anim">
                                            Buy Monthly
                                        </button>
                                    @else 
                                        @if ($membership->membership === 'gold')
                                            <button class="button" disabled="">
                                                Current Plan
                                            </button>
                                        @elseif ($membership->membership === 'silver')
                                            <button class="button is-danger popup-with-zoom-anim">
                                                Upgrade
                                            </button>
                                        @else
                                            <button class="button" disabled="">
                                                Disabled
                                            </button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid3">
                        <div class="price-value three">
                            <h4><a href="#">DIAMOND</a></h4>
                            <h5><span>$ 45.00</span><lable> / month</lable></h5>
                            <div class="sale-box three">
                                <span class="on_sale title_shop">PREMIUM</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <li class="whyt">
                                    <a href="#">
                                        <strong>Property info</strong> <br>
                                        <small>$</small>300.00<small> / month</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner info
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        Map
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Comparible
                                    </a>
                                </li>
                                <li class="whyt">
                                    <a href="#">
                                        Pre-florclosure
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Owner's mailing list <br>
                                        <small>$</small>2,500.00<small> / month</small>
                                    </a>
                                </li>
                            </ul>
                            <div class="cart3">
                                <form method="GET" action="{{ url('payment/paypal') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="membership" value="diamond">
                                    <input type="hidden" name="amount" value="2845">
                                    @if (empty($membership))
                                        <button class="button is-primary popup-with-zoom-anim">
                                            Buy Monthly
                                        </button>
                                    @else 
                                        @if ($membership->membership === 'diamond')
                                            <button class="button" disabled="">
                                                Current Plan
                                            </button>
                                        @elseif ($membership->membership === 'silver' || $membership->membership === 'gold')
                                            <button class="button is-primary popup-with-zoom-anim">
                                                Upgrade
                                            </button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"> </div>
        </div>
    @endif
@endsection
