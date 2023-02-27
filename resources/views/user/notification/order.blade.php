@extends('welcome')

@section('content')
    <ion-noti-order :user='{{ Auth::user()->id }}'></ion-noti-order>
@endsection
