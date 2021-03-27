@if (isset($produto->id))
    <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
    @method('PUT')
@else
    <form method="post" action="{{ route('produto.store') }}">
@endif
@csrf
    <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" class="borda-preta" placeholder="Nome">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
    
    <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" class="borda-preta" placeholder="Descrição">
    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
    
    <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" class="borda-preta" placeholder="Peso">
    {{ $errors->has('peso') ? $errors->first('peso') : '' }}
    
    <select name="unidade_id" class="borda-preta">
        <option value="">-- Selecione a Unidade de Medida --</option>
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
        @endforeach
    </select>
    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
    
    <button type="submit" class="borda-preta">Cadastrar</button>
</form>