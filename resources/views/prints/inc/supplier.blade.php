<tr class="fundo_titulo">
    <th class="linha_titulo" colspan="4">FORNECEDOR #{{ $supplier->id }}</th>
</tr>
<tr class="campo">
    <th width="10%">ID</th>
    <th width="30%">FORNECEDOR</th>
    <th colspan="2">ENDEREÇO</th>
</tr>
<tr class="value-small">
    <td >{{ $supplier->id }}</td>
    <td >{{ $supplier->getCompanyName() }}</td>
    <td colspan="2">{{ $supplier->getFullAddress() }}</td>
</tr>
<tr class="campo">
    <th colspan="2">CNPJ</th>
    <th colspan="2">INSCRIÇÃO ESTADUAL</th>
</tr>
<tr class="value-small">
    <td colspan="2">{{ $supplier->getShortDocument() }}</td>
    <td colspan="2">{{ $supplier->getIe() }}</td>
</tr>
<tr class="campo">
    <th colspan="2">BANCO</th>
    <th colspan="1">AGÊNCIA</th>
    <th colspan="1">CONTA</th>
</tr>
<tr class="value-small">
    <th colspan="2">{{ $supplier->bank }}</th>
    <th colspan="1">{{ $supplier->agency }}</th>
    <th colspan="1">{{ $supplier->account }}</th>
</tr>