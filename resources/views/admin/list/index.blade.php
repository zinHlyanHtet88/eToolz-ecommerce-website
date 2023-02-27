@extends('admin.layout.main')

@section('content')
    <ion-users-list :user='{{ Auth::user()->id }}'></ion-users-list>
@endsection

