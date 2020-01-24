<h2 class="card-inside-title">Dados Bancários</h2>
<div class="row clearfix">
    <div class="col-sm-4">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('bank', 'Banco *', array('class' => 'control-label'))) !!}
                {{Form::text('bank', old('bank',(isset($Data) ? $Data->bank : "")), ['id'=>'bank','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100'])}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('agency', 'Agência *', array('class' => 'control-label'))) !!}
                {{Form::text('agency', old('agency',(isset($Data) ? $Data->agency : "")), ['id'=>'agency','class'=>'form-control','minlength'=>'3', 'maxlength'=>'10'])}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('account', 'Conta *', array('class' => 'control-label'))) !!}
                {{Form::text('account', old('account',(isset($Data) ? $Data->account : "")), ['id'=>'account','class'=>'form-control','minlength'=>'3', 'maxlength'=>'10'])}}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('favored_name', 'Nome do Favorecido *', array('class' => 'control-label'))) !!}
                {{Form::text('favored_name', old('favored_name',(isset($Data) ? $Data->favored_name : "")), ['id'=>'favored_name','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100'])}}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('favored_cnpj', 'CNPJ do Favorecido *', array('class' => 'control-label'))) !!}
                {{Form::text('favored_cnpj', old('favored_cnpj',(isset($Data) ? $Data->getFormattedFavoredCnpj() : "")), ['id'=>'favored_cnpj','class'=>'form-control show-cnpj','minlength'=>'3', 'maxlength'=>'20'])}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {!! Html::decode(Form::label('favored_cpf', 'CPF do Favorecido *', array('class' => 'control-label'))) !!}
                {{Form::text('favored_cpf', old('favored_cpf',(isset($Data) ? $Data->getFormattedFavoredCpf() : "")), ['id'=>'favored_cpf','class'=>'form-control show-cpf','minlength'=>'3', 'maxlength'=>'20'])}}
            </div>
        </div>
    </div>
</div>
