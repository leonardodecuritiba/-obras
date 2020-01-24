{!! Form::open(['route' => $route,'method' => 'POST',
                                'id' => 'form_validation']) !!}
    <div class="row">
        <div class="col-md-5 col-sm-6 col-xs-12">
            <div class="form-group">
                <div class="form-line">
                    {{--<select name="product_id" id="products" class="ms select2_single">--}}
{{--                        @foreach($PageResponse->auxiliar['products'] as $product)--}}
                        {{--<option value="{{$product['id']}}">{{$product['description']}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    {{Form::select('product_id', $PageResponse->auxiliar['products'], [], ['id' => 'products', 'placeholder' => 'Escolha o Produto', 'class'=>'form-control select2_single', 'required'])}}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <div class="form-line">
                    {{Form::select('brand_id', $PageResponse->auxiliar['brands'], [], ['id' => 'brands', 'placeholder' => 'Escolha a Marca', 'class'=>'form-control select2_single', 'required'])}}
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="form-group">
                <div class="form-line">
                    {{Form::text('quantity', old('quantity'), ['id'=>'quantity', 'placeholder' => 'Quantidade *','data-rule' => "quantity",'class'=>'form-control show-float', 'required'])}}
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-lg btn-block bg-blue waves-effect">
                <i class="material-icons">add_box</i> Adicionar
            </button>
        </div>
    </div>
{{ Form::close() }}