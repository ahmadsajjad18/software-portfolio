<header id="home" class="header">
    <div class="overlay"></div>
    <div class="header-content container">
        <h1 class="header-title">
            <span class="up">HI!</span>
            <span class="down">I am {{$home->name ?? 'No name'}}</span>
        </h1>
        <p class="header-subtitle">{{$home->profession ?? 'No profession'}}</p>

        <a href="{{$home->url ?? 'No url'}}" class="btn btn-primary">Visit My Works</a>
    </div>
</header>
