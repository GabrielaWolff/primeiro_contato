@extends('layouts.app')

@section('title','Novo Usuário')

@section('content')
<h1>Novo Artigo</h1>

@include('articles.includes.validation-forms')

<form action={{ route('articles.store') }} method="post" enctype="multipart/form-data">
@csrf
    @include('articles.partials.form')
</form>
@endsection
