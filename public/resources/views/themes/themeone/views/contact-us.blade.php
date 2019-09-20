@extends('layout')
@section('content')
<section class="site-content">

	<div class="container">
  		<div class="breadcum-area">
            <div class="breadcum-inner">
                <h3>@lang('website.Contact Us')</h3>
                <ol class="breadcrumb">                    
                    <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            		<li class="breadcrumb-item active">@lang('website.Contact Us')</li>
                </ol>
            </div>
        </div>
        <div class="contact-area">
        	<div class="heading">
                <h2>@lang('website.Contact Us')</h2>
                <hr>
            </div>
        	<div class="row">
                
                <div class="col-12 col-md-6 col-lg-4">
                    
                    <ul class="contact-list">
                      <li> <i class="fa fa-map-marker"></i><span class="col-10">{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
                      <li> <i class="fa fa-phone"></i><span class="col-10">{{$result['commonContent']['setting'][11]->value}}</span> </li>
                      <li> <i class="fa fa-envelope"></i><span class="col-10"> <a href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aad42d468eba3f42ea38b10de2bf1bedfa4c9755ea342302835ed7927b97cd2a8&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
	</div>

</section>
@endsection