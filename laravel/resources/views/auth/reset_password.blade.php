@extends('auth.layout')
@section('content')
    <Reset_password :token="'{{$token}}'" :email="'{{$email}}'"></Reset_password>
@endsection
