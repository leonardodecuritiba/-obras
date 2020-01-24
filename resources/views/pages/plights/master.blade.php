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
                                'id' => 'form_validation',
                                'method' => 'POST']) !!}
                        @endif
                            @include($PageResponse->main_folder . '.form.data')
                            <div class="align-right">
                                <button class="btn btn-lg btn-primary waves-effect" type="submit">Salvar</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_content')
    <!-- Jquery Validation Plugin Css -->
    @include('layouts.inc.validation.js')
@endsection