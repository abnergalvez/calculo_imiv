@extends('layouts.dashboard')

@section('styles')
	@parent
@endsection

@section('content_dashboard')
 <h2>Home Normal</h2>

    <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
    >
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>                        
        <i class='bx bx-log-out nav_icon'></i> 
        <span class="nav_name">{{ __('Logout') }} </span> 
    </a>

@endsection

@section('scripts')
	@parent
@endsection