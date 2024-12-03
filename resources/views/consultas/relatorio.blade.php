@extends('layouts.menu')

@section('conteudo')
    <!-- Componente Vue.js para exibição de um gráfico ou relatório de agendamentos -->
    <!-- O componente recebe os dados serializados em JSON através da variável $agendamentosPorDia -->
    <relatorio-agendamentos :dados="{{ json_encode($agendamentosPorDia) }}"></relatorio-agendamentos>

    <!-- Lista de Agendamentos -->
    <div class="container mt-5">
        <h2>Lista de Agendamentos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iteração sobre a variável $agendamentosPorPacienteEMedico para exibir os dados em uma tabela -->
                @foreach ($agendamentosPorPacienteEMedico as $item)
                    <tr>
                        <!-- Exibição do dia do agendamento -->
                        <td>{{ $item->dia }}</td>
                        <!-- Exibição do nome do paciente -->
                        <td>{{ $item->paciente }}</td>
                        <!-- Exibição do nome do médico -->
                        <td>{{ $item->medico }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
