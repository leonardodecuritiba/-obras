@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')

    <!-- Jquery DataTable Plugin Css -->
    @include('layouts.inc.datatable.css')

    <!-- Sweetalert Css -->
    @include('layouts.inc.sweetalert.css')

@endsection

@section('page_content')
    <div class="container-fluid">

        <div class="block-header">
            <h2>
                {{$PageResponse->main_title}}
            </h2>
        </div>
        @include('layouts.inc.breadcrumb')
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Listagem
                            @role(['coordenator','manager','financial'])
                                <a href="{{route($PageResponse->route.'.request')}}" class="btn bg-indigo waves-effect pull-right">
                                    <i class="material-icons">add_circle</i>
                                    <span>{{trans('pages.view.OPEN', [ 'name' => $PageResponse->name ])}}</span>
                                </a>
                            @endrole
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Autor</th>
                                    <th>Cliente</th>
                                    <th>Obra</th>
                                    <th>Total</th>
                                    <th>Situação</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Autor</th>
                                    <th>Cliente</th>
                                    <th>Obra</th>
                                    <th>Total</th>
                                    <th>Situação</th>
                                    <th>Ação</th>
                                </tr>
                                </tfoot>

                                <tbody>
                                @foreach ($PageResponse->response as $sel)
                                    <tr>
                                        <td>{{ $sel->id }}</td>
                                        <td>{{ $sel->created_at }}</td>
                                        <td>{{ $sel->getAuthorShortName() }}</td>
                                        <td>{{ $sel->getClientShortName() }}</td>
                                        <td>{{ $sel->getJobShortName() }}</td>
                                        <td>{{ $sel->getTotalMoney() }}</td>
                                        <td><span class="label bg-{{ $sel->getStatusColor() }}">{{ $sel->getStatusText()}}</span></td>
                                        <td class="text-right">
                                            <a href="{{(route($PageResponse->route.'.show',$sel->id))}}"
                                              class="btn btn-simple btn-primary btn-xs btn-icon show"
                                              data-toggle="tooltip"
                                              data-placement="top"
                                              title="Visualizar"><i class="material-icons"> remove_red_eye</i></a>
                                            {{--@include('layouts.inc.buttons.delete')--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection


@section('script_content')

    <script>

        var $_DATATABLE_OPTIONS_ = {
            "dom": 'Bfrtip',
            "responsive": true,
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
            },
            "pageLength": 10,
            "order": [3, "asc"]
        };
    </script>

    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')

@endsection