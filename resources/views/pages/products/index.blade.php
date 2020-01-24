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
                        {!! Form::open(['route' => $PageResponse->route.'.index',
                            'id' => 'form_validation',
                            'method' => 'GET']) !!}
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        {{Form::text('code', old('code'), ['placeholder' => 'Código', 'class'=>'form-control','required'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        {{Form::text('name', old('name'), ['placeholder' => 'Nome', 'class'=>'form-control'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-9">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        {{Form::text('description', old('description'), ['placeholder' => 'Descrição', 'class'=>'form-control'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" name="search" class="btn btn-info btn-block waves-effect">
                                    <i class="material-icons">search</i>
                                    <span>Filtrar</span>
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Código</th>
                                    <th>Unidade</th>
                                    <th width="60%">Nome / Descrição</th>
                                    <th>Imagem</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Código</th>
                                    <th>Unidade</th>
                                    <th>Nome / Descrição</th>
                                    <th>Imagem</th>
                                    <th>Ação</th>
                                </tr>
                                </tfoot>

                                <tbody>
                                @foreach ($PageResponse->response as $sel)
                                    <tr>
                                        <td>{{ $sel->id }}</td>
                                        <td data-sort="{{ $sel->getCreatedAtTimestamp() }}">{{ $sel->created_at }}</td>
                                        <td><b class="font-30">{{ $sel->code }}</b></td>
                                        <td>{{ $sel->getUnitName() }}</td>
                                        <td><b>{{ $sel->name }}</b> <p>{{ $sel->description }}</p></td>
                                        <td>
                                            <a href="{{ $sel->getLinkImage() }}" target="_blank">
                                                <img class="img-responsive thumbnail" src="{{ $sel->getThumbImage() }}">
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            @include('layouts.inc.buttons.edit')
                                            @include('layouts.inc.buttons.delete')
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
            "order": [3, "asc"]
        };

    </script>

    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')

    @include('layouts.inc.validation.js')
@endsection