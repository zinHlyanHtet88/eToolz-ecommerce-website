@extends('welcome')

@section('content')
    <ion-product-detail :user='{{ Auth::user()->id }}'></ion-product-detail>
@endsection