@extends('layouts.index')

@section('css')
    <style>
        .label {
            font-weight: normal !important;
        }

        #gmap_canvas {
            width: 600px;
            height: 500px;
        }
    </style>
@endsection

@section('js')
    <script>
        function initMap() {
            var uluru = {lat: <?= $property->latitude ?>, lng: <?= $property->longitude ?>};
            var map = new google.maps.Map(document.getElementById('gmap_canvas'), {
                zoom: 15,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPpl_N1a8O3A3dXoH8dNGwQ9fQwCkl0Rs&callback=initMap">
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="box">
            <p class="is-6 title">{{ $property->address . ' ' . $property->borough . ' NY ' . $property->zip_code}} </p>
            <div class="columns">
                <div class="column">
                    <label class="label">Block: {{ $property->block }}</label>
                    <label class="label">Lot: {{ $property->lot }}</label>
                    <label class="label">Building class: {{ $property->building_class_name }}</label>
                    <label class="label">Building Type: </label>
                    <label class="label">Type: </label>
                    <label class="label">Neighborhood: </label>
                    <label class="label">Community disctrict: {{ $property->community_district }}</label>
                    <label class="label">Police Precenct: {{ $property->police_precinct }}</label>
                    <label class="label">Fire Station: {{ $property->fire_company }}</label>
                    <label class="label">School district: {{ $property->school_district }}</label>
                </div>
                <div class="column">
                    <label class="label">Lot: {{ $property->lot_frontage }} x {{ $property->lot_depth }}</label>
                    <label class="label">Lot sizee: {{ round($property->lot_frontage *  $property->lot_depth, 2) }} sq ft</label>
                    <label class="label">Building Lot: {{ $property->number_of_buildings }}</label>
                    <label class="label">Total Buildin sqft: {{ round($property->building_frontage *  $property->building_depth, 2) }}</label>
                    <label class="label">Built on lot: {{ $property->building_frontage }} x {{ $property->building_depth }}</label>
                    <label class="label">Height: </label>
                    <label class="label">Year Built : {{ $property->year_built }}</label>
                    <label class="label">Corner Lot: </label>
                    <label class="label">Extension: {{ $property->extension_code }}</label>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <p class="is-6 title ">Property use</p>
                    <label class="label">Residential unit: {{ $property->residential_units }}</label>
                    <label class="label">Commercial unit: </label>
                    <label class="label">-Office: </label>
                    <label class="label">-Retail: </label>
                    <label class="label">Residential size: {{ $property->residential_area }}</label>
                    <label class="label">Commercial size: </label>
                    <label class="label">-office: </label>
                    <label class="label">-Retail: </label>
                    {{--<label class="label">Commercial size: {{ $property->commerical_area }}</label>--}}
                    {{--<label class="label">-office: {{ $property->office_area }}</label>--}}
                    {{--<label class="label">-Retail: {{ $property->retail_area }}</label>--}}
                </div>
                <div class="column">
                    <p class="is-6 title ">Zonning</p>
                    <label class="label">Zonning class: {{ $property->zoning_district_1 }}</label>
                    <label class="label">Zonning map: {{ $property->zoning_map }}</label>
                    (View map on section)
                    <label class="label">Floor Area Ration(FAR)</label>
                    <label class="label">Resedential FAR: {{ $property->maximum_allowable_residential_far }}</label>
                    <label class="label">Commercial FAR: {{ $property->maximum_allowable_commercial_far }}</label>
                    {{--<label class="label">Commercial FAR: {{ $property->maximum_allowable_commercial_far }}</label>--}}
                    <label class="label">Facility FAR: {{ $property->maximum_allowable_facility_far }}</label>
                    <label class="label">FAR built (current): {{ $property->built_floor_area_ratio_far }}</label>
                    <label class="label">unsuded FAR</label>
                    {{--<label class="label"><a target="_blank" href="{{ $property->building_info_url }}">Building info</a></label>--}}
                </div>
            </div>
            <hr />
            <p class="is-6 title">Building Images</p>
            <div style='text-align: center'>
                <img src="{{ asset('images/2.jpg') }}" width="300px" />
            </div>
            {{--<p class="is-6 title">Tax</p>--}}
            {{--<label class="label">Tax class: <span class="danger">?</span></label>--}}
            {{--<label class="label">Current Tax: <span class="danger">?</span></label>--}}
            {{--<label class="label">For more detail go to section</label>--}}
            {{--<label class="label">Building Image <span class="danger">?</span></label>--}}
            {{--<img src="{{ asset('images/2.jpg') }}" width="300px" />--}}

            <p class="is-6 title">Google map</p>
            {{--<label class="label">Google map</label>--}}
            <div class="mapouter">
                <div class="gmap_canvas" id="gmap_canvas" style="margin: 0 auto">

                </div>
            </div>
            {{--<div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university of san francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><a href="https://www.crocothemes.net">wordpress themes</a><style>.mapouter{overflow:hidden;height:500px;width:600px;}.gmap_canvas {background:none!important;height:500px;width:600px;}</style></div><div class="owner">--}}
            <p class="is-6 title"><a href="{{ $property->digital_tax_map_url }}">Tax map</a></p>
                {{--<img src="{{ asset('images/3.jpg') }}" width="500px" />--}}
                <div style="text-align: center">
                    <iframe src="{{ $property->digital_tax_map_url }}" frameborder="0" width="600px" height="500px"></iframe>
                </div>
                <div class="taxes">
                    <label class="label">Calculate tax: </label>
                    <label class="label">Land market value: </label>
                    <label class="label">Building market value: </label>
                    <label class="label">Total market value: </label>
                    <label class="label">Current assessed value: </label>
                    <label class="label">Property tax: </label>
                </div>
                {{--<label class="label">Zonning map (Only for members)</label>--}}
                {{--<label class="label">Bulding Foot print: <span class="danger">?</span></label>--}}
                <p class="is-6 title"><a href="{{ $property->zoning_map_url }}">Zonning map (Only for members)</a></p>
                <div style="text-align: center">
                    <iframe src="{{ $property->zoning_map_url }}" frameborder="0" width="600px" height="500px"></iframe>
                </div>

                <p class="is-6 title"><a href="{{ $property->building_info_url  }}">Building info</a></p>
                <div style="text-align: center">
                    <iframe src="{{ $property->building_info_url }}" frameborder="0" width="600px" height="500px"></iframe>
                </div>

                <p class="is-6 title"><a href="https://www.openstreetmap.org/#map=19/{{ $property->latitude }}/{{ $property->longitude }}">Bulding Foot print</a></p>
                <p class="is-6 title">Owner:</p>
                <label class="label">{{ $property->owner }}</label>
                <label class="label">{{ $property->address . ' ' . $property->borough . ' NY ' . $property->zip_code}}</label>
            </div>
            <p>Similar property sold records:</p>
        </div>
    </div>
@endsection
