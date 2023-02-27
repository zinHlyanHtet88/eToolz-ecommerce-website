@extends('welcome')

@section('content')
    <ion-message :user='{{ Auth::user()->id }}'></ion-message>
@endsection
