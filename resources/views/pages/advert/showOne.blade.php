@extends('layout')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@section('content')
<div class="main">
    <div class="main__ad">
        <div class="main__ad__datatime">
            <div class="main__ad__datatime__data">{{$advert->created_at->isoFormat('HH:mm')}}</div>
            <div class="main__ad__datatime__time">{{$advert->created_at->isoFormat('DD/MM/YYYY')}}</div>
        </div>
        <div class="main__ad__title">
            <a href="{{route('show',$advert)}}" class="main__ad__title__inner">{{$advert->title}}</a>
            @can('delete',$advert)
            <form action="{{route('destroy',$advert)}}" class="main__ad__title__form" method="post">@csrf
                <input type="submit"  class="main__ad__title__delete" value="X">
                @method('delete')
            </form>

            @endcan
        </div>
        <div class="main__ad__author">
            <a href="#" class="main__ad__author__title">{{$advert->user->name}}</a>
            @can('update',$advert)<form action="{{route('edit',$advert)}}" class="main__ad__title__form">
                <input type="submit"  class="main__ad__title__delete" value="edit">
            </form>
                @endcan
        </div>
        <div>
            <div class="main__ad__image">
                <img src="{{asset($advert->image_patch)}}" alt="Image Ad" class="main__ad__image__inner"><!--в src это путь к картинке-->
            </div>

        </div>
        <div class="main__ad__description main__ad__description-item">
            {{$advert->description}}
        </div>
    </div>
    <div class="create">
        <a href="{{route('index')}}" class="create__link">Index</a>
    </div>
</div>
    @endsection
