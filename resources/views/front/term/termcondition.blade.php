@extends('front.layouts.main')
@section('content')
    <section>
        <div class="container pt-5">
            <div class="row text-14" id="CommunityGuidelines">
                <div class="col-lg-12">

                    <h1 class="fs-3 py-4">Terms & Conditions</h1>
                    <div>
                        <p class="pb-2"><strong>Effective Date:</strong> [Insert Date]</p>

                        <p>{{ __('messages.term_desc') }} </p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">{{ __('messages.term_title') }}
                        </h2>
                        <p>{{ __('messages.term_short_desc') }}
                        </p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">{{ __('messages.term_key_heading') }} </h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p><b>Beneficiary - </b> {{ __('messages.term_key1') }}
                                </p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p><b>Provider -</b> {{ __('messages.term_key2') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p><b>AM VAZUT -</b> {{ __('messages.term_key3') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p><b>User Account -</b> {{ __('messages.term_key4') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p><b>Intellectual Property Rights -</b> {{ __('messages.term_key5') }}</p>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-4 py-3 heading"><span>Content Guidelines</span></h2>
                        <h2 class="fs-5"> {{ __('messages.guidline_heading') }}</h2>
                        <p>{{ __('messages.guidline_description') }}</p>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_2') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_3') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_4') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_5') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.guidline_6') }}</p>
                            </li>
                        </ul>
                        <p>{{ __('messages.guidline_desc') }}
                        </p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5 mt-4">Intellectual Property</h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.Intellectual_head') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.Intellectual_1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.Intellectual_2') }}</p>
                            </li>

                        </ul>
                        <p>{{ __('messages.Intellectual_contact') }} <a
                                href="mailto:amvazutapp@gmail.com">amvazutapp@gmail.com.</a>
                        </p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">Privacy and Personal Data</h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.personal_1') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.personal_2') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.personal_3') }}. <a href="mailto:amvazutapp@gmail.com">amvazutapp@gmail.com.</a></p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.personal_4') }}.</a></p>
                            </li>
                        </ul>
                        <p>{!! __('messages.personal_desc') !!}
                        </p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">{{ __('messages.force_title') }}</h2>
                        <p>If any mishappening or unexpected event, such as a natural disaster, a technical failure, etc., happens and it prevents the app from working properly, neither you nor the Provider will be held responsible for that situation.</p>
                     </div>
                    <hr><div>
                        <h2 class="fs-5">Legal Responsibility</h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p> {{ __('messages.legal_1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.legal_2') }}.</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.legal_3') }}</p></li>
                                <ol class="" type="circle">
                                    <li>{{ __('messages.legal_point1') }}</li>
                                    <li>{{ __('messages.legal_point2') }}</li>
                                    <li>{{ __('messages.legal_point3') }}</li>
                                    <li>{{ __('messages.legal_point4') }}</li>
                                </ol>
                            </li>
                        </ul>
                        <p>{{ __('messages.legal_desc') }}.</p>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">Changes to These Terms</h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.term_1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.term_2') }}
                                </p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p>{{ __('messages.term_3') }}</p>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <h2 class="fs-5">Final Notes</h2>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p> {{ __('messages.final_point1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p> {{ __('messages.final_point2') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p> {{ __('messages.final_point3') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                                <p> {{ __('messages.final_point4') }}</p>
                            </li>
                        </ul>
                    </div>
                    <hr>

                    <div>
                        <p>{{ __('messages.final_contact') }}
                         <br> <b>Email : </b> <a href="mailto:contact@amvazut.ro">contact@amvazut.ro</a>
                        <br><b>Number : </b> <a href="">0723204042
                        </a></p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
