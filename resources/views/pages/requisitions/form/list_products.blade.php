<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Marca</th>
            <th>Qtd</th>
            <th>Valor</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Marca</th>
            <th>Qtd</th>
            <th>Valor</th>
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
                <td>{{ $sel->quantity }}</td>
                <td data-order="{{ $sel->value }}">{{ $sel->getValueMoney() }}</td>
                <td data-order="{{ $sel->value }}">{{ $sel->getTotalValueMoney() }}</td>
                <td class="text-right">
                    @if($Data->canShowRemProductBtn())
                        {!! Form::open(['route' => array($PageResponse->route . '.rem', $sel->id),
                                'id' => 'form_validation','method' => 'POST']) !!}
                        {{ Form::hidden('id',$sel->id) }}
                        <button class="btn btn-simple btn-xs btn-danger btn-icon"><i
                                    class="material-icons">remove_circle_outline</i></button>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>