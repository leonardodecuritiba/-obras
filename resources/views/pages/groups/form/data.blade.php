<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('name', old('name',(isset($Data) ? $Data->name : '')), ['id'=>'name','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                {!! Html::decode(Form::label('name', 'Nome *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>
<div class="align-right">
    <button class="btn btn-lg btn-primary waves-effect" type="submit">Salvar</button>
</div>