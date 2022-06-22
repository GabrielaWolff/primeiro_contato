@extends('layouts.app')

@section('title',"Editar o Artigo {$article->name}")

@section('content')
<h1>Editar o Artigo {{ $article->name }}</h1>


@include('articles.includes.validation-forms')


<form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data">
   @method('PUT')
   @include('users.partials.form')
</form>
@endsection
