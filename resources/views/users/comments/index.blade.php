@extends('layouts.app')

@section('title', "Comentários do Usuário {$user->name}")

@section('content')
    <h1>
      Comentários do Usuário {{ $user->name }}
    </h1>

    <ul>
      @foreach($comments as $comment)
        <li>
          {{ $user->body }} - 
          {{ $user->visible }}
          | <a href="{{ route('users.edit', $user->id) }}">Editar</a>  
          | <a href="{{ route('users.show', $user->id) }}">Detalhes</a>  
        </li>
      @endforeach
    </ul>   
@endsection