@if(!isset($Data))
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="form-group form-float">
                <div class="form-line">
                    {{Form::select('role_id', $PageResponse->auxiliar['roles'], '', ['placeholder' => 'Escolha o Nível de Permissão', 'class'=>'form-control select2_single', 'required'])}}
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row clearfix">
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('email', old('email',(isset($Data) ? $Data->getEmail() : '')), ['id'=>'email','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required', 'aria-required'=>'true'])}}
                {!! Html::decode(Form::label('email', 'Email *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('password', '', ['id'=>'password','class'=>'form-control','minlength'=>'6', 'maxlength'=>'100'])}}
                {!! Html::decode(Form::label('password', (isset($Data) ? 'Alterar Senha' : 'Senha'), array('class' => 'form-label'),(isset($Data) ? 'required' : ''))) !!}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('name', old('name',(isset($Data) ? $Data->getShortName() : '')), ['id'=>'name','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                {!! Html::decode(Form::label('name', 'Nome *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('description', old('description',(isset($Data) ? $Data->description : '')), ['id'=>'description','class'=>'form-control', 'maxlength'=>'100'])}}
                {!! Html::decode(Form::label('description', 'Sobre mim', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>