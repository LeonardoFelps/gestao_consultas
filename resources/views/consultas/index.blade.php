@extends('layouts.menu')

@section('conteudo')
    <h1>Lista de Consultas</h1>

    @if($consultas->isEmpty())
        <p>Não há consultas agendadas.</p>
    @else
        <table>
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
                        <td>{{ $consulta->dataehora }}</td>
                        <td>{{ $consulta->descricao }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
