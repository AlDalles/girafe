@extends('layout')

@section('title', 'Post')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('content')
    <div class="conteiner conteiner__create">
        <div class="form__create">
            <h1 class="form__create__title">{{$value}}</h1> <!--тут для редактирования поменять "Create Ad" на Edit-->
           @if($value==="Create")
            <form action="/" class="create__ad" method="post" enctype="multipart/form-data">
                @else

                    <form action="/edit/{{$advert->id}}" class="create__ad" method="post">
                @endif

                @csrf
                @method($method)
                        <label for="image"class="create__ad__title">Image</label>
                        <input type="file" id="image_patch" name="image_patch" class="create__ad__input" placeholder="Image">
                        @if($errors->has('image_patch'))
                            @foreach($errors->get('image_patch') as $error)
                                <div class="warning">
                                    <p class="warning_inner">{{$error}}</p>
                                </div>
                            @endforeach
                        @endif
                <label for="titel"class="create__ad__title" >Title</label>
                <input name="title" type="text" id="titel" class="create__ad__input" placeholder="Title" value="{{old('title') ?? $advert->title}}">
                @if($errors->has('title'))
                    @foreach($errors->get('title') as $error)
                                <div class="warning">
                                    <p class="warning_inner">{{$error}}</p>
                                </div>
                    @endforeach
                    @endif
                <label for="description"class="create__ad__description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description">{{old('description') ?? $advert->description}}</textarea>
                @if($errors->has('description'))
                    @foreach($errors->get('description') as $error)
                                <div class="warning">
                                    <p class="warning_inner">{{$error}}</p>
                                </div>
                    @endforeach
                @endif
                <div class="create__ad__button">
                    <input type="submit" value="{{$value}}" class="create__ad__button__submit"> <!--тут для редактирования поменять value="Create" на value="Save"-->
                </div>
            </form>
        </div>
    </div>

@endsection
