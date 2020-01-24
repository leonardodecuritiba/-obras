@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')

    <!-- Bootstrap Select Css -->
    {{--{{Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}--}}

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
                            'method' => 'GET']) !!}
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {{Form::select('client_id', $PageResponse->auxiliar['clients'], [], ['id' => 'clients', 'placeholder' => 'Todos os Clientes', 'class'=>'select2_single ms form-control show-tick'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {{Form::select('job_id', (isset($PageResponse->auxiliar['jobs']) ? $PageResponse->auxiliar['jobs'] : []), [], ['id' => 'job_id', 'placeholder' => 'Todas as Unidade / Obra', 'class'=>'select2_single ms form-control show-tick'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {{Form::select('group_id', $PageResponse->auxiliar['groups'], [], ['id' => 'groups', 'placeholder' => 'Todos os Grupos', 'class'=>'select2_single ms form-control show-tick'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {{Form::select('subgroup_id', [], [], ['id' => 'subgroups', 'placeholder' => 'Todos os SubGrupos', 'class'=>'select2_single ms form-control show-tick'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {{Form::select('plight_id', $PageResponse->auxiliar['plights'], [], ['id' => 'plights', 'placeholder' => 'Todos os Empenhos', 'class'=>'select2_single ms form-control show-tick'])}}
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
                                Listagem ({{$PageResponse->paginate->total()}} Registros)
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
                            <span class="font-25 pull-right">Total: <i class="font-bold col-teal">{{$PageResponse->auxiliar['sum_requisitions_real']}}</i></span>
                            <div class="clearfix"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subgrupo</th>
                                        <th>Empenho</th>
                                        <th>Valor</th>
                                        <th>Data Compra</th>
                                        <th>Nr. Documento</th>
                                        <th>Descrição</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Subgrupo</th>
                                        <th>Empenho</th>
                                        <th>Valor</th>
                                        <th>Data Compra</th>
                                        <th>Nr. Documento</th>
                                        <th>Descrição</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach ($PageResponse->response as $sel)
                                        <tr>
                                            <td>{{ $sel->id }}</td>
                                            <td>{{ $sel->subgroup_name }}</td>
                                            <td>{{ $sel->plight_name }}</td>
                                            <td>{{ $sel->total_formatted }}</td>
                                            <td>{{ $sel->buy_at_formatted }}</td>
                                            <td>{{ $sel->document_number }}</td>
                                            <td>{{ $sel->main_descriptions }}</td>
                                            {{--<td><span class="label bg-{{ $sel->getStatusColor() }}">{{ $sel->getStatusText()}}</span></td>--}}
                                            {{--<td><span class="label bg-{{ $sel->getPaymentStatusColor() }}">{{ $sel->getPaymentStatusText()}}</span></td>--}}
                                            {{--<td class="text-right">--}}
                                                {{--<a href="{{(route($PageResponse->route.'.show',$sel->id))}}" target="_blank"--}}
                                                   {{--class="btn btn-simple btn-primary btn-xs btn-icon show"--}}
                                                   {{--data-toggle="tooltip"--}}
                                                   {{--data-placement="top"--}}
                                                   {{--title="Visualizar"><i class="material-icons"> remove_red_eye</i></a>--}}
                                                {{--@include('layouts.inc.buttons.delete')--}}
                                            {{--</td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $PageResponse->paginate->appends(Request::except('page'))->links() }}
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