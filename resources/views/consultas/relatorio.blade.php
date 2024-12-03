@extends('layouts.menu')

@section('conteudo')
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
                @foreach ($agendamentosPorPacienteEMedico as $item)
                    <tr>
                        <td>{{ $item->dia }}</td>
                        <td>{{ $item->paciente }}</td>
                        <td>{{ $item->medico }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection