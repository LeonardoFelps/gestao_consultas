@extends('layouts.menu')

@section('conteudo')
<div class="container">
    <!-- Passando dados para o componente Vue -->
    <form-component :medicos='@json($medicos)'></form-component>
</div>
@endsection
