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

    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#userModal">Crear Usuario</button>

        <div class="container col-md-8 tables">
            <table id="usersTable" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>email</th>
                        <th>contacto</th>
                        <th>opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

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
                                <input type="text" name="name" class="form-control" id="name" required>
                                {{-- <input type="hidden" name="id"  id="id">
                                @method('Put') --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dni">Cédula</label>
                                <input type="text" name="dni" class="form-control" id="dni" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Correo electronico</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Número de contacto</label>
                                <input type="number" name="phone" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Repetir contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            </div>
                        </div>
                        <label>Permisos</label>
                        <div class="row">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="all" value="all">
                                    <label class="form-check-label" for="all">Selecionar todos</label>
                                </div>
                            </div>
                        </div>
                        <div class="check-group-all">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-3">
                                        <input class="form-check-input group-all" type="checkbox" id="remision" value="remision" name="remision">
                                        <label class="form-check-label" for="remision">Remisiones</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-3">
                                        <input class="form-check-input group-all" type="checkbox" id="invoice" value="invoice" name="invoice">
                                        <label class="form-check-label" for="facturacion">Facturación</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-4">
                                        <input class="form-check-input group-all" type="checkbox" id="receipt" value="receipt" name="receipt">
                                        <label class="form-check-label" for="receipt">Recibos de caja</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="pending-invoices"
                                            value="pendingInvoices" name="pendingInvoices">
                                        <label class="form-check-label" for="facturasPendientes">Facturas pendientes</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="remisionesPendientes"
                                            value="listRemision" name="listRemision">
                                        <label class="form-check-label" for="remisionesPendientes">Remisiones pendientes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="createProducts"
                                            value="createProducts" name="createProducts">
                                        <label class="form-check-label" for="createProducts">Creación de productos</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="listProductos"
                                            value="listProducts" name="listProducts">
                                        <label class="form-check-label" for="listProductos">Listado de productos</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="gestionInventario"
                                            value="gestionInventario" name="gestionInventario">
                                        <label class="form-check-label" for="gestionInventario">Gestion de inventario</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-5">
                                        <input class="form-check-input group-all" type="checkbox" id="cargueFacturas"
                                            value="shoppingInvoices" name="shoppingInvoices">
                                        <label class="form-check-label" for="cargueFacturas">Cargue de facturas</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-3">
                                        <input class="form-check-input group-all" type="checkbox" id="terceros" value="terceros" name="terceros">
                                        <label class="form-check-label" for="terceros">Terceros</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-3">
                                        <input class="form-check-input group-all" type="checkbox" id="suppliers"
                                            value="suppliers" name="suppliers">
                                        <label class="form-check-label" for="proveedores">Proveedores</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-3">
                                        <input class="form-check-input group-all" type="checkbox" id="reportes" value="reports" name="reports">
                                        <label class="form-check-label" for="reportes">Reportes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline col-md-6">
                                        <input class="form-check-input group-all" type="checkbox" id="configurationCompany"
                                            value="configCompany" name="configCompany">
                                        <label class="form-check-label" for="configurationCompany">Configuración de
                                            empresa</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-4">
                                        <input class="form-check-input group-all" type="checkbox" id="users" value="users" name="users">
                                        <label class="form-check-label" for="users">Usuarios</label>
                                    </div>
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
