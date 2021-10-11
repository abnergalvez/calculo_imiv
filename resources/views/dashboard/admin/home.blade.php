@extends('layouts.dashboard')

@section('styles')
	@parent
@endsection

@section('content_dashboard')

<div class="row">
	@if(count($projectSoonExpired) > 0)
	<div class="col-12 col-sm-12 col-xl-12 mb-0">
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			
			<p><strong class="">Atención!</strong> Tienes {{ count($projectSoonExpired) }} re-ingresos de <strong><a href="{{ route('admin.projects.soonExpire')}}">proyectos por vencer</a></strong> en 3 dias mas.</p>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	@endif
	@if(count($projectExpired) > 0)
	<div class="col-12 col-sm-12 col-xl-12 mb-0">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			
			<p><strong class="">Atención!</strong> Tienes {{ count($projectExpired) }} re-ingresos de <a href="{{ route('admin.projects.expired')}}">proyectos vencidos!</a>.</p>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	@endif
</div>

<div class="row">
<div class="col-12 col-sm-6 col-xl-3 mb-2">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
							<svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
							</svg>
						</div>
                        <div class="d-sm-none">
                            <h2 class="h5"><a href="{{ route('admin.projects.index')}}">Total Proyectos</a></h2>
                            <h3 class="fw-extrabold mb-1">{{ count($projectStats['total']) }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-600 mb-0"><a href="{{ route('admin.projects.index')}}">Total Proyectos</a></h2>
                            <h3 class="fw-extrabold mb-2">{{ count($projectStats['total']) }}</h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
						<span title="Primer Ingreso">{{ $projectStats['inicial'] }}</span> - <span title="Último Ingreso">{{ $projectStats['final'] }}</span>
                        </small> 
                        <div class="small d-flex mt-1">                               
                            <div>Mes Actual <span class="text-success fw-bolder">{{ count($projectStats['actual']) }} </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-2">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
						<svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5"><a href="{{ route('admin.customers.index')}}">Total Clientes</a></h2>
                            <h3 class="mb-1">{{ count($customerStats['total']) }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-600 mb-0"><a href="{{ route('admin.customers.index')}}">Total Clientes</a></h2>
                            <h3 class="fw-extrabold mb-2">{{ count($customerStats['total']) }}</h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
						<span title="Primer Ingreso">{{ $customerStats['inicial'] }}</span> - <span title="Último Ingreso">{{ $customerStats['final'] }}</span>

                        </small> 
                        <div class="small d-flex mt-1">                               
                            <div>Mes Actual <span class="text-danger fw-bolder">{{ count($customerStats['actual']) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-2">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
							<svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>						</div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5"><a href="{{ route('admin.users.index')}}">Total Usuarios</a></h2>
                            <h3 class="mb-1">{{ count($userStats['total']) }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-600 mb-0"><a href="{{ route('admin.users.index')}}"> Total Usuarios</a></h2>
                            <h3 class="fw-extrabold mb-2">{{ count($userStats['total']) }}</h3>
                        </div>
                        <small class="text-gray-500">
						<span title="Primer Ingreso">{{ $userStats['inicial'] }}</span> - <span title="Último Ingreso">{{ $userStats['final'] }}</span>
                        </small> 
                        <div class="small d-flex mt-1">                               
                            <div>&nbsp;<span class="text-success fw-bolder">&nbsp;</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	    <div class="col-12 col-sm-6 col-xl-3 mb-2">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-warning rounded me-4 me-sm-0">
							<svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
						</div>
                        
						<div class="d-sm-none">
                            <h2 class="fw-extrabold h5"><a href="{{ route('admin.projects.soonExpire')}}">Re-Ingresos por Vencer</a></h2>
                            <h3 class="mb-1">10</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-warning mb-0"><a href="{{ route('admin.projects.soonExpire')}}">Re-Ingresos por Vencer</a></h2>
                            <h3 class="fw-extrabold mb-2">{{ count($projectSoonExpired) }}</h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            a 3 días de vencer
                        </small> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-12 col-sm-6 col-xl-4 mb-4">
		<div class="card border-0 shadow">
            <div class="card-body">
				<h2 class="h6 text-gray-600 mb-0 text-center"> Proyectos por Estado</h2>
				<div id="projectByState"></div>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-xl-4 mb-4">
		<div class="card border-0 shadow">
            <div class="card-body">
				<h2 class="h6 text-gray-600 mb-0 text-center"> Proyectos por Tipo</h2>
				<div id="projectByType"></div>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-xl-4 mb-4">
		<div class="card border-0 shadow">
            <div class="card-body">
				<h2 class="h6 text-gray-600 mb-0 text-center"> Proyectos por Cliente</h2>
				<div id="projectByCustomer"></div>
			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
	@parent

	<script>
	$(document).ready(function() {
	
        var chart1 = new ApexCharts(document.querySelector("#projectByState"), 
		{
          series: [
			  {{ $statusCountNull }},
			  @foreach($status as $stat)
			  {{ $stat->cant }} ,
			  @endforeach

		  ],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: [
			'Sin Estado', 
			@foreach($status as $stat)
			  '{{ \App\Models\Project::statusLabel($stat->status) }}' ,
			  @endforeach
			
		],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }],
        theme: {
            monochrome: {
                enabled: true,
                color: '#FB503B',
            }
        }
        }
		);
        chart1.render();

		
        var chart2 = new ApexCharts(document.querySelector("#projectByType"), {
          series: [{
          data: [
			  @foreach($types as $type)
			  {{ count($type->projects) }},
			  @endforeach
		  ]
        }],
          chart: {
          height: 250,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        legend: {
          show: true
        },
        xaxis: {
          categories: [
			@foreach($types as $type)
			  '{{ $type->name }}',
			  @endforeach
          ],
          labels: {
            style: {
              fontSize: '11px'
            }
          }
        }
		,
        theme: {
            monochrome: {
                enabled: true,
                color: '#31316A',
            }
        }
        });
        chart2.render();
      



        var chart3 = new ApexCharts(document.querySelector("#projectByCustomer"), 
		{
          series: [{
          data: [
			@foreach($customers as $customer)
			  {{ count($customer->projects) }},
			  @endforeach
		  ]
        }],
          chart: {
          type: 'bar',
          height: 250
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: [
			@foreach($customers as $customer)
			  '{{ $customer->name }}',
			  @endforeach
          ],
        }
		,
        theme: {
            monochrome: {
                enabled: true,
                color: '#FB503B',
            }
        }
        }
		);
        chart3.render();




	});
	</script>

@endsection