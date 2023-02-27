@extends('admin.layout.main')
@section('content')
    <ion-profile-page :user='{{ Auth::user()->id }}'></ion-profile-page>
@endsection
