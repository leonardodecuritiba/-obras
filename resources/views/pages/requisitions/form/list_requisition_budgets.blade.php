<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Orç. Marca </th>
            <th>Orç. Qtd </th>
            <th>Fornecedor</th>
            <th>Marca</th>
            <th>Valor</th>
            <th>Qtd</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Orç. Marca </th>
            <th>Orç. Qtd </th>
            <th>Fornecedor</th>
            <th>Marca</th>
            <th>Valor</th>
            <th>Qtd</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach ($Products as $sel)
            <tr>
                <td>{{ $sel->id }}</td>
                <td>{{ $sel->getProductShortCodeName() }}</td>
                <td>{{ $sel->getBrandName() }}</td>
                <td>{{ $sel->getQuantityUnitFormatted() }}</td>
                <td>{{ $sel->buy_supplier_name}}</td>
                <td>{{ $sel->buy_brand }}</td>
                <td data-order="{{ $sel->buy_value }}">{{ $sel->buy_value_money }}</td>
                <td>{{ $sel->buy_quantity }}</td>
                <td data-order="{{ $sel->buy_total }}">{{ $sel->buy_total_money }}</td>
                <td class="text-right">
                    @if($Data->canShowRemBudgetBtn())
                        {!! Form::open(['route'=>array($PageResponse->route . '.budget_rem', $sel->id),
                                'id' => 'form_validation','method' => 'POST']) !!}
                        {{ Form::hidden('id',$sel->id) }}
                        <button class="btn btn-simple btn-xs btn-danger btn-icon"><i
                                    class="material-icons">remove_circle_outline</i></button>
                        {{ Form::close() }}
                    @endif
                        @if($Data->canShowAddProductToBudgetBtn() && (!$sel->buy))
                            <button class="btn btn-simple btn-xs btn-success btn-icon" data-dados='{{ $sel->getDataJson() }}'
                                    data-toggle="modal" data-target="#buyProduct"><i
                                        class="material-icons">attach_money</i></button>
                        @elseif($Data->canShowEditProductToBudgetBtn() && ($sel->buy))
                            {{--<button class="btn btn-simple btn-xs btn-warning btn-icon" data-dados='{{ $sel->getDataJson() }}'--}}
                            {{--data-toggle="modal" data-target="#buyProduct"><i--}}
                            {{--class="material-icons">mode_edit</i></button>--}}
                            <a href="{{route($PageResponse->route . '.rem', $sel->buy_id)}}"
                               class="btn btn-simple btn-xs btn-danger btn-icon"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Cancelar"><i
                                        class="material-icons">money_off</i></a>
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>