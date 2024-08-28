<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Home;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function dashboard(){
        $about        = About::first();
        $home         = Home::first();
        $services     = Service::all();
        $portfolios   = Portfolio::all();
        $testimonials = Testimonial::all();
        $socialLinks  = SocialLink::all();
        return view('frontend.master',compact(
              'home',
            'about',
                       'services',
                       'portfolios',
                       'testimonials',
                       'socialLinks'
        ));
    }
}
