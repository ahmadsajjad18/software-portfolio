<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Meyawo landing page.">
    <meta name="author" content="Devcrud">
    <title>Meyawo Landing page | Free Bootstrap 4.3.x landing page</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Meyawo main styles -->
    <link rel="stylesheet" href="assets/css/meyawo.css">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- MDB CSS -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>



</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

<!-- Page Navbar -->
<nav class="custom-navbar" data-spy="affix" data-offset-top="20">
    <div class="container">
        <a class="logo" href="#">Meyawo</a>
        <ul class="nav">
            <li class="item">
                <a class="link" href="#home">Home</a>
            </li>
            <li class="item">
                <a class="link" href="#about">About</a>
            </li>
            <li class="item">
                <a class="link" href="#portfolio">Portfolio</a>
            </li>
            <li class="item">
                <a class="link" href="#testmonial">Testmonial</a>
            </li>
            <li class="item">
                <a class="link" href="#contact">Contact</a>
            </li>
            <li class="item ml-md-3">
                <a href="components.html" class="btn btn-primary">Components</a>
            </li>
        </ul>
        <a href="javascript:void(0)" id="nav-toggle" class="hamburger hamburger--elastic">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </a>
    </div>
</nav><!-- End of Page Navbar -->

<!-- page header -->
@include('frontend.home', ['home' => $home])
<!-- end of page header -->


<!-- about section -->
@include('frontend.about', ['about' => $about])
 <!-- end of about section -->

<!-- service section -->
@include('frontend.service',['services'=> $services])
<!-- end of service section -->

<!-- portfolio section -->
@include('frontend.portfolio',['portfolios', $portfolios])
<!-- end of portfolio section -->

<!-- pricing section -->
@include('frontend.pricing')
<!-- end of pricing section -->

<!-- section -->
<section class="section-sm bg-primary">
    <!-- container -->
    <div class="container text-center text-sm-left">
        <!-- row -->
        <div class="row align-items-center">
            <div class="col-sm offset-md-1 mb-4 mb-md-0">
                <h6 class="title text-light">Want to work with me?</h6>
                <p class="m-0 text-light">Always feel Free to Contact & Hire me</p>
            </div>
            <div class="col-sm offset-sm-2 offset-md-3">
                <a href="#contact" class="btn btn-lg my-font btn-light rounded">Hire Me</a>
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section> <!-- end of section -->

<!-- testimonial section -->
@include('frontend.testimonial',['testimonial',$testimonials])
<!-- end of testimonial section -->

<!-- contact section -->
@include('frontend.contact')
<!-- end of contact section -->
<!-- footer -->
<footer class="bg-gray-100 text-white py-4">
    <div class="container mx-auto text-center">
        <div class="d-flex justify-content-center space-x-4">
            @foreach($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" class="text-gray-400 mx-2 hover:text-white">
                    @if($link->name == 'facebook')
                        <i class="fab fa-facebook-f"></i>
                    @elseif($link->name == 'twitter')
                        <i class="fab fa-twitter"></i>
                    @elseif($link->name == 'linkedin')
                        <i class="fab fa-linkedin-in"></i>
                    @elseif($link->name == 'youtube')
                        <i class="fab fa-youtube"></i>
                    @elseif($link->name == 'instagram')
                        <i class="fab fa-instagram"></i>
                    @endif

                </a>
            @endforeach
        </div>
    </div>
</footer>

 <!-- end of page footer -->

<!-- core  -->
<script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
<script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

<!-- bootstrap 3 affix -->

<!-- Meyawo js -->
<script src="assets/js/meyawo.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- MDB JS -->




</body>

</html>
