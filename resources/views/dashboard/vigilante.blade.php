@extends('layouts.app')

@section('content')
    <h1>Dashboard Vigilante</h1>
    <p>Bienvenido, {{ auth()->user()->name }}</p>
@endsection
