@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')
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
                                'method' => 'POST']) !!}
                        @endif
                        @include($PageResponse->main_folder . '.form.data')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Validation -->
        @if(isset($Data))
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Subgrupos
                                <a href="{{route('sub_groups.create',$Data->id)}}" class="btn bg-indigo waves-effect pull-right">
                                    <i class="material-icons">add_circle</i>
                                    <span>Novo Subgrupo</span>
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            @if(count($Data->subgroups) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cadastro</th>
                                            <th>Nome</th>
                                            <th>Ação</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Cadastro</th>
                                            <th>Nome</th>
                                            <th>Ação</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($Data->subgroups as $sel)
                                            <tr>
                                                <td>{{ $sel->id }}</td>
                                                <td>{{ $sel->created_at }}</td>
                                                <td>{{ $sel->name }}</td>
                                                <td class="text-right">
                                                    @include('layouts.inc.buttons.edit',['field_edit_route' => route('sub_groups.edit',$sel->id)])
                                                    @include('layouts.inc.buttons.delete',['field_delete_route' => route('sub_groups.destroy',$sel->id), 'field_delete' => 'Grupo'])
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            @else
                                <h6>Nenhum Subgrupo Cadastrado</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script_content')
    <!-- Jquery Validation Plugin Css -->
    @include('layouts.inc.validation.js')
@endsection