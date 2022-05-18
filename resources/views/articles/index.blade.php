@extends('layouts.app')

@section('title', 'Listagem dos Artigos')

@section('content')
    <h1 class="text-2x1 font-semibold leading-tigh py-2">
        Listagem dos Artigos
        (<a href="{{ route('articles.create') }}">+</a>)
    </h1>

    <form action="{{ route('articles.index') }}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>

    <ul>
        @foreach ($articles as $article)
            <li>
                {{ $article->name }}
                | <a href="{{ route('articles.edit', $article->id) }}">Editar</a>
                | <a href="{{ route('articles.show', $article->id) }}">Detalhes</a>
                | <a href="{{ route('comments.index', $article->id) }}">Anotações({{ $article->comments->count() }})</a>

            </li>
        @endforeach
    </ul>
    <div>
        {{ $articles->appends([
                'search' => request()->get('search', ''),
            ])->links() }}
    </div>

@endsection
