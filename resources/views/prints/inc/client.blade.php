<table border="1" class="table table-condensed table-bordered">
    <tr class="fundo_titulo">
        <th class="linha_titulo" colspan="4">CLIENTE</th>
    </tr>
    <tr class="campo">
        <th width="10%">ID</th>
        <th width="30%">CLIENTE</th>
        <th colspan="2">ENDEREÇO</th>
    </tr>
    <tr class="value-small">
        <td >{{ $Requisition->getClientId() }}</td>
        <td >{{ $Requisition->getClientShortName() }}</td>
        <td colspan="2">{{ $Requisition->getUnitFullAddress() }}</td>
    </tr>
    <tr class="campo">
        <th colspan="2">CNPJ</th>
        <th colspan="2">INSCRIÇÃO ESTADUAL</th>
    </tr>
    <tr class="value-small">
        <td colspan="2">{{ $Requisition->getClientShortDocument() }}</td>
        <td colspan="2">{{ $Requisition->getClientIe() }}</td>
    </tr>

    {{--<tr class="campo">--}}
        {{--<th colspan="2">BANCO</th>--}}
        {{--<th colspan="1">AGÊNCIA</th>--}}
        {{--<th colspan="1">CONTA</th>--}}
    {{--</tr>--}}
    {{--<tr class="value-small">--}}
        {{--<th colspan="2">{{ $Requisition->getClientBank() }}</th>--}}
        {{--<th colspan="1">{{ $Requisition->getClientAgency() }}</th>--}}
        {{--<th colspan="1">{{ $Requisition->getClientAccount() }}</th>--}}
    {{--</tr>--}}
</table>