@extends('layouts.menu')

@section('conteudo')
    <div class="container">
        <h1>Lista de Consultas</h1>

        <!-- Exibe mensagem de sucesso, se houver -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário de busca para filtrar consultas -->
        <form method="GET" action="{{ route('consulta.home') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <!-- Campo de busca por paciente -->
                    <input type="text" name="paciente" class="form-control" placeholder="Buscar por paciente" value="{{ request('paciente') }}">
                </div>
                <div class="col-md-4">
                    <!-- Campo de busca por médico -->
                    <input type="text" name="medico" class="form-control" placeholder="Buscar por médico" value="{{ request('medico') }}">
                </div>
                <div class="col-md-4">
                    <!-- Botão de submissão do formulário -->
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Verifica se há consultas -->
        @if($consultas->isEmpty())
            <!-- Caso não existam consultas agendadas -->
            <div class="alert alert-info">
                Não há consultas agendadas.
            </div>
        @else
            

            <!-- Exibição de filtros aplicados, se houver -->
            @if(request('paciente') || request('medico'))
                <div class="alert alert-info">
                    <strong>Filtros Aplicados:</strong>
                    @if(request('paciente')) <span>Paciente: {{ request('paciente') }}</span> @endif
                    @if(request('medico')) <span>Médico: {{ request('medico') }}</span> @endif
                </div>
            @endif
        
            <!-- Tabela para exibir consultas -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Data e Hora</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteração sobre as consultas disponíveis -->
                    @foreach($consultas as $consulta)
                        <tr>
                            <td>{{ $consulta->paciente }}</td>
                            <td>{{ $consulta->medico }}</td>
                            <td>{{ \Carbon\Carbon::parse($consulta->dataehora)->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Botão para abrir o modal com a descrição -->
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDescricao{{ $consulta->id }}">
                                    Ver Descrição
                                </button>                                    
                            </td>
                            <td>
                                <!-- Formulário para excluir uma consulta -->
                                <form method="POST" action="{{ route('consulta.destroy', $consulta->id) }}" style="display: inline;">
                                    @method('DELETE') <!-- Método HTTP DELETE -->
                                    @csrf <!-- Proteção contra ataques CSRF -->
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja excluir esta consulta?')">Excluir</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal para exibir a descrição da consulta -->
                        <div class="modal fade" id="modalDescricao{{ $consulta->id }}" tabindex="-1" aria-labelledby="modalDescricaoLabel{{ $consulta->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDescricaoLabel{{ $consulta->id }}">Descrição da Consulta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Exibe a descrição da consulta -->
                                        <p>{{ $consulta->descricao }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Botões do modal -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <a href="{{ route('consulta.edit', $consulta->id) }}" class="btn btn-primary">Editar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Links de paginação -->
            <div class="d-flex justify-content-center">
                {{ $consultas->links() }}
            </div>
                            
        @endif
    </div>
@endsection
