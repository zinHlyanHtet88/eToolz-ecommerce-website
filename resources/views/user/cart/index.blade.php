@extends('welcome')

@section('content')
    <ion-cart :user='{{ Auth::user()->id }}'></ion-cart>
@endsection