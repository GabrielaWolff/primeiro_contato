@extends('layouts.app')

@section('title',"Comentários do Usuário {$user->name}")

@section('content')
<h1 class="text-2x1 font-semibold leading-tigh py-2">
    Comentários do Usuário {{$user->name }}
    (<a href="{{ route('comments.create', $user->id) }}">+</a>)
</h1>

<form action="{{ route('users.index') }}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button>Pesquisar</button>
</form>

<table>
    <thead>
        <tr>
            <th>
                Conteúdo
            </th>

            <th>
                Visível
            </th>

            <th>
                Editar
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach ($comments as $comment)
    <tr>
        <td>{{ $comment->body }}</td>
        <td>{{ $comment->visible ? 'SIM' : 'NÃO'}}</td>
       <td>
           <a href="{{ route('comments.edit',['user'=>$user->id, 'id'=>$comment->id]) }}">Editar</a>
       </td>


    </li>
    @endforeach
</ul>

@endsection
