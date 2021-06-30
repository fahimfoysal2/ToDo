@extends('layouts.app')

@section('title', 'ToDo')

@section('content')
    <todo-list :fetched-todos="{{$todos}}"></todo-list>
@endsection
