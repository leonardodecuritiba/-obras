<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('name', old('name',(isset($Data) ? $Data->name : '')), ['id'=>'name','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                {!! Html::decode(Form::label('name', 'Nome *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('descriptions', old('descriptions',(isset($Data) ? $Data->descriptions : '')), ['id'=>'descriptions','class'=>'form-control','minlength'=>'3', 'maxlength'=>'200', 'required'])}}
                {!! Html::decode(Form::label('descriptions', 'Descrição *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>