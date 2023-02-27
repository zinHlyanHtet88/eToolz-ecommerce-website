@extends('welcome')

@section('content')
    <ion-noti-message :user='{{ Auth::user()->id }}'></ion-noti-message>
@endsection
