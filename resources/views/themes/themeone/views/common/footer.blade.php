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
                                    <svg enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><g fill="#8e24aa"><path d="m23.155 13.893c.716-6.027-.344-9.832-2.256-11.553l.001-.001c-3.086-2.939-13.508-3.374-17.2.132-1.658 1.715-2.242 4.232-2.306 7.348-.064 3.117-.14 8.956 5.301 10.54h.005l-.005 2.419s-.037.98.589 1.177c.716.232 1.04-.223 3.267-2.883 3.724.323 6.584-.417 6.909-.525.752-.252 5.007-.815 5.695-6.654zm-12.237 5.477s-2.357 2.939-3.09 3.702c-.24.248-.503.225-.499-.267 0-.323.018-4.016.018-4.016-4.613-1.322-4.341-6.294-4.291-8.895.05-2.602.526-4.733 1.93-6.168 3.239-3.037 12.376-2.358 14.704-.17 2.846 2.523 1.833 9.651 1.839 9.894-.585 4.874-4.033 5.183-4.667 5.394-.271.09-2.786.737-5.944.526z"/><path d="m12.222 4.297c-.385 0-.385.6 0 .605 2.987.023 5.447 2.105 5.474 5.924 0 .403.59.398.585-.005h-.001c-.032-4.115-2.718-6.501-6.058-6.524z"/><path d="m16.151 10.193c-.009.398.58.417.585.014.049-2.269-1.35-4.138-3.979-4.335-.385-.028-.425.577-.041.605 2.28.173 3.481 1.729 3.435 3.716z"/><path d="m15.521 12.774c-.494-.286-.997-.108-1.205.173l-.435.563c-.221.286-.634.248-.634.248-3.014-.797-3.82-3.951-3.82-3.951s-.037-.427.239-.656l.544-.45c.272-.216.444-.736.167-1.247-.74-1.337-1.237-1.798-1.49-2.152-.266-.333-.666-.408-1.082-.183h-.009c-.865.506-1.812 1.453-1.509 2.428.517 1.028 1.467 4.305 4.495 6.781 1.423 1.171 3.675 2.371 4.631 2.648l.009.014c.942.314 1.858-.67 2.347-1.561v-.007c.217-.431.145-.839-.172-1.106-.562-.548-1.41-1.153-2.076-1.542z"/><path d="m13.169 8.104c.961.056 1.427.558 1.477 1.589.018.403.603.375.585-.028-.064-1.346-.766-2.096-2.03-2.166-.385-.023-.421.582-.032.605z"/></g></svg>
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
