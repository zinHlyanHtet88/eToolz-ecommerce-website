@extends('welcome')

@section('content')
    <ion-edit-user-profile :user="{{ Auth::user()->id }}"></ion-edit-user-profile>
@endsection
