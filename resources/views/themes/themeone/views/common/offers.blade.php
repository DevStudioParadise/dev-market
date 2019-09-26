<!-- New line required  -->

@if(count($result['commonContent']['homeBanners'])>0)
    @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
    
    @if($homeBanners->type==1)
    
    <div class="new-product mt-3">
	<a title="Banner Image" href="{{ $homeBanners->banners_url}}"><div class="like-bnr" style="background-image: url('{{asset('').$homeBanners->banners_image}}');"></div></a>
    </div>

    @endif

    @endforeach
@endif





