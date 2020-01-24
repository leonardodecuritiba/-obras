
<div class="modal fade" id="reopenModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => array($PageResponse->route . '.reopen', $Data->id),
                                        'id' => 'form_validation',
                'method' => 'POST']) !!}

                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Reabrir Requisição</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h4 class="font-bold col-orange">Razão</h4>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="form-line">
                                    {{Form::textarea('reason', old('reason'), ['id'=>'reason', 'placeholder' => 'Digite a razão','class'=>'form-control', 'required'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link waves-effect" data-dismiss="modal">Fechar</a>
                    <button type="submit" class="btn btn-success waves-effect">Reabrir</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>