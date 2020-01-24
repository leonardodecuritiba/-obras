@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')

    <!-- Jquery DataTable Plugin Css -->
    @include('layouts.inc.datatable.css')

    <!-- Sweetalert Css -->
    @include('layouts.inc.sweetalert.css')

    <style>
        .hide{
            display: none !important;
        }
    </style>

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
                        <h2>Dados Principais</h2>
                    </div>
                    <div class="body">
                        <h2 class="card-inside-title">Tipo de Cliente</h2>
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
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <input name="type" type="radio" class="with-gap" value="1" @if(!isset($Data)) checked @endif id="pj"/>
                                    <label for="pj">Pessoa Jurídica</label>
                                    <input name="type" type="radio" class="with-gap" value="0" id="pf"/>
                                    <label for="pf">Pessoa Física</label>
                                </div>
                            </div>

                            @include($PageResponse->main_folder.'.form.pj')
                            @include($PageResponse->main_folder.'.form.pf')
                            @include('pages.commons.form.address')
                            @include('pages.commons.form.contact')

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
                        <h2>Unidades
                            <a href="{{route('units.create',$Data->id)}}" class="btn bg-indigo waves-effect pull-right">
                                <i class="material-icons">add_circle</i>
                                <span>Nova Unidade</span>
                            </a>
                        </h2>
                    </div>
                    <div class="body">
                        @if(count($Data->units) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Qtd. Obras</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastro</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Qtd. Obras</th>
                                    <th>Ação</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach ($Data->units as $sel)
                                    <tr>
                                        <td>{{ $sel->id }}</td>
                                        <td>{{ $sel->created_at }}</td>
                                        <td>{{ $sel->name }}</td>
                                        <td>{{ $sel->descriptions }}</td>
                                        <td>{{ $sel->jobs->count() }}</td>
                                        <td class="text-right">
                                            @include('layouts.inc.buttons.edit',['field_edit_route' => route('units.edit',$sel->id)])
                                            @include('layouts.inc.buttons.delete',['field_delete_route' => route('units.destroy',$sel->id), 'field_delete' => 'Unidade'])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        @else
                            <h6>Nenhuma Unidade Cadastrada</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('script_content')
    <script>
        function toggleType(val){
            if(val == "1"){
                $('input[name="type"]#pj').prop('checked',true);
                $('section.section-pf').hide();
                $('section.section-pj').fadeIn('fast');
                $('section.section-pj').find('input').not("input#ie, input#foundation").attr('required',true);
                $('section.section-pf').find('input').attr('required',false);
//                $('section.section-pf').find('input').val("");
            } else {
                $('input[name="type"]#pf').prop('checked',true);
                $('section.section-pj').hide();
                $('section.section-pf').fadeIn('fast');
                $('section.section-pf').find('input').attr('required',true);
                $('section.section-pj').find('input').attr('required',false);
//                $('section.section-pj').find('input').val("");
            }
        }
        $(document).ready(function(){
            $('input[name="type"]').change(function() {
                toggleType($(this).val());
            });
            var type = '{{(isset($Data)) ? $Data->type : 1}}';
            toggleType(type);
        })
    </script>
    <!-- Jquery Validation Plugin Js -->
    @include('layouts.inc.validation.js')

    <!-- Jquery InputMask Js -->
    @include('layouts.inc.inputmask.js')

    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')

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
@endsection