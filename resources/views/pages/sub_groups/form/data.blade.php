<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                 {{Form::select('group_id', $PageResponse->auxiliar['groups'], old('group_id',(isset($Data) ? $Data->group_id : (isset($PageResponse->auxiliar['group_id']) ? $PageResponse->auxiliar['group_id'] : ''))), ['placeholder' => 'Escolha o grupo', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
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