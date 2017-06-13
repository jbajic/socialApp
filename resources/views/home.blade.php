@extends('templates/default')
@section('content')
    {{--<h3>Welcome</h3>--}}
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox" data-spy="affix-top">
            <div class="item active">
                <img src="{{ asset('/images/social1.jpg') }}" alt="Social image" >
                <div class="carousel-caption carouselText">
                    Talk to your friends!
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('/images/social2.jpg') }}" alt="Social image">
                <div class="carousel-caption carouselText">
                    Tell us what is on your mind!
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('images/social3.jpg') }}" alt="Social image">
                <div class="carousel-caption carouselText">
                    Share ideas!
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection