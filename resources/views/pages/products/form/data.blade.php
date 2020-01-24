@if(isset($Data))
    <div id="aniimated-thumbnials" class="row clearfix">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
            <a href="{{ $Data->getLinkImage() }}" data-sub-html="Demo Description">
                <img class="img-responsive thumbnail" src="{{ $Data->getThumbImage() }}">
            </a>
        </div>
    </div>
@endif
<div class="row clearfix">
    <div class="col-sm-2">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('code', old('code',(isset($Data) ? $Data->code : '')), ['id'=>'code','class'=>'form-control','minlength'=>'3', 'maxlength'=>'20', 'required'])}}
                {!! Html::decode(Form::label('code', 'Código *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('name', old('name',(isset($Data) ? $Data->name : '')), ['id'=>'name','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                {!! Html::decode(Form::label('name', 'Nome *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::select('unit_id', $PageResponse->auxiliar['units'], old('unit_id',(isset($Data) ? $Data->unit_id : (isset($PageResponse->auxiliar['unit_id']) ? $PageResponse->auxiliar['unit_id'] : ''))), ['placeholder' => 'Escolha a Unidade', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::text('description', old('description',(isset($Data) ? $Data->description : '')), ['id'=>'description','class'=>'form-control','minlength'=>'3', 'maxlength'=>'500'])}}
                {!! Html::decode(Form::label('description', 'Descrição *', array('class' => 'form-label'))) !!}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <input name="image" type="file" class="form-control">
        </div>
    </div>
</div>
