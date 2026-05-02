@extends('layouts.app')

@section('content')
<h2>You are invited to join</h2>

<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Password: {{ $password }}</p>

<p>
    <a href="{{ url('/login') }}">Login Here</a>
</p>
@endsection