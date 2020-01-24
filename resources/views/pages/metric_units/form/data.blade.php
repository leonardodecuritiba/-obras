<div class="row clearfix">
    <div class="col-sm-4">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('code', old('code',(isset($Data) ? $Data->code : '')), ['id'=>'code','class'=>'form-control','minlength'=>'1', 'maxlength'=>'20', 'required'])}}
                {!! Html::decode(Form::label('code', 'Código *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('description', old('description',(isset($Data) ? $Data->description : '')), ['id'=>'description','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                {!! Html::decode(Form::label('description', 'Descrição *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>
<div class="align-right">
    <button class="btn btn-lg btn-primary waves-effect" type="submit">Salvar</button>
</div>