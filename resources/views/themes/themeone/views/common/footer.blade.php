<footer class="footer-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="single-footer">
                    <h5>@lang('website.About Store')</h5>
                    <ul class="contact-list  pl-0 mb-0">
                        <li><i class="fa fa-map-marker"></i><span class="col-10">
                    {{$result['commonContent']['setting'][6]->value}}
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
                                <a href="#" class="fa fa-viber">
                                    <svg width="22" height="22" viewBox="0 0 470 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M464.973 296.384C480.248 167.808 457.635 86.6347 416.845 49.92L416.867 49.8987C351.032 -12.8 128.696 -22.08 49.9333 52.7147C14.5627 89.3014 2.10398 142.997 0.738651 209.472C-0.626682 275.968 -2.24802 400.533 113.827 434.325H113.933L113.827 485.931C113.827 485.931 113.037 506.837 126.392 511.04C141.667 515.989 148.579 506.283 196.088 449.536C275.533 456.427 336.547 440.64 343.48 438.336C359.523 432.96 450.296 420.949 464.973 296.384ZM203.917 413.227C203.917 413.227 153.635 475.925 137.997 492.203C132.877 497.493 127.267 497.003 127.352 486.507C127.352 479.616 127.736 400.832 127.736 400.832C29.3253 372.629 35.128 266.56 36.1947 211.072C37.2613 155.563 47.416 110.101 77.368 79.488C146.467 14.6987 341.389 29.184 391.053 75.8614C451.768 129.685 430.157 281.749 430.285 286.933C417.805 390.912 344.248 397.504 330.723 402.005C324.941 403.925 271.288 417.728 203.917 413.227V413.227Z" fill="#8E24AA"/>
                                        <path d="M231.736 91.6694C223.523 91.6694 223.523 104.469 231.736 104.576C295.459 105.067 347.939 149.483 348.515 230.955C348.515 239.552 361.101 239.445 360.995 230.848H360.973C360.291 143.061 302.989 92.1601 231.736 91.6694V91.6694Z" fill="#8E24AA"/>
                                        <path d="M315.555 217.451C315.363 225.941 327.928 226.347 328.035 217.749C329.08 169.344 299.235 129.472 243.149 125.269C234.936 124.672 234.083 137.579 242.275 138.176C290.915 141.867 316.536 175.061 315.555 217.451V217.451Z" fill="#8E24AA"/>
                                        <path d="M302.115 272.512C291.576 266.411 280.845 270.208 276.408 276.203L267.128 288.213C262.413 294.315 253.603 293.504 253.603 293.504C189.304 276.501 172.109 209.216 172.109 209.216C172.109 209.216 171.32 200.107 177.208 195.221L188.813 185.621C194.616 181.013 198.285 169.92 192.376 159.019C176.589 130.496 165.987 120.661 160.589 113.109C154.915 106.005 146.381 104.405 137.507 109.205H137.315C118.861 120 98.6588 140.203 105.123 161.003C116.152 182.933 136.419 252.843 201.016 305.664C231.373 330.645 279.416 356.245 299.811 362.155L300.003 362.453C320.099 369.152 339.64 348.16 350.072 329.152V329.003C354.701 319.808 353.165 311.104 346.403 305.408C334.413 293.717 316.323 280.811 302.115 272.512Z" fill="#8E24AA"/>
                                        <path d="M251.939 172.885C272.44 174.08 282.381 184.789 283.448 206.784C283.832 215.381 296.312 214.784 295.928 206.187C294.563 177.472 279.587 161.472 252.621 159.979C244.408 159.488 243.64 172.395 251.939 172.885V172.885Z" fill="#8E24AA"/>
                                    </svg>

                                </a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-telegram"></a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-vk"></a>
                            </li>
                            <li>
                                @if(!empty($result['commonContent']['setting'][50]->value))
                                    <a href="{{$result['commonContent']['setting'][50]->value}}" class="fa fa-facebook"
                                       target="_blank"></a>
                                @else
                                    <a href="#" class="fa fa-facebook"></a>
                                @endif
                            </li>
                            <li>
                                <a href="#" class="fa fa-instagram"></a>
                            </li>
                            <li>
                                @if(!empty($result['commonContent']['setting'][53]->value))
                                    <a href="{{$result['commonContent']['setting'][53]->value}}" class="fa fa-linkedin"
                                       target="_blank"></a>
                                @else
                                    <a href="#" class="fa fa-linkedin"></a>
                                @endif
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

                <div id="ex1" class="modal" data-show-close="false" style="z-index: 99999;padding:0; height: auto!important; text-align: center">
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
