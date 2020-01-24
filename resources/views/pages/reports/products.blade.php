@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')

    <!-- Bootstrap Select Css -->
{{--    {{Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}--}}

    <!-- Jquery DataTable Plugin Css -->
    @include('layouts.inc.datatable.css')

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
    <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Listagem
                        </h2>
                    </div>
                    <div class="body">
                        {!! Form::open(['route' => $PageResponse->route.'.report',
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
                                <button type="submit" name="search" value="1" class="btn btn-info btn-block waves-effect">
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
        @if($PageResponse->response != [])
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Listagem ({{$PageResponse->response->total()}} Registros)
                                @if(count($PageResponse->response) > 0)
                                    <a href="{{ URL::route($PageResponse->route.'.print',Request::all()) }}" target="_blank" class="btn bg-grey waves-effect pull-right">
                                        <i class="material-icons">print</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <a href="{{ URL::route($PageResponse->route.'.export',Request::all()) }}" target="_blank" class="btn bg-green waves-effect pull-right m-r-10">
                                        <i class="material-icons">file_download</i>
                                        <span>Exportar</span>
                                    </a>
                                @endif
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cadastro</th>
                                        <th>Código</th>
                                        <th>Unidade</th>
                                        <th>Nome / Descrição</th>
                                        <th>Imagem</th>
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
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach ($PageResponse->response as $sel)
                                        <tr>
                                            <td>{{ $sel->id }}</td>
                                            <td>{{ $sel->created_at }}</td>
                                            <td><b class="font-30">{{ $sel->code }}</b></td>
                                            <td>{{ $sel->getUnitName() }}</td>
                                            <td><b>{{ $sel->name }}</b> <p>{{ $sel->description }}</p></td>
                                            <td>
                                                <a href="{{ $sel->getLinkImage() }}" target="_blank">
                                                    <img class="img-responsive thumbnail" src="{{ $sel->getThumbImage() }}">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $PageResponse->response->appends(Request::except('page'))->links() }}

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- #END# Exportable Table -->
    </div>
@endsection


@section('script_content')


    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- Select2 -->
    @include('layouts.inc.select2.js')

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: 'resolve'
            });
        });
    </script>

    <script>
        $_INPUT_CLIENT_ = 'select#clients';
        $_INPUT_JOB_ = 'select#job_id';
        $(document).ready(function(){
            // $($_INPUT_CLIENT_).selectpicker();
            // $($_INPUT_JOB_).selectpicker();

            //CHANGING UNIT - FILL JOBS
            $($_INPUT_CLIENT_).change(function(){
                var $this = $_INPUT_CLIENT_;
                var $this_child = $_INPUT_JOB_;
                var text_child = 'Escolha a Unidade / Obra';
                var _url = '{{route('ajax.get.client-jobs')}}';

                $($this_child).empty();
                $($this_child).append("<option value=''>" + text_child + "</option>");
                // $($this_child).val('').change().selectpicker('render');

                if($($this).val() == ""){
                    return false;
                }

                $.ajax({
                    url: _url,
                    data: {id : $($this).val()},
                    type: 'GET',
//                    dataType: "json",
                    beforeSend: function (xhr, textStatus) {
                        loadingCard('show',$this);
                    },
                    error: function (xhr, textStatus) {
                        console.log('xhr-error: ' + xhr.responseText);
                        console.log('textStatus-error: ' + textStatus);
                        loadingCard('hide',$this);
                    },
                    success: function (json) {
                        console.log(json);
                        $(json).each(function(i,v){
                            $($this_child).append('<option value="' + v.id + '">' + v.text + '</option>')
                        });
                        // $($this_child).selectpicker("refresh");
                        $_LOADING_.waitMe('hide');
                    }
                });
            })
        })
    </script>

    @include('layouts.inc.validation.js')
@endsection