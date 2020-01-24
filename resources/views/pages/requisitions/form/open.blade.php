<h2 class="card-inside-title">Funcionário</h2>
<p class="m-b-30 font-20 font-bold col-teal">{{Auth::user()->name}}</p>
<div class="row clearfix">
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::select('clients', $PageResponse->auxiliar['clients'], [], ['id' => 'clients', 'placeholder' => 'Escolha o Cliente', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::select('job_id', [], [], ['id' => 'job_id', 'placeholder' => 'Escolha a Unidade / Obra', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::select('group_id', $PageResponse->auxiliar['groups'], [], ['id' => 'groups', 'placeholder' => 'Escolha o Grupo', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-float">
            <div class="form-line">
                {{Form::select('subgroup_id', [], [], ['id' => 'subgroups', 'placeholder' => 'Escolha o SubGrupo', 'class'=>'form-control select2_single', 'required'])}}
            </div>
        </div>
    </div>
</div>
<h2 class="card-inside-title">Descrição Geral</h2>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
                {{Form::textarea('main_descriptions', '', ['rows' => '4', 'placeholder' => 'Descrição Geral', 'class'=>'form-control no-resize', 'required'])}}
            </div>
        </div>
    </div>
</div>
