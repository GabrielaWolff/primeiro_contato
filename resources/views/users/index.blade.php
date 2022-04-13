@extends('layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
    <h1 class="text-2x1 font-semibold leading-tigh py-2">
        Listagem dos Usuários
        (<a href="{{ route('users.create') }}">+</a>)
    </h1>

    <form action="{{ route('users.index') }}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>

    <ul>
        @foreach ($users as $user)
            <li>
                @if ($user->image)
                    <img src="{{ url("storage/{$user->image}") }}" alt="{{ $user->name }}" class="object-cover w-20">
                @else
                    <img src="{{ url("images/favicon.ico") }}" alt="{{ $user->name }}" class="object-cover w-ppp20">
                @endif
                {{ $user->name }}
                {{ $user->email }}
                | <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                | <a href="{{ route('users.show', $user->id) }}">Detalhes</a>
                | <a href="{{ route('comments.index', $user->id) }}">Anotações({{ $user->comments->count() }})</a>

            </li>
        @endforeach
    </ul>
    <div>
        {{ $users->appends([
                'search' => request()->get('search', ''),
            ])->links() }}
    </div>

@endsection
