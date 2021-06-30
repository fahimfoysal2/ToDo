@extends('layouts.app')

@section('title', 'Update ToDo')

@section('content')
    <todo-edit :todo="{{$todo}}"></todo-edit>
@endsection
