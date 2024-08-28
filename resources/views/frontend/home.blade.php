<header id="home" class="header">
    <div class="overlay"></div>
    <div class="header-content container">
        <h1 class="header-title">
            <span class="up">HI!</span>
            <span class="down">I am {{$home->name}}</span>
        </h1>
        <p class="header-subtitle">{{$home->profession}}</p>

        <a href="{{$home->url}}" class="btn btn-primary">Visit My Works</a>
    </div>
</header>
