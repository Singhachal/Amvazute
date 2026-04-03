@extends('front.layouts.main')
@section('content')
    <section>
        <div class="container pt-5">
            <div class="row text-14" id="CommunityGuidelines">
                <div class="col-lg-12">
                    <h1 class="fs-3 py-4">Privacy Policy</h1>

                    <p class="pb-2"><strong>Effective Date:</strong> [Insert Date]</p>
                    <p>{{ __('messages.privacy_policy_desc') }}</p>
                    <hr>
                    <h2 class="fs-5">{{ __('messages.privacy_policy_title') }}</h2>
                    <p>{{ __('messages.privacy_policy_desc2') }}
                    </p>
                    <hr>
                    <h2 class="fs-5 heading"> <span>{{ __('messages.privacy_policy_title2') }}</span></h2>
                    <p class="pb-2">{{ __('messages.privacy_policy_desc3') }} </p>
                    <h2 class="fs-6">{{ __('messages.privacy_policy_heading') }} </h2>
                    <p class="pb-2">{{ __('messages.privacy_policy_des') }}</p>
                    <ul class="ps-0">
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_policy_point1') }}.
                                </p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_policy_point2') }}.
                            </p>
                        </li>
                    </ul>
                    <h2 class="fs-6 mt-3">b. {{ __('messages.privacy_policy_b') }}</h2>
                    <p>{{ __('messages.privacy_policy_dec_b') }}.</p>
                    <h2 class="fs-6 mt-3">c. {{ __('messages.privacy_policy_c') }}</h2>
                   <ul class="ps-0">
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_policy_dec_c') }}.
                            </p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_policy_dec_c1') }}.</p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_policy_dec_c2') }}.</p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_policy_dec_c3') }}.</p>
                        </li>
                    </ul>
                    <h2 class="fs-6 mt-3">d. {{ __('messages.privacy_policy_d') }}
                    </h2>
                    <p>{{ __('messages.privacy_policy_dec_d') }}.</p>

                    <hr>
                    <h2 class="fs-5">{{ __('messages.privacy_data_heading') }}</h2>
                    <p class="py-3">{{ __('messages.privacy_data_desc') }}:  </p>
                    <ul class="ps-0">
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_data_1') }}. </p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_data_2') }}</p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_data_3') }}</p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_data_4') }}
                            </p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>{{ __('messages.privacy_data_5') }}</p>
                        </li>
                    </ul>
                    <p><b>Please note:</b> {{ __('messages.privacy_data_note') }}
                    </p>
                    <hr>
                    <h2 class="fs-5">{{ __('messages.privacy_secuirty_head') }}</h2>
                    <p class="pb-2">{{ __('messages.privacy_secuirty_desc') }}
                    </p>
                    <p class="pb-2">{{ __('messages.privacy_secuirty_desc1') }} </p>
                    <ul class="ps-0">
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_secuirty_point') }}</a></p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p>  {{ __('messages.privacy_secuirty_point') }}</p>
                        </li>
                        </ul>
                    <p class="pb-2" > {{ __('messages.privacy_secuirty_heading') }} </p>
                    <p>{{ __('messages.privacy_right_desc') }}.</p>
                    <hr>
                    <h2 class="fs-5">{{ __('messages.privacy_right_heading') }}</h2>
                    <p  class="pb-2">{{ __('messages.privacy_right_description') }}
                    </p>
                    <ul class="ps-0">
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_right_point1') }} </p>
                        </li>
                        <li class="d-flex">
                            <img src="front/asset/img/home/arrow.png" alt="right icon" height="18px">&nbsp;
                            <p> {{ __('messages.privacy_right_point2') }}.</p>
                        </li>
                    </ul>
                    <p>{{ __('messages.privacy_contact') }}: [Insert Contact Email]</p>
                    <hr>

                    <div>
                    <h2 class="fs-5">{{ __('messages.policy_heading') }}
                    </h2>
                    <p  class="pb-2">{{ __('messages.policy_description') }}
                    </p>
                        <p>{{ __('messages.policy_contact') }}
                         <br> <b>Email : </b> <a href="mailto:contact@amvazut.ro">contact@amvazut.ro</a>
                        <br><b>Number : </b> <a href="">0723204042
                        </a></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
