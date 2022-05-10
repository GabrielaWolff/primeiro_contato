@extends('layouts.app')

@section('title',"Novo Comentário Para o Usuário ($user->name)")

@section('content')
<h1>Novo Comentário Para o Usuário {{ $user->name }}</h1>

@include('users.includes.validation-forms')

<form action={{ route('comments.store', $user->id) }} method="post">
@csrf
    @include('users.comments.partials.form')
</form>
@endsection
