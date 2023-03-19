@extends('adminlte::page')

@section('title', 'Proveedores')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')
    <h1>Gestion de usuarios</h1>

    <div class="container">
        <button class="btn btn-info" data-toggle="modal" data-target="#userModal">Crear Usuario</button>
    </div>

    @foreach($users as $user)
    <li>{{$user->name}}</li>
    @endforeach
    {{-- modal de usuario --}}
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Datos de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formUser">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dni">Cédula</label>
                                <input type="text" name="dni" class="form-control" id="dni">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Correo electronico</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Número de contacto</label>
                                <input type="number" name="phone" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Repetir contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                        </div>
                        <label>Permisos</label>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="remision" value="remision">
                                    <label class="form-check-label" for="remision">Remisiones</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="facturacion" value="facturacion">
                                    <label class="form-check-label" for="facturacion">Facturación</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="receipt" value="receipt">
                                    <label class="form-check-label" for="receipt">Recibos de caja</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="facturasPendientes"
                                        value="facturasPendientes">
                                    <label class="form-check-label" for="facturasPendientes">Facturas pendientes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="remisionesPendientes"
                                        value="remisionesPendientes">
                                    <label class="form-check-label" for="remisionesPendientes">Remisiones pendientes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="listProductos"
                                        value="listProductos">
                                    <label class="form-check-label" for="listProductos">Listado de productos</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="createProducts"
                                        value="createProducts">
                                    <label class="form-check-label" for="createProducts">Creación de productos</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="gestionInventario"
                                        value="gestionInventario">
                                    <label class="form-check-label" for="gestionInventario">Gestion de inventario</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="cargueFacturas"
                                        value="cargueFacturas">
                                    <label class="form-check-label" for="cargueFacturas">Cargue de facturas</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="terceros" value="terceros">
                                    <label class="form-check-label" for="terceros">Terceros</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="proveedores"
                                        value="proveedores">
                                    <label class="form-check-label" for="proveedores">Proveedores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="reportes" value="reportes">
                                    <label class="form-check-label" for="reportes">Reportes</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="configurationCompany"
                                        value="configurationCompany">
                                    <label class="form-check-label" for="configurationCompany">Configuración de
                                        empresa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="users" value="users">
                                    <label class="form-check-label" for="users">Usuarios</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"  id="btnForm">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('footer')
    @stop

    @section('plugins.Datatables', true)
    @section('js')
        <script src="../../js/tools.js"></script>
        <script src="../../js/users.js"></script>
        {{-- @livewireScripts --}}
    @stop
