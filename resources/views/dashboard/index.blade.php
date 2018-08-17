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
                        <p class="title">{{ count($silvers) }}</p>
                        <p class="subtitle">Silver members</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($golds) }}</p>
                        <p class="subtitle">Gold members</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <p class="title">{{ count($diamonds) }}</p>
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
                            <h2><a href="#"> {{ strtoupper($silver->membership) }}</a></h2>
                            <h5>{!! $silver->detail !!}</h5>
                            <div class="sale-box">
                                <span class="on_sale title_shop">BASIC</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <?php $i = 0; ?>
                                @foreach($silver->details as $detail)
                                    <li class="{{ (++$i % 2 == 0 ? '' : 'whyt') }}">
                                        <a href="#">
                                            {!! $detail->status ? $detail->detail : '<i class="fas fa-minus"></i>' !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="cart1">
                                @if (empty($membership))
                                    <div class="dropdown">
                                        <div class="dropdown-trigger">
                                            <button class="button is-warning popup-with-zoom-anim" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Buy Monthly</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <form action="{{ url('payment/stripe') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="offer_id" value="{{ $silver->id }}">
                                                    <script
                                                        src="https://checkout.stripe.com/checkout.js"
                                                        class="stripe-button"
                                                        data-key="pk_test_nrMwlkQhpxF3mOvt9JfICZXD"
                                                        data-amount="{{ str_replace('.', '', $silver->amount) }}"
                                                        data-name="{{ $silver->membership }}"
                                                        data-description="{{ $silver->membership }}"
                                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                        data-locale="auto">
                                                    </script>
                                                </form>
                                                <hr class="dropdown-divider">
                                                <a href="{{ url('payment/paypal/'.$silver->id) }}" class="dropdown-item">
                                                    <i class="fab fa-paypal fa-5x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else 
                                    @if ($membership->offer->membership === $silver->membership)
                                        <button class="button" disabled>
                                            Current Plan
                                        </button>
                                    @else
                                        <button class="button" disabled="">
                                            Disabled
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid2">
                        <div class="price-value two">
                            <h2><a href="#"> {{ strtoupper($gold->membership) }}</a></h2>
                            <h5>{!! $gold->detail !!}</h5>
                            <div class="sale-box two">
                                <span class="on_sale title_shop">STANDARD</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <?php $i = 0; ?>
                                @foreach($gold->details as $detail)
                                    <li class="{{ (++$i % 2 == 0 ? '' : 'whyt') }}">
                                        <a href="#">
                                            {!! $detail->status ? $detail->detail : '<i class="fas fa-minus"></i>' !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="cart2">
                                @if (empty($membership))
                                    <div class="dropdown">
                                        <div class="dropdown-trigger">
                                            <button class="button is-danger popup-with-zoom-anim" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Buy Monthly</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <form action="{{ url('payment/stripe') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="offer_id" value="{{ $gold->id }}">
                                                    <script
                                                        src="https://checkout.stripe.com/checkout.js"
                                                        class="stripe-button"
                                                        data-key="pk_test_nrMwlkQhpxF3mOvt9JfICZXD"
                                                        data-amount="{{ str_replace('.', '', $gold->amount) }}"
                                                        data-name="{{ $gold->membership }}"
                                                        data-description="{{ $gold->membership }}"
                                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                        data-locale="auto">
                                                    </script>
                                                </form>
                                                <hr class="dropdown-divider">
                                                <a href="{{ url('payment/paypal/'.$gold->id) }}" class="dropdown-item">
                                                    <i class="fab fa-paypal fa-5x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else 
                                    @if ($membership->offer->membership === $gold->membership)
                                        <button class="button" disabled>
                                            Current Plan
                                        </button>
                                    @elseif ($membership->offer->membership === 'silver')
                                        <div class="dropdown">
                                            <div class="dropdown-trigger">
                                                <button class="button is-danger popup-with-zoom-anim" aria-haspopup="true" aria-controls="dropdown-menu">
                                                    <span>Upgrade</span>
                                                    <span class="icon is-small">
                                                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                                <div class="dropdown-content">
                                                    <form action="{{ url('payment/stripe') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="offer_id" value="{{ $gold->id }}">
                                                        <script
                                                            src="https://checkout.stripe.com/checkout.js"
                                                            class="stripe-button"
                                                            data-key="pk_test_nrMwlkQhpxF3mOvt9JfICZXD"
                                                            data-amount="{{ str_replace('.', '', $gold->amount) }}"
                                                            data-name="{{ $gold->membership }}"
                                                            data-description="{{ $gold->membership }}"
                                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                            data-locale="auto">
                                                        </script>
                                                    </form>
                                                    <hr class="dropdown-divider">
                                                    <a href="{{ url('payment/paypal/'.$gold->id) }}" class="dropdown-item">
                                                        <i class="fab fa-paypal fa-5x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button class="button" disabled="">
                                            Disabled
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="pricing-grid3">
                        <div class="price-value three">
                            <h2><a href="#"> {{ strtoupper($diamond->membership) }}</a></h2>
                            <h5>{!! $diamond->detail !!}</h5>
                            <div class="sale-box three">
                                <span class="on_sale title_shop">PREMIUM</span>
                            </div>
                        </div>
                        <div class="price-bg">
                            <ul>
                                <?php $i = 0; ?>
                                @foreach($diamond->details as $detail)
                                    <li class="{{ (++$i % 2 == 0 ? '' : 'whyt') }}">
                                        <a href="#">
                                            {!! $detail->status ? $detail->detail : '<i class="fas fa-minus"></i>' !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="cart3">
                                @if (empty($membership))
                                    <div class="dropdown">
                                        <div class="dropdown-trigger">
                                            <button class="button is-primary popup-with-zoom-anim" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Buy Monthly</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <form action="{{ url('payment/stripe') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="offer_id" value="{{ $diamond->id }}">
                                                    <script
                                                        src="https://checkout.stripe.com/checkout.js"
                                                        class="stripe-button"
                                                        data-key="pk_test_nrMwlkQhpxF3mOvt9JfICZXD"
                                                        data-amount="{{ str_replace('.', '', $diamond->amount) }}"
                                                        data-name="{{ $diamond->membership }}"
                                                        data-description="{{ $diamond->membership }}"
                                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                        data-locale="auto">
                                                    </script>
                                                </form>
                                                <hr class="dropdown-divider">
                                                <a href="{{ url('payment/paypal/'.$diamond->id) }}" class="dropdown-item">
                                                    <i class="fab fa-paypal fa-5x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else 
                                    @if ($membership->offer->membership === $diamond->membership)
                                        <button class="button" disabled>
                                            Current Plan
                                        </button> 
                                    @elseif ($membership->offer->membership !== 'diamond')
                                        <div class="dropdown">
                                            <div class="dropdown-trigger">
                                                <button class="button is-primary popup-with-zoom-anim" aria-haspopup="true" aria-controls="dropdown-menu">
                                                    <span>Upgrade</span>
                                                    <span class="icon is-small">
                                                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                                <div class="dropdown-content">
                                                    <form action="{{ url('payment/stripe') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="offer_id" value="{{ $diamond->id }}">
                                                        <script
                                                            src="https://checkout.stripe.com/checkout.js"
                                                            class="stripe-button"
                                                            data-key="pk_test_nrMwlkQhpxF3mOvt9JfICZXD"
                                                            data-amount="{{ str_replace('.', '', $diamond->amount) }}"
                                                            data-name="{{ $diamond->membership }}"
                                                            data-description="{{ $diamond->membership }}"
                                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                            data-locale="auto">
                                                        </script>
                                                    </form>
                                                    <hr class="dropdown-divider">
                                                    <a href="{{ url('payment/paypal/'.$diamond->id) }}" class="dropdown-item">
                                                        <i class="fab fa-paypal fa-5x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button class="button" disabled="">
                                            Disabled
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"> </div>
        </div>
    @endif
@endsection
