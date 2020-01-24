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
                            <a href="{{route($PageResponse->route.'.create')}}" class="btn bg-indigo waves-effect pull-right">
                                <i class="material-icons">add_circle</i>
                                <span>{{trans('pages.view.CREATE', [ 'name' => $PageResponse->name ])}}</span>
                            </a>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Ação</th>
                                </tr>
                                </tfoot>

                                <tbody>
                                @foreach ($PageResponse->response as $sel)
                                    <tr>
                                        <td>{{ $sel->id }}</td>
                                        <td>{{ $sel->created_at }}</td>
                                        <td>{{ $sel->getUserName() }}</td>
                                        <td>{{ $sel->getEmail() }}</td>
                                        <td>{{ $sel->getShortRoleName() }}</td>
                                        <td class="text-right">
                                            @include('layouts.inc.buttons.edit')
                                            @if(Auth::user()->id != $sel->id)
                                                @include('layouts.inc.buttons.delete')
                                            @endif
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


    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')

@endsection