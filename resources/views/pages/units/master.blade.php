@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')
    <!-- Jquery DataTable Plugin Css -->
    @include('layouts.inc.datatable.css')
    <!-- Bootstrap Select Css -->
    {{--{{Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}--}}
    <!-- Select2 -->
    @include('layouts.inc.select2.css')

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
    <!-- Advanced Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{$PageResponse->main_title}}</h2>
                    </div>
                    <div class="body">
                        @if(isset($Data))
                            {{Form::model($Data,
                            array(
                                'route' => array($PageResponse->route.'.update', $Data->id),
                                'files' => true,
                                'id' => 'form_validation',
                                'method' => 'PATCH'
                            )
                            )}}
                        @else
                            {!! Form::open(['route' => $PageResponse->route.'.store',
                                'files' => true,
                                'id' => 'form_validation',
                                'method' => 'POST']) !!}
                            {{ Form::hidden('client_id',$PageResponse->auxiliar['client_id']) }}
                        @endif
                            @include($PageResponse->main_folder . '.form.data')
                            @include('pages.commons.form.address')
                            <div class="align-right">
                                <button class="btn btn-lg btn-primary waves-effect" type="submit">Salvar</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        @if(isset($Data))
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Obras
                                <a href="{{route('jobs.create',$Data->id)}}" class="btn bg-indigo waves-effect pull-right">
                                    <i class="material-icons">add_circle</i>
                                    <span>Nova Obra</span>
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            @if(count($Data->jobs) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cadastro</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Cadastro</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach ($Data->jobs as $sel)
                                        <tr>
                                            <td>{{ $sel->id }}</td>
                                            <td>{{ $sel->created_at }}</td>
                                            <td>{{ $sel->name }}</td>
                                            <td>{{ $sel->descriptions }}</td>
                                            <td class="text-right">
                                                @include('layouts.inc.buttons.edit',['field_edit_route' => route('jobs.edit',$sel->id)])
                                                @include('layouts.inc.buttons.delete',['field_delete_route' => route('jobs.destroy',$sel->id), 'field_delete' => 'Obra'])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <h6>Nenhuma Obra Cadastrada</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- #END# Advanced Validation -->
    </div>
@endsection

@section('script_content')

    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- Jquery Validation Plugin Js -->
    @include('layouts.inc.validation.js')

    <!-- Jquery InputMask Js -->
    @include('layouts.inc.inputmask.js')

    <!-- Select2 -->
    @include('layouts.inc.select2.js')

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: 'resolve'
            });
        });
    </script>


    @include('layouts.inc.address.js')
    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')
@endsection