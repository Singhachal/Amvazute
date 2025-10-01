@extends('front.layouts.main')
@section('content')
   
    <section class="difference-section pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="contact-wrapper">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <h2 class="heading">{!! __('messages.about_title') !!}</h2>
                                <p class="text-14">{{ __('messages.about_desc1') }}</p>
                                <p class="text-14">{{ __('messages.about_desc2') }}</p>

                                <p class="text-14">{{ __('messages.about_desc3') }} </p>

                                <p class="text-14">{{ __('messages.about_desc4') }}</p>
                             </div>
                            <div class="col-lg-6">
                                <img src="/front/asset/img/home/about.jpg" alt="" height="480px" width="100%"
                                    class="ps-5 pt-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row g-4 ">
                <div class="col-lg-12 text-center ">
                    <h2 class="heading ">{!! __('messages.about_title2') !!}</h2>
                        <div class="d-flex justify-content-center">
                    <p class="text-14 width-define">{{ __('messages.about_short_desc') }}
                    </p>
                        </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <i class="fa-regular fa-camera fs-5 text-primary "></i>&emsp;
                            <h3 class="fs-6 fw-bold">Our Vision</h3>
                        </div>

                        <p class=" text-14">{{ __('messages.vission_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <i class="fa-brands fa-space-awesome fs-5 text-warning"></i>&emsp;
                            <h3 class="fs-6 fw-bold">Our Mission</h3>
                        </div>
                        <p class="text-14">{{ __('messages.mission_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="background: black; color:white;">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6">
                    <h2 class="heading text-white">{!! __('messages.about_share_post') !!}</h2>
                        <p class="text-14 width-define">{{ __('messages.about_share_post_desc') }}
                    </p>
                    <ul class="ps-0">
                        <li class="d-flex">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <p class="text-14">{{ __('messages.about_share_post1') }}
                            </p>
                        </li>
                        <li class="d-flex">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <p class="text-14">{{ __('messages.about_share_post2') }}</p>
                        </li>
                        <li class="d-flex">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <p class="text-14">{{ __('messages.about_share_post3') }} </p>
                        </li>
                        <li class="d-flex">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <p class="text-14">{{ __('messages.about_share_post4') }}</p>
                        </li>
                        <li class="d-flex">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <p class="text-14">{{ __('messages.about_share_post5') }}
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 ">
                    <img src="/front/asset/img/home/about2.jpg" alt="" class="img-responsive-here" height="400px"
                        width="100%">
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="heading">{!! __('messages.about_helf_title') !!}</h2>
                    <div class="d-flex justify-content-center">
                        <p class="text-14 width-define">{{ __('messages.about_helf_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-1">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <h3 class="fs-6 fw-bold">
                                {{ __('messages.about_stay') }}
                                </h3>
                        </div>

                        <p class=" m-0 text-14">{{ __('messages.about_stay_desc') }}.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <h3 class="fs-6 fw-bold">{{ __('messages.about_prometed') }}</h3>
                        </div>

                        <p class=" m-0 text-14">{{ __('messages.about_prometed_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <h3 class="fs-6 fw-bold">{{ __('messages.about_accidental') }}</h3>
                        </div>

                        <p class=" m-0 text-14">{{ __('messages.about_accidental_desc') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card  bg-white p-3  rounded">
                        <div class="d-flex align-item-center mb-2">
                            <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                            <h3 class="fs-6 fw-bold">{{ __('messages.about_social') }}</h3>
                        </div>

                        <p class=" m-0 text-14">{{ __('messages.about_social_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center  heading mb-3">{!! __('messages.about_blog_heading') !!}</h2>
                    <div class="d-flex justify-content-center">

                    <p class="text-center mb-4 text-14 width-define">{!! __('messages.about_blog_desc') !!}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="/front/asset/img/home/Frame5.png" class="card-img-top" alt="Blog post image">
                        <div class="card-body">
                            <h5 class="card-title">10 Tips for Productive Remote Work</h5>
                            <p class="card-text">Learn how to stay focused and efficient while working from home with
                                these
                                expert tips.</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn-primary-hero">Read More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="/front/asset/img/home/Frame6.png" class="card-img-top" alt="Blog post image">
                        <div class="card-body">
                            <h5 class="card-title">The Future of Artificial Intelligence</h5>
                            <p class="card-text">Explore the potential impact of AI on various industries and our daily
                                lives.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn-primary-hero">Read More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="/front/asset/img/home/Frame7.png" class="card-img-top" alt="Blog post image">
                        <div class="card-body">
                            <h5 class="card-title">Sustainable Living: Small Changes, Big Impact</h5>
                            <p class="card-text">Discover easy ways to reduce your carbon footprint and live a more
                                eco-friendly
                                life.</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn-primary-hero">Read More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($blogs as $blog)
        <div class="col">
            <div class="card h-100 shadow-sm">
                {{-- Blog Image --}}
                @if($blog->cover_image)
                    <img src="{{ asset('admin/uploads/blogs/'.$blog->cover_image) }}" class="card-img-top" alt="{{ $blog->title }}">
                @else
                    <img src="/front/asset/img/home/Frame5.png" class="card-img-top" alt="Default Blog Image">
                @endif

                <div class="card-body">
                    {{-- Title --}}
                    <h5 class="card-title">{{ $blog->title }}</h5>

                    {{-- Short Description --}}
                    <p class="card-text">
                        {{ Str::limit(strip_tags($blog->description), 100) }}
                    </p>
                </div>

                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ url('blog/'.$blog->slug) }}" class="btn-primary-hero">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


        </div>
    </section>
    <section style="background-color: black;" class="position-relative"> 
        <div class="container py-5">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-5">
                    <h2 class="text-white fs-3 mb-3">Ready to share your First Post?</h2>
                    <p class="text-white text-14">Whether it’s an alert or a local sighting, your post helps people
                        nearby.</p>
                    <div class="hero-buttons m-sm-auto">
                        <a href="/register" class="btn-primary-hero"
                            style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Sign Up Now</a>
                        <a href="/create-post" class="btn-demo ">Create a Post</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="/front/asset/img/home/hand-holding.png" alt="" class="img-mic">
                </div>
            </div>
        </div>
    </section>
@endsection
