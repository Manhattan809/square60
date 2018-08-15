@extends('layouts.index')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style media="screen">
        .btn-color {
            #background: #185682;
            width: 130px;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection

@section('content')
    <div class="level-right level">
        <button type="button" class="btn-color button" name="button"><a href="">For Sale</a></button>
        <button type="button" class="btn-color button" name="button">Foreclosure</button>
        <button type="button" class="btn-color button" name="button">Tool / Mailing</button>
    </div>
    <div class="main-search">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="notification is-success">
                    <strong>Success!</strong> {!! $message !!}.
                </div>
                <?php Session::forget('success');?>
            @endif

            @if ($message = Session::get('error'))
                <div class="notification is-danger">
                    <strong>Error!</strong> {!! $message !!}.
                </div>
                <?php Session::forget('error');?>
            @endif

            <h2 class="is-center is-4 title" style="margin-top:15px;">Property Search:</h2>
            <div class="columns">
                <div class="column">
                    <form action="{{ route('searchHome') }}" method="POST" class="form-search">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="address">
                        <label>
                            By address:
                        </label>
                        <br />
                        <br />
                        <label for="borough-by-address">Borough </label>
                        <select name="borough" id="borough-by-address">
                            @foreach ($boroughs as $borough)
                                <option value="{{ $borough->name }}">{{ $borough->name }}</option>
                            @endforeach
                        </select>
                        <br />
                        <br />
                        <label for="house-number">House number </label>
                        <input type="text" class="house-number" name="house_number" id="house-number" required />
                        <br />
                        <br />
                        <label for="street-name">Street name </label>
                        {{--<input type="text" class="street-name" name="street_name" id="street-name" required />--}}
                        <select class="street-name" name="street_name" id="name" data-action="{{ route('loadStreets') }}" required></select>
                        <br />
                        <br />
                        <button class="main-search is-primary button">Search </button>
                        <br />
                        <br />
                        <div class="level">
                            <span class="error empty-search error-address" style="display: none">No results found</span>
                        </div>
                    </form>
                </div>
                <div class="column">
                    <form action="{{ route('searchHome') }}" method="POST" class="form-search">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="bbl">
                        <label>
                            By Boro - Block - lot (BBL)
                        </label>
                        <br />
                        <br />
                        <label for="borough-by-bbl">
                            Borough
                        </label>
                        <?php $indexBorough = 1; ?>
                        <select name="borough" id="borough-by-bbl">
                            @foreach ($boroughs as $borough)
                                <option value="{{ $borough->name }}">{{ $indexBorough . '-' . $borough->name }}</option>
                                <?php $indexBorough++; ?>
                            @endforeach
                        </select>
                        <br />
                        <br />
                        <label for="block">Block </label>
                        <input type="text" class="block-main" name="block" id="block" required />
                        <br />
                        <br />
                        <label for="lot">Lot </label>
                        <input type="text" class="lot" name="lot" id="lot" required />
                        <br />
                        <br />
                        <div style="max-width:200px;">
                            <div class="level pull-right">
                                <button class="main-search is-primary button">Search </button>
                            </div>
                            <div class="level pull-right">
                                <span class="error empty-search error-bbl" style="display: none">No results found</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
