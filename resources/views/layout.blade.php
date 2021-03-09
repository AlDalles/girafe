<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')

    <title>Document</title>
</head>
<body>
<div class="conteiner">
    <div class="header">
        <div class="title">
            <span class="one">G</span>
            <span class="two">i</span>
            <span class="one">r</span>
            <span class="two">a</span>
            <span class="one">f</span>
            <span class="two">e</span>
        </div>

        @guest()
            <form action="{{route('login')}}" class="log-in" method="post">
                @csrf
                <p ty class="log-in__title style-all">Log in</p>
                <input type="text" class="log-in__nama__user style-all" name='name' placeholder="Username">
                @if ($errors->has('name'))
                    @foreach($errors->get('name') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach
                @endif
                <input type="password" class="log-in__password style-all" name='password' placeholder="Password">
                @if ($errors->has('password'))
                    @foreach($errors->get('password') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach
                @endif
                <input type="submit" value="Log in" class="button_log">
            </form>
        @endguest
        @auth()
            <div class="button__nav">
                <div class="user__name user__inner">
                    <p class="user__name__inner"><a
                            href="{{route('searchByUser',Auth::user()->id)}}">{{Auth::user()->name}}</a></p>
                </div>
                @if(!isset($value))
                    <div class="create user__inner">
                        <a href="{{route('create')}}" class="create__link create__link__bg">Create Ad</a>
                    </div>@endif
                <div class="create user__inner">
                    <a href="{{route('logout')}}" class="create__link">Log out</a>
                </div>

            </div>




        @endauth
    </div>

    @yield('content')
    @yield('paginator')


</div>

</body>
</html>
