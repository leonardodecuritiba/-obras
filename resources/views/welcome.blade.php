@extends('layouts.app')

@section('title', 'Clientes')

{{--@section('route', route('cliente'))--}}

@section('page_content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <div class="text">Clientes</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Models\Clients\Client::count()}}" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="info-box bg-deep-purple hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">account_balance</i>
                    </div>
                    <div class="content">
                        <div class="text">Fornecedores</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Models\Suppliers\Supplier::count()}}" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">money</i>
                    </div>
                    <div class="content">
                        <div class="text">Obras</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Models\Clients\Job::count()}}" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">list</i>
                    </div>
                    <div class="content">
                        <div class="text">Produtos</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Models\Commons\Product::count()}}" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="info-box bg-amber hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="content">
                        <div class="text">Requisições</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Models\Requisitions\Requisition::count()}}" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
    </div>
@endsection


@section('script_content')
    <!-- Jquery CountTo Plugin Js -->
    {{Html::script('bower_components/adminbsb-materialdesign/plugins/jquery-countto/jquery.countTo.js')}}
    {{Html::script('bower_components/adminbsb-materialdesign/js/pages/index.js')}}

@endsection