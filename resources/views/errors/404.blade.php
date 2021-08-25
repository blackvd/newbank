@extends('errors::minimal')

@section('title', __('Not Found'))

@section('code')
    <img src="{{ asset('assets/img/notfound.png') }}" alt="">
@endsection

@section('message', __('Not Found'))
