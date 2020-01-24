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
                {{$PageResponse->page_title}}
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
                        {!! Form::open(['route' => $PageResponse->route.'.open',
                            'id' => 'form_validation',
                            'method' => 'POST']) !!}
                            @include($PageResponse->main_folder . '.form.open')
                            <div class="align-right">
                                <button class="btn btn-lg btn-primary waves-effect" type="submit">Salvar</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Validation -->
    </div>
@endsection

@section('script_content')

    <!-- Select2 -->
    @include('layouts.inc.select2.js')

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: 'resolve'
            });
        });
    </script>
    <!-- Jquery Validation Plugin Css -->
    @include('layouts.inc.validation.js')
    <script>
        $_INPUT_CLIENT_ = 'select#clients';
        $_INPUT_UNIT_ = 'select#units';
        $_INPUT_JOB_ = 'select#job_id';
    </script>
    @include('pages.commons.inc.clients-jobs-ajax-js')

    <script>
        $_INPUT_GROUP_ = 'select#groups';
        $_INPUT_SUBGROUP_ = 'select#subgroups';
    </script>
    @include('pages.commons.inc.groups-subgroups-ajax-js')
@endsection