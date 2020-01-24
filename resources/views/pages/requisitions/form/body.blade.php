
@if($Data->canShowReasonInfo())
    <div class="row">
        <div class="col-md-12">
            <h5>Negado: </h5>
        <div class="col-md-12">
            <div class="demo-color-box bg-red">
                <div class="color-name">{{$Data->getReason()}}</div>
            </div>
        </div>
        </div>
    </div>
@endif

<h3 class="col-light-blue">Fluxo de Compra</h3>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            @foreach($PageResponse->auxiliar['requisition_breadcrumb'] as $item)
                <li class="{{$item['class']}}"> {{$item['text']}}</li>
            @endforeach
        </ol>
    </div>
</div>
<h3 class="col-light-blue">Requisição de Materiais </h3>
<div class="row">
    <div class="col-md-1 col-sm-6 col-xs-12">
        <h5>Número </h5>
        <p class="m-t-10">{{$Data->id}}</p>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <h5>Cliente </h5>
        <p class="m-t-10">{{$Data->getClientShortName()}}</p>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <h5>Unidade / Obra</h5>
        <p class="m-t-10">{{$Data->getUnitShortName()}} / {{$Data->getJobShortName()}}</p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h5>Autor </h5>
        <p class="m-t-10">{{$Data->getAuthorShortName()}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <h5>Empenho </h5>
        <p class="m-t-10">{{$Data->getShortPlightName()}}</p>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <h5>Grupo / Subgrupo </h5>
        <p class="m-t-10">{{$Data->group->getShortName()}} / {{$Data->subgroup->getShortName()}} </p>
    </div>
    <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-12">
        <h5>Total </h5>
        <h3 class="m-t-10 col-light-green total">{{$Data->getTotalMoney()}}</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h5>Descrição Geral </h5>
        <p class="m-t-10">{{$Data->main_descriptions}}</p>
    </div>
</div>
@if($Data->canShowApproveInfo())
    <h3 class="col-light-blue">Financeiro </h3>
    <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-12">
            <h5>Vencimento </h5>
            <p class="m-t-10">{{$Data->getFormattedDue()}}</p>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <h5>Tipo de Documento </h5>
            <p class="m-t-10">{{$Data->getDocTypeText()}} </p>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <h5>Parcelas </h5>
            <p class="m-t-10">{{$Data->getParcelasText()}}</p>
        </div>
        {{--@if($Data->document_number != NULL)--}}
            <div class="col-md-2 col-sm-6 col-xs-12">
                <h5>Número Documento </h5>
                <p class="m-t-10">{{$Data->getDocumentNumber()}}</p>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <h5>Responsável pelo recebimento </h5>
                <p class="m-t-10">{{$Data->getResponsible()}}</p>
            </div>
        {{--@endif--}}
    </div>
@endif
@if($Data->canShowBuyInfo())
    <h3 class="col-light-blue">Compra </h3>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h5>Contato </h5>
            <p class="m-t-10">{{$Data->getContact()}} </p>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h5>Telefone </h5>
            <p class="m-t-10">{{$Data->getPhone()}}</p>
        </div>
        <div class="col-md-10 col-sm-6 col-xs-12">
            <h5>Endereço </h5>
            <p class="m-t-10">{{$Data->getAddress()}}</p>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <h5>Hora </h5>
            <p class="m-t-10">{{$Data->getHour()}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h5>Observações </h5>
            <p class="m-t-10">{{$Data->observations}}</p>
        </div>
    </div>
@endif
<div class="button-demo">

    @if($Data->canShowCloseBtn())
        {!! Form::open(['route' => array($PageResponse->route . '.close', $Data->id),
                                    'id' => 'form_validation',
            'method' => 'POST']) !!}
        <div class="align-right">
            <button type="submit" class="btn btn-lg bg-green waves-effect">
                <i class="material-icons">close</i> Fechar
            </button>
        </div>
        {{ Form::close() }}
    @endif

    @if($Data->canShowReopenBtn())
        <div class="align-right">
            <button type="button" data-toggle="modal" data-target="#reopenModal"
                    class="btn btn-lg bg-red waves-effect">
                <i class="material-icons">refresh</i> Reabrir Orçamento
            </button>
        </div>
    @endif

    @if($Data->canShowRecotationBtn())
        {!! Form::open(['route' => array($PageResponse->route . '.recotation', $Data->id),
                                    'id' => 'form_validation',
            'method' => 'POST']) !!}
        <div class="align-right">
            <button type="submit" class="btn btn-lg bg-red waves-effect">
                <i class="material-icons">refresh</i> Reabrir Cotação
            </button>
        </div>
        {{ Form::close() }}
    @endif

    @if($Data->canShowCloseCotationBtn())
        {!! Form::open(['route' => array($PageResponse->auxiliar['requisition_route'], $Data->id),
                                    'id' => 'form_validation',
            'method' => 'POST']) !!}
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        {!! Html::decode(Form::label('due', 'Prazo *', array('class' => 'control-label'))) !!}
                        <input type="text" name="due" class="datepicker form-control" placeholder="Escolha o prazo...">
                        {{--{{Form::text('due', old('due'), ['id'=>'due','class'=>'datepicker form-control show-date', 'required'])}}--}}
                        {{--{!! Html::decode(Form::label('due', 'Vencimento *', array('class' => 'form-label'))) !!}--}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        {{Form::select('plight_id', $PageResponse->auxiliar['plights'], [], ['id' => 'plights', 'placeholder' => 'Escolha o Empenho', 'class'=>'form-control select2_single', 'required'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        {!! Html::decode(Form::label('doc_type', 'Tipo do Documento *', array('class' => 'control-label'))) !!}
                        {{Form::select('doc_type', $PageResponse->auxiliar['doc_types'], [], ['id' => 'doc_type', 'placeholder' => 'Escolha o Tipo de Doc.', 'class'=>'form-control select2_single', 'required'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        {!! Html::decode(Form::label('parcelas', 'Parcelas *', array('class' => 'control-label'))) !!}
                        {{Form::select('parcelas', $PageResponse->auxiliar['parcelas'], [], ['id' => 'parcelas', 'placeholder' => 'Escolha as Parcelas.', 'class'=>'form-control select2_single', 'required'])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="align-right">
            <button type="submit" class="btn btn-lg bg-{{$Data->getActionBtnColor()}} waves-effect">
                <i class="material-icons">{{$Data->getActionBtnIcon()}}</i> {{$Data->getActionBtnText()}}
            </button>
        </div>
        {{ Form::close() }}
    @endif

    @if($Data->canShowApproveBtn())
        {!! Form::open(['route' => array($PageResponse->auxiliar['requisition_route'], $Data->id),
                                    'id' => 'form_validation',
            'method' => 'POST']) !!}
            <div class="align-right">
                <button type="submit" class="btn btn-lg bg-{{$Data->getActionBtnColor()}} waves-effect">
                    <i class="material-icons">{{$Data->getActionBtnIcon()}}</i> {{$Data->getActionBtnText()}}
                </button>
            </div>
        {{ Form::close() }}
    @endif

    @if($Data->canShowUnApproveBtn())
        <div class="align-right">
            <button type="submit" data-toggle="modal" data-target="#unapproveForm"
                    class="btn btn-lg bg-red waves-effect">
                <i class="material-icons">clear</i> Não Aprovar
            </button>
        </div>
    @endif

    @if($Data->canShowBuyBtn())
            <h3 class="col-light-green">Compra</h3>
            {!! Form::open(['route' => array($PageResponse->auxiliar['requisition_route'], $Data->id),
                                        'id' => 'form_validation',
                    'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('name', 'Endereço *', array('class' => 'control-label'))) !!}
                                {{Form::text('address', '', ['id'=>'address','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('contact', 'Contato *', array('class' => 'control-label'))) !!}
                                {{Form::text('contact', '', ['id'=>'contact','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('phone', 'Telefone Contato *', array('class' => 'control-label'))) !!}
                                {{Form::text('phone', '', ['id'=>'phone','class'=>'form-control','minlength'=>'3', 'maxlength'=>'30', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('hour', 'Horário *', array('class' => 'control-label'))) !!}
                                {{Form::text('hour', '', ['id'=>'hour','class'=>'form-control hourpicker','minlength'=>'3', 'maxlength'=>'5', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {{Form::textarea('observations','',['placeholder'=>'Observações', 'class'=>'form-control', 'required'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="align-right">
                    <button type="submit" class="btn btn-lg bg-{{$Data->getActionBtnColor()}} waves-effect">
                        <i class="material-icons">{{$Data->getActionBtnIcon()}}</i> {{$Data->getActionBtnText()}}
                    </button>
                </div>
            {{ Form::close() }}
    @endif

    @if($Data->canShowDeliveryBtn())
        {!! Form::open(['route' => array($PageResponse->auxiliar['requisition_route'], $Data->id),
                                    'id' => 'form_validation',
            'method' => 'POST']) !!}
            <div class="align-right">
                <div class="col-md-4 col-sm-6 col-xs-12">

                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        {{Form::text('document_number', old('document_number'), ['placeholder' => 'Número do Documento', 'maxlength' => 50, 'class'=>'form-control', 'required'])}}
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        {{Form::text('responsible', old('responsible'), ['placeholder' => 'Responsável pelo recebimento', 'maxlength' => 100, 'class'=>'form-control', 'required'])}}
                    </div>
                </div>
                <button type="submit" class="btn btn-lg bg-{{$Data->getActionBtnColor()}} waves-effect">
                    <i class="material-icons">{{$Data->getActionBtnIcon()}}</i><span>{{$Data->getActionBtnText()}}</span>
                </button>
            </div>
        {{ Form::close() }}
    @endif
</div>
