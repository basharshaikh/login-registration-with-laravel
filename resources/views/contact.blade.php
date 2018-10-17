@extends('layouts.app')



@section('content')

    <h1>Contact page</h1>


        <ul>
        @foreach($people as $person)


                <li>{{$person}}</li>


        @endforeach
        </ul>


@stop