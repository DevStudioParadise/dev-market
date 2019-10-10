<!doctype html>

<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->

@include('common.meta')
<style>
    .jquery-modal {
        z-index: 999999!important;
    }
    .modal a.close-modal {
        display: none!important;
    }
</style>
<!-- ./end of meta -->

<!--dir="rtl"-->

<body dir="{{ session('direction')}}">
	<!-- header -->

		@if(session('homeStyle')=='two' )
        	@include('common.header_two')
            @if(Request::path() == 'index' or Request::path() == '/')
            <section class="carousel-content">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-lg-9 p-0 mb-3"> @include('common.carousel') </div>
                  <div class="col-12 col-lg-3 p-0 pl-lg-2 pl-md-2 pl-sm-2"> @include('common.offers') </div>
                </div>
              </div>
            </section>
            @endif
        @elseif(session('homeStyle')=='three' )
        	@include('common.header_three')
            @if(Request::path() == 'index' or Request::path() == '/')
            <section class="carousel-content">
              <div class="container">
                <div class="row">
                  <div class="col-12 p-0"> @include('common.carousel') </div>
                </div>
              </div>
            </section>
            @endif                 
       
        @else
       		@include('common.header')
            @if(Request::path() == 'index' or Request::path() == '/')
            <section class="carousel-content">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-lg-3 p-0"> @include('common.categories') </div>
                  <div class="col-12 col-lg-9 p-0"> @include('common.carousel') </div>
                </div>
              </div>
            </section>
            @endif
        @endif
	<!-- ./end of header -->
        
        

	@yield('content')
	

{{--	<section class="banner-content">--}}
{{--    	@include('common.banner')--}}
{{--    </section>--}}
    
    @include('common.footer')
	<!-- all js scripts including custom js -->

	@include('common.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script>
        (function(w,d,u){
            var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
            var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.by/b10862054/crm/site_button/loader_2_h44e8g.js');
    </script>
    <!-- ./end of js scripts -->
    @if(!empty($result['commonContent']['setting'][77]->value))
		<?=stripslashes($result['commonContent']['setting'][77]->value)?>
    @endif
</body>

</html>

