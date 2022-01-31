@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

<div class="col-md-12">
    <a href="{{ route('admin.holidays.set') }}" class="btn btn-primary pull-right" >Re-Generar Feriados</a>
</div>

<br><br>
<div class="col-md-6">
<h5>Feriados {{ \Carbon\Carbon::now()->year }}</h5>
    <div class="card">
		<table class="table table-hover table-sm align-items-center">
          	<thead class="thead-light">
				<tr>
					<th>Nombre Día</th>
					<th>Fecha</th>
					<th>Tipo</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($holidays as $holi)
			  	<tr>
					<td> {{ $holi->name }}</td>
                    <td>
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',  $holi->date)->locale('es_ES')->isoFormat('D MMM YYYY') }}
                    </td>
                    <td> {{ $holi->type }}</td>
                </tr>
				@endforeach
			<tbody>	
        </table>
    </div>
</div>
<br><br>
<div class="col-md-6">
    <h5>Dias fin de semana {{ \Carbon\Carbon::now()->year }}</h5>
        <div class="card">
            <table class="table table-hover table-sm align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre Día</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weekendDays as $day)
                    <tr>
                        <td> {{ $day->name }}</td>
                        <td>
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d',  $day->date)->locale('es_ES')->isoFormat('D MMM YYYY') }}
                        </td>
                        <td> {{ $day->type }}</td>
                    </tr>
                    @endforeach
                <tbody>	
            </table>
        </div>
    </div>

@endsection
@section('scripts')
	@parent
	<script>

    </script>
@endsection