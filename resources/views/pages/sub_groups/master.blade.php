@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')
    <!-- Bootstrap Select Css -->
    {{--{{Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}--}}
    <!-- Select2 -->
    @include('layouts.inc.select2.css')
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
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Validation -->
    </div>
@endsection

@section('script_content')
    <!-- Jquery Validation Plugin Css -->
    @include('layouts.inc.validation.js')

    <!-- Select2 -->
    @include('layouts.inc.select2.js')

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: 'resolve'
            });
        });
    </script>
@endsection