@extends('layouts.app')

@section('title',"Editar o Comentário do Usuário {$user->name}")

@section('content')
<h1>Editar o Comentário do Usuário {{ $user->name }}</h1>


@include('users.includes.validation-forms')


<form action="{{ route('comments.update', $comment->id) }}" method="post">
   @method('PUT')
   @include('users.comments.partials.form')
</form>
@endsection
