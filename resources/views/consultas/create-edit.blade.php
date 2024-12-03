@extends('layouts.menu')

@section('conteudo')
<div class="consulta-form">
    <!-- Exibe mensagem de erro, se houver -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>@if(isset($consulta)) Editar Consulta @else Adicionar Consulta @endif</h2>

    <form action="{{ isset($consulta) ? route('consulta.update', $consulta->id) : route('consulta.store') }}" method="POST">
        @csrf
        @if(isset($consulta))
            @method('PUT')
        @endif

        <!-- Campo: Nome do Paciente -->
        <div class="form-group">
            <label for="paciente">Nome do Paciente</label>
            <input type="text" id="paciente" name="paciente" class="form-control" value="{{ old('paciente', isset($consulta) ? $consulta->paciente : '') }}" required>
            @error('paciente')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Médico -->
        <div class="form-group">
            <label for="medico">Selecione o(a) Médico(a)</label>
            <select id="medico" name="medico" class="form-control" required>
                <option value="" disabled>Selecione um(a) médico(a)</option>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->nome }}" {{ old('medico', isset($consulta) ? $consulta->medico : '') == $medico->nome ? 'selected' : '' }}>
                        {{ $medico->especializacao }} - {{ $medico->nome }}
                    </option>
                @endforeach
            </select>
            @error('medico')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Data e Hora -->
        <div class="form-group">
            <label for="dataehora">Data e Hora</label>
            <input type="datetime-local" id="dataehora" name="dataehora" class="form-control" value="{{ old('dataehora', isset($consulta) ? $consulta->dataehora : '') }}" required>
            @error('dataehora')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo: Observações -->
        <div class="form-group">
            <label for="descricao">Observações</label>
            <textarea id="descricao" name="descricao" class="form-control" placeholder="Digite observações (opcional)">{{ old('descricao', isset($consulta) ? $consulta->descricao : '') }}</textarea>
            @error('descricao')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botões -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                @if(isset($consulta)) Salvar Alterações @else Adicionar Consulta @endif
            </button>
            <a href="{{ route('consulta.home') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
