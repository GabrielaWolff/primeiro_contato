@extends('layouts.app')

@section('title','Listagem do Artigo')

@section('content')
<h1>Listagem do Artigo {{ $article->name }}</h1>

<ul>
    <li>{{ $article->name  }}</li>
    <li>{{ $article->email  }}</li>
 </ul>

 <form action="{{ route ('articles.destroy', $article->id) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit">Deletar</button>
 </form>
