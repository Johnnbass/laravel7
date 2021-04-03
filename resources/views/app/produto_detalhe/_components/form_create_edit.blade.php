@if (isset($produto_detalhe->id))
    <form method="post" action="{{ route('produto-detalhe.update', ['produto_detalhe' => $produto_detalhe->id]) }}">
    @method('PUT')
@else
    <form method="post" action="{{ route('produto-detalhe.store') }}">
@endif
@csrf
    <input type="text" name="produto_id" value="{{ $produto_detalhe->produto_id ?? old('produto_id') }}" class="borda-preta" placeholder="ID do Produto">
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
    
    <input type="text" name="comprimento" value="{{ $produto_detalhe->comprimento ?? old('comprimento') }}" class="borda-preta" placeholder="Comprimento">
    {{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}
    
    <input type="text" name="largura" value="{{ $produto_detalhe->largura ?? old('largura') }}" class="borda-preta" placeholder="Largura">
    {{ $errors->has('largura') ? $errors->first('largura') : '' }}

    <input type="text" name="altura" value="{{ $produto_detalhe->altura ?? old('altura') }}" class="borda-preta" placeholder="Altura">
    {{ $errors->has('altura') ? $errors->first('altura') : '' }}
    
    <select name="unidade_id" class="borda-preta">
        <option value="">-- Selecione a Unidade de Medida --</option>
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{ ($produto_detalhe->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
        @endforeach
    </select>
    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
    
    <button type="submit" class="borda-preta">Cadastrar</button>
</form>