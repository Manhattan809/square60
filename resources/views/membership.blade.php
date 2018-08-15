@extends('layouts.index')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/pricingtable.css') }}">
	<style type="text/css" media="screen">
		html {
			background: #F2F6FA;
		}
		.pricing-plans {
			margin-top: -50px;
		}
		.container {
			padding-top: 25px;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<p class="title is-2">Membership</p>
		<p class="subtitle is-4">Features pricing table</p>

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
	</div>
	<br>
	<br>
	<br>
	<br>
@endsection
