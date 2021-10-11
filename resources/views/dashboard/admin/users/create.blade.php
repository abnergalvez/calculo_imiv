@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.users.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">Información General</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">Nombre *</label>
                                <input name="name" class="form-control " id="first_name" type="text" placeholder="Ingrese nombre completo" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input name="email" class="form-control" id="email" type="email" placeholder="name@company.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender">Genero</label>
                            <select name="gender" class="form-select mb-0 " id="gender" aria-label="seleccione el Genero">
                                <option selected="">Seleccione...</option>
                                <option value="male">Masculino</option>
                                <option value="female">Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Rol *</label>
                            <select name="profile" class="form-select mb-0 " id="role" aria-label="seleccione el Rol" required>
                                <option selected="">Seleccione...</option>
                                <option value="admin">Administrador</option>
                                <option value="normal">Usuario Normal</option>
                                <option value="customer">Cliente</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="password">Contraseña *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span>
                                <input name="password" type="password" placeholder="Ingrese Contraseña" class="form-control " id="password" required autocomplete="new-password" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card card-body border-0 shadow mb-4 ">
                            <h2 class="h5 mb-4">Selecione foto de perfil</h2>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <!-- Avatar -->
                                    <div class="user-avatar xl-avatar">
                                        <img id="output" class="rounded avatar-xl" src="/images/avatar.png" alt="Profile Photo">
                                    </div>
                                </div>
                                <div class="file-field">
                                    <div class="d-flex justify-content-xl-center ms-xl-3">
                                        <div class="d-flex">
                                            <span class="icon icon-md">
                                                <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <input name="avatar" type="file" accept="image/*" onchange="loadFile(event)">
                                            <div class="d-md-block text-left">
                                                <div class="fw-normal text-dark mb-1">Examinar</div>
                                                <div class="text-gray small">JPG, GIF o PNG. Tamaño Máximo de 2MB
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
	@parent
	<script>
        	var loadFile = function(event) {
				var output = document.getElementById('output');
				output.src = URL.createObjectURL(event.target.files[0]);
				output.onload = function() {
				URL.revokeObjectURL(output.src) // free memory
				}
  			};
    </script>
@endsection