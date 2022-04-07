@extends('layouts.app')

@section('title','Novo Usuário')

@section('content')
<h1>Novo Usuário</h1>

@include('users.includes.validation-forms')

<form action={{ route('users.store') }} method="post">
@csrf
    @include('users.partials.form')
</form>
@endsection
