@extends('layout')

@section('title', 'Homepage')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('content')
@foreach($adverts as $advert)
   @include('pages.advert.show',['advert'=>$advert])
@endforeach

@include('paginator',['pages'=>$adverts])
@endsection
