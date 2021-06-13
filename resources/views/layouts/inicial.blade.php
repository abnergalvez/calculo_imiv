@extends('layouts.app')

@section('title', 'Calculo IMIV - Datos Entrada')
@section('styles')
	@parent
@endsection

@section('content_app')
    <x-header />
    <div class="content-wrapper">
    	<div id="app" class="container-fluid">
            <main class="flex-shrink-0">
                @yield('content')
            </main>
        </div>
    </div>
    <x-footer />
@endsection

@section('scripts')
	@parent
@endsection
