@extends('layouts.app')

@section('title',"Editar o Usuário {$user->name}")

@section('content')
<h1>Editar o Usuário {{ $user->name }}</h1>


@include('users.includes.validation-forms')


<form action="{{ route('users.update', $user->id) }}" method="post">
   @method('PUT')
   @include('users.partials.form')
</form>
@endsection
