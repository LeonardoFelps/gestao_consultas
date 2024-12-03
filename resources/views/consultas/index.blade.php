@extends('layouts.menu')

@section('conteudo')
    <h1>Lista de Consultas</h1>

    <!-- Exibe mensagem de sucesso, se houver -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($consultas->isEmpty())
        <div class="alert alert-info">
            Não há consultas agendadas.
        </div>
    @else
        <div id="app">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Data e Hora</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultas as $consulta)
                        <tr>
                            <td>{{ $consulta->paciente }}</td>
                            <td>{{ $consulta->medico }}</td>
                            <td>{{ \Carbon\Carbon::parse($consulta->dataehora)->format('d/m/Y H:i') }}</td>
                            <td>
                                <button @click="toggleDescription({{ $consulta->id }})" class="btn btn-info btn-sm">
                                    Ver Descrição
                                </button>

                                <div v-if="activeConsultaId === {{ $consulta->id }}">
                                    <p>{{ $consulta->descricao }}</p>
                                    <a :href="'{{ route('consulta.edit', '') }}/' + {{ $consulta->id }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form :action="'{{ route('consulta.destroy', '') }}/' + {{ $consulta->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                activeConsultaId: null,
            },
            methods: {
                toggleDescription(id) {
                    if (this.activeConsultaId === id) {
                        this.activeConsultaId = null;
                    } else {
                        this.activeConsultaId = id;
                    }
                }
            }
        });
    </script>
@endsection
