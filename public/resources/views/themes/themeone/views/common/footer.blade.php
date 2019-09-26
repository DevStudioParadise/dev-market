<footer class="footer-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="single-footer">
                    <h5>@lang('website.About Store')</h5>
                    <ul class="contact-list  pl-0 mb-0">
                        <li><i class="fa fa-map-marker"></i><span class="col-10">
                    {{$result['commonContent']['setting'][6]->value}},
                    {{$result['commonContent']['setting'][7]->value}},
                    {{$result['commonContent']['setting'][8]->value}},
                    {{$result['commonContent']['setting'][5]->value}},
                    {{$result['commonContent']['setting'][4]->value}}
                </span></li>
                        <li><i class="fa fa-phone"></i><span class="col-10">{{$result['commonContent']['setting'][11]->value}}</span>
                        </li>
                        <li><i class="fa fa-envelope"></i><span class="col-10"> <a
                                        href="mailto:sales@brandbychoice.com">{{$result['commonContent']['setting'][3]->value}}</a> </span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-block">
                    <div class="single-footer">
                        <h5>@lang('website.Our Services')</h5>
                        <ul class="links-list pl-0 mb-0">
                            @if(count($result['commonContent']['pages']))
                                @foreach($result['commonContent']['pages'] as $page)
                                    <li><a href="{{ URL::to('/page?name='.$page->slug)}}"><i
                                                    class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i>{{$page->name}}</a></li>
                                @endforeach
                            @endif
                            <li><a href="{{ URL::to('/contact-us')}}"><i class="fa fa-angle-double-right"
                                                                         aria-hidden="true"></i>@lang('website.Contact Us')
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-block">
                    <div class="single-footer">
                        <h5>@lang('website.Information')</h5>
                        <ul class="links-list pl-0 mb-0">
                            <li><a href="{{ URL::to('/')}}"><i class="fa fa-angle-double-right"
                                                               aria-hidden="true"></i>@lang('website.Home')</a></li>
                            <li><a href="{{ URL::to('/shop')}}"><i class="fa fa-angle-double-right"
                                                                   aria-hidden="true"></i>@lang('website.Shop')</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-3">
                <div class="single-footer">
                    @if(!empty($result['commonContent']['setting'][89]) and $result['commonContent']['setting'][89]->value==1)
                        <div class="newsletter">
                            <h5>@lang('website.Subscribe for Newsletter')</h5>
                            <div class="block">
                                <input type="email" name="email" id="email"
                                       placeholder="@lang('website.Your email address here')">
                                <button type="button" id="subscribe"
                                        class="btn btn-secondary">@lang('website.Subscribe')</button>
                            </div>
                        </div>
                        <div class="alert alert-success alert-dismissible success-subscribte" role="alert"
                             style="opacity: 500; display: none;"></div>

                        <div class="alert alert-danger alert-dismissible error-subscribte" role="alert"
                             style="opacity: 500; display: none;"></div>
                    @endif

                    <div class="socials">
                        <h5>@lang('website.Follow Us')</h5>
                        <ul class="list">
                            <li>
                                @if(!empty($result['commonContent']['setting'][50]->value))
                                    <a href="{{$result['commonContent']['setting'][50]->value}}" class="fa fa-facebook"
                                       target="_blank"></a>
                                @else
                                    <a href="#" class="fa fa-facebook"></a>
                                @endif
                            </li>
                            <li>
                                @if(!empty($result['commonContent']['setting'][53]->value))
                                    <a href="{{$result['commonContent']['setting'][53]->value}}" class="fa fa-linkedin"
                                       target="_blank"></a>
                                @else
                                    <a href="#" class="fa fa-linkedin"></a>
                                @endif
                            </li>
                            <li>
                                    <a href="#" class="fa fa-vk"></a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="#" class="fa fa-odnoklassniki-square"></a>--}}
{{--                            </li>--}}
                            <li>
                                <a href="#" class="fa fa-telegram"></a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-instagram"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footer py-2 my-2">
    <div class="container">
        <div class="row">
            <div class="footer-image col-12 col-md-6">

                <div id="ex1" class="modal" data-show-close="false" style="z-index: 99999;padding:0; height: 555px; text-align: center">
                    <img src="{{ asset('images/qr.png') }}" class="img-fluid">
                    <ol style="
                    list-style-type: decimal;
                    font-size: 11px;
                    text-align: left;
                    padding-right: 30px;
                    padding-bottom: 30px;"
                    >Для проведения платежа за услуги необходимо:
                    <li>Войти в личный кабинет интернет-банка.</li>
                    <li>В списке "Мои операции" выбрать строку "Платежи и переводы" / "Оплата услуг".</li>
                    <li>В открывшемся дереве (списке) нажать на строку система «Расчет» (ЕРИП)/Оплата по QR-коду.</li>
                    <li>Выбрать "Оплата в ЕРИП по коду услуги", ввести код и оплатить / Выбрать категорию "Информационные услуги".</li>
                    <li>Далее - строку "Прочие организации".</li>
                    <li>В списке компаний по алфавиту выбрать "КонсалтМаркет" и нажмите "Информационные услуги".</li>
                    <li>Откроется страница с параметрами платежа, нужно ввести код услуги.</li>
                    <li>Далее следовать инструкции интернет-банка.</li>
                    </ol>
                </div>

                <!-- Link to open the modal -->
                <a href="#ex1" rel="modal:open"> <img class="img-fluid" src="{{asset('').'images/payments.png'}}"></a>

            </div>
            <div class="footer-info col-12 col-md-6">
                <p> © Консалт Маркет </p>
            </div>
            <div class="floating-top"><a href="#" class="fa fa-angle-up"></a></div>
        </div>
    </div>
</div>

<!--notification-->
<div id="message_content"></div>

<!--- loader content --->
<div class="loader" id="loader">
    <img src="{{asset('').'images/loader.gif'}}">
</div>
