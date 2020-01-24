@extends('layouts.app')

@section('title', $PageResponse->page_title)

{{--@section('route', route('cliente'))--}}

@section('style_content')
    {{Html::style('bower_components/adminbsb-materialdesign/plugins/jquery-spinner/css/bootstrap-spinner.css')}}

    <!-- Bootstrap Select Css -->
    {{--{{Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}--}}

    <!-- Jquery DataTable Plugin Css -->
    @include('layouts.inc.datatable.css')

    <!-- Sweetalert Css -->
    @include('layouts.inc.sweetalert.css')

    <!-- Select2 -->
    @include('layouts.inc.select2.css')

    <!-- Bootstrap Material Datetime Picker Css -->
    {{Html::style('bower_components/adminbsb-materialdesign/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}
@endsection

@section('page_modals')
    @include('pages.requisitions.modal.buy_product')

    @if($Data->canShowUnApproveForm())
        @include('pages.requisitions.modal.unapprove')
    @endif

    @if($Data->canShowReopenBtn())
        @include('pages.requisitions.modal.reopen')
    @endif
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="@if($Data->getTabActive('tab_requisition')) active @endif">
                                <a href="#tab_requisition" data-toggle="tab" aria-expanded="true">
                                    <i class="material-icons">home</i>
                                </a>
                            </li>
                            <li role="presentation" class="@if($Data->getTabActive('tab_requisition_products')) active @endif">
                                <a href="#tab_requisition_products" data-toggle="tab" aria-expanded="false">
                                    <i class="material-icons">assignment</i>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade @if($Data->getTabActive('tab_requisition')) active in @endif" id="tab_requisition">
                                <div class="card">
                                    <div class="header">
                                        <h2><b>#{{$Data->id}}</b> - {{$PageResponse->main_title}}
                                            @if($Data->canShowPrintBuyedBtn())
                                                <a href="{{route('requisitions_buyed.print', $Data->id)}}" target="_blank" class="btn bg-grey waves-effect pull-right">
                                                    <i class="material-icons">print</i>
                                                    <span>Imprimir</span>
                                                </a>
                                                {{--<a href="{{route('requisitions_budget.export',$Data->id)}}" target="_blank" class="btn bg-green waves-effect pull-right m-r-10">--}}
                                                {{--<i class="material-icons">file_download</i>--}}
                                                {{--<span>Exportar</span>--}}
                                                {{--</a>--}}
                                            @endif
                                            @if($Data->canShowDeleteRequisition())
                                                <a href="{{route('requisitions.remove', $Data->id)}}" target="_blank" class="btn bg-red waves-effect pull-right">
                                                    <i class="material-icons">remove_circle</i>
                                                    <span>Remover Requisição</span>
                                                </a>
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="header bg-{{$Data->getStatusColor()}}">
                                        <h2>STATUS: <i>{{$Data->getStatusText()}} {{$Data->getTimeAction()}}</i></h2>
                                    </div>

                                    <div class="body">
                                        @include('pages.requisitions.form.body')
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade @if($Data->getTabActive('tab_requisition_products')) active in @endif" id="tab_requisition_products">
                                <div class="card">
                                    <div class="header">
                                        <h2>Requisição - Listagem de Produtos
                                            @if($Data->canShowPrintBudgetBtn())
                                                <a href="{{route('requisitions_budget.print', $Data->id)}}" target="_blank" class="btn bg-grey waves-effect pull-right">
                                                    <i class="material-icons">print</i>
                                                    <span>Imprimir</span>
                                                </a>
                                                {{--<a href="{{route('requisitions_budget.export',$Data->id)}}" target="_blank" class="btn bg-green waves-effect pull-right m-r-10">--}}
                                                {{--<i class="material-icons">file_download</i>--}}
                                                {{--<span>Exportar</span>--}}
                                                {{--</a>--}}
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="body">
                                        @include('pages.requisitions.form.list_requisition_budgets',[
                                            'Products' => $Data->requisitionBudgetsFormatted()])
                                        @if($Data->canShowAddBudgetBtn())
                                            @include('pages.requisitions.form.product',[
                                                'route'=>array($PageResponse->route . '.budget_add', $Data->id)])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Validation -->
    </div>
@endsection

@section('script_content')

    {{Html::script('bower_components/adminbsb-materialdesign/plugins/jquery-spinner/js/jquery.spinner.js')}}

    <!-- Jquery DataTable Plugin Js -->
    @include('layouts.inc.datatable.js')

    <!-- SweetAlert Plugin Js -->
    @include('layouts.inc.sweetalert.js')

    <!-- Jquery Validation Plugin Css -->
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

    {!! Html::script('bower_components/jquery-mask-plugin/dist/jquery.mask.min.js') !!}
    <script type="text/javascript">
        function initMaskMoneyValorReal(selector) {
            $(selector).mask('#.##0,00', {reverse: true});
        }
        function initMaskInt(selector) {
            $(selector).mask('#', {reverse: true});
        }
        function initMaskFloat(selector) {
            $(selector).mask('#.##0,00', {reverse: true});
        }
        $(document).ready(function () {
            initMaskMoneyValorReal($(".show-price"));
        });
        $(document).ready(function () {
            initMaskInt($(".show-int"));
        });
        $(document).ready(function () {
            initMaskFloat($(".show-float"));
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#buyProduct').on('show.bs.modal', function (event) {
//                var $this = $(this);
                var $btn = event.relatedTarget;
                var $descriptions = $(this).find('div#description');
                var dados = $($btn).data('dados');
                $(this).find('input[name=requisition_budget_id]').val(dados.id);
                $(this).find('input[name=quantity]').val(dados.quantity);
                $($descriptions).find('b#brand_name').html(dados.brand_name);
                $($descriptions).find('b#code_name').html(dados.code_name);
                $($descriptions).find('b#quantity').html(dados.quantity);
                $($descriptions).find('b#unit').html(dados.unit);

                console.log($($btn).data('dados'));

            })
        });
    </script>

    <!-- Moment Plugin Js -->
    {{Html::script('bower_components/adminbsb-materialdesign/plugins/momentjs/moment.js')}}
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    {{Html::script('bower_components/adminbsb-materialdesign/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}
    <script>
        $(function () {

            $('.datepicker').bootstrapMaterialDatePicker({
//                format: 'dddd DD MMMM YYYY',
                format: 'DD/MM/YYYY',
                clearButton: true,
                weekStart: 1,
                time: false
            });
            $('.hourpicker').bootstrapMaterialDatePicker({
                format: 'HH:mm',
                clearButton: true,
                date: false
            });
        });
    </script>
@endsection