@extends('layouts.dashboard')

@section('cl-customers', 'is-active')

@section('main')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('dashboard') }}">Admin.</a></li>
            <li class="is-active"><a href="{{ url('dashboard') }}" aria-current="page">Customers</a></li>
        </ul>
    </nav>
    <h1 class="title">Customers</h1>
	<h2 class="subtitle">registered customers</h2>
    <div class="columns">
        <div class="column is-12">
        	<table class="table is-fullwidth">
        		<thead>
        			<tr>
        				<th>Name</th>
        				<th>Email</th>
        				<th>Membership</th>
        				<th>Expire At</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($customers as $row)
	        			<tr>
	        				<td>{{ $row->name }}</td>
	        				<td>{{ $row->email }}</td>
	        				<td>
	        					@foreach($row->memberships as $m)
                                    @if ($m->status === 1)
                                        {{ $m->membership }}
                                    @endif
	        					@endforeach
	        				</td>
	        				<td>
	        					@foreach($row->memberships as $m)
                                    @if ($m->status === 1)
                                        {{ $m->date_end }}
                                    @endif
	        					@endforeach
	        				</td>
	        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        </div>
    </div>
@endsection
