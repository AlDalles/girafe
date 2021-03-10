<div class="main">
    <div class="main__ad">
        <div class="main__ad__datatime">
            <div class="main__ad__datatime__data">{{$advert->created_at->isoFormat('HH:mm')}}</div>
            <div class="main__ad__datatime__time">{{$advert->created_at->isoFormat('DD/MM/YYYY')}}</div>
        </div>
        <div class="main__ad__title">
            <a href="{{route('show',$advert->id)}}" class="main__ad__title__inner">{{$advert->title}}</a>
            @can('delete',$advert)
                <form action="/delete/{{$advert->id}}" class="main__ad__title__form"
                      method="post">@csrf @method('delete')
                    <input type="submit" class="main__ad__title__delete" value="X">
                    @method('delete')

                </form>
            @endcan
        </div>

        <div class="main__ad__author">
            <a href="{{route('searchByUser',$advert->user->id)}}"
               class="main__ad__author__title">{{$advert->user->name}}</a>
            @can('update',$advert)
                <form action="/edit/{{$advert->id}}" class="main__ad__title__form">
                    <input type="submit" class="main__ad__title__delete" value="edit">
                </form>
            @endcan
        </div>
        <div class="timeago">{{$advert->created_at->diffForHumans()}}</div>
        <div class="main__ad__description">
            {{$advert->description}}
        </div>
    </div>
</div>
