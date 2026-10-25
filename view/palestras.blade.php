<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Palestras</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 900px }
        .flash { padding: 10px; border: 1px solid #cfc; background: #efe; margin-bottom: 10px }
        .erro { color: #b00; font-size: 0.95rem }
        form > div { margin-bottom: 10px }
        table { width: 100%; border-collapse: collapse; margin-top: 20px }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left }
        th { background: #f7f7f7 }
        a.button, button { display: inline-block; padding: 8px 12px; border: 1px solid #ccc; background: #eee; text-decoration: none; color: inherit; font: inherit }
    </style>
</head>
<body>
    <h1>Sistema de Presença – Palestras</h1>

    @if(session('sucesso'))
        <div class="flash">{{ session('sucesso') }}</div>
    @endif

    <h2>{{ $editando ? 'Editar palestra' : 'Nova palestra' }}</h2>

    <form method="POST" action="{{ $editando ? route('palestras.update', $editando) : route('palestras.store') }}">
        @csrf
        @if($editando) @method('PUT') @endif

        <div>
            <label>Título</label><br>
            <input type="text" name="titulo" value="{{ old('titulo', $editando->titulo ?? '') }}">
            @error('titulo') <div class="erro">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Palestrante</label><br>
            <input type="text" name="palestrante" value="{{ old('palestrante', $editando->palestrante ?? '') }}">
            @error('palestrante') <div class="erro">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Data e hora</label><br>
            <input type="datetime-local" name="data" value="{{ old('data', $editando?->data?->format('Y-m-d\TH:i')) }}">
            @error('data') <div class="erro">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Local</label><br>
            <input type="text" name="local" value="{{ old('local', $editando->local ?? '') }}">
            @error('local') <div class="erro">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Descrição</label><br>
            <textarea name="descricao" rows="3">{{ old('descricao', $editando->descricao ?? '') }}</textarea>
            @error('descricao') <div class="erro">{{ $message }}</div> @enderror
        </div>

        <button type="submit">{{ $editando ? 'Atualizar' : 'Salvar' }}</button>
        @if($editando) <a class="button" href="{{ route('palestras.index') }}">Cancelar</a> @endif
    </form>

    <h2>Palestras cadastradas</h2>

    @if($palestras->isEmpty())
        <p>Nenhuma palestra cadastrada.</p>
    @else
        <table>
            <tr><th>Título</th><th>Palestrante</th><th>Data</th><th>Local</th><th>Ações</th></tr>
            @foreach($palestras as $p)
                <tr>
                    <td>{{ $p->titulo }}</td>
                    <td>{{ $p->palestrante }}</td>
                    <td>{{ $p->data->format('d/m/Y H:i') }}</td>
                    <td>{{ $p->local }}</td>
                    <td>
                        <a class="button" href="{{ route('palestras.index', ['editar' => $p->id]) }}">Editar</a>
                        <form action="{{ route('palestras.destroy', $p) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Excluir esta palestra?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>
