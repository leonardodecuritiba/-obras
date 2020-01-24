
<div class="modal fade" id="buyProduct" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => [$PageResponse->route.'.add'],
                            'id' => 'form_validation',
                'method' => 'POST']) !!}
            {{Form::hidden('requisition_budget_id', '')}}

            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Comprar Produto</h4>
            </div>
            <div class="modal-body">
                <div class="row m-b-30" id="description">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>Produto: <b id="code_name"></b></p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>Marca: <b id="brand_name"></b></p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>Quantidade: <b id="quantity"></b></p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>Unidade: <b id="unit"></b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4 class="font-bold col-orange">Opções</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line" tabindex="-2">
                                {{Form::select('supplier_id', $PageResponse->auxiliar['suppliers'], [], ['id' => 'suppliers', 'placeholder' => 'Escolha o Fornecedor', 'class'=>'form-control select2_single', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line" tabindex="-2">
                                {{Form::select('brand_id', $PageResponse->auxiliar['brands'], [], ['id' => 'brands', 'placeholder' => 'Escolha a Marca', 'class'=>'form-control select2_single', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="form-line" >
                                {{Form::text('value', old('value'), ['id'=>'value', 'placeholder' => 'Valor','data-rule' => "currency",'class'=>'form-control show-price', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                {{Form::text('quantity', old('quantity'), ['id'=>'quantity', 'placeholder' => 'Qtd *','data-rule' => "quantity",'class'=>'form-control show-float', 'required'])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-link waves-effect" data-dismiss="modal">Fechar</a>
                <button type="submit" class="btn btn-success waves-effect">Salvar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>