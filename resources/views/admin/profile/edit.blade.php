@extends('admin.layout.main')

@section('content')
    <ion-edit-profile :user='{{ Auth::user()->id }}'></ion-edit-profile>
@endsection
