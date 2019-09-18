{{-- --}}

<div class="container-fuild">
  <div class="container">
    <div class="products-area">
        <!-- heading -->
        <div class="heading">
        	<h2>@lang('website.Special products of the Week') <small class="pull-right"><a href="{{ URL::to('/shop?type=special')}}" >@lang('website.View All')</a></small></h2>
        	<hr>
        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-12">
                <div class="row">
                	<!-- Items -->
                    <div class="products products-5x">
                        <!-- Product -->

                        @if($result['special']['success']==1)
                        @foreach($result['special']['product_data'] as $key=>$special)
                        @if($key<=9)
                        <div class="product">
                          <article>
                            <div class="thumb"><img class="img-fluid" src="{{asset('').$special->products_image}}" alt="{{$special->products_name}}"></div>
                            <?php
                                    $current_date = date("Y-m-d", strtotime("now"));

                                    $string = substr($special->products_date_added, 0, strpos($special->products_date_added, ' '));
                                    $date=date_create($string);
                                    date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

                                    //echo $top_seller->products_date_added . "<br>";
                                    $after_date = date_format($date,"Y-m-d");

                                    if($after_date>=$current_date){
                                        print '<span class="new-tag">';
                                        print __('website.New');
                                        print '</span>';
                                    }

                                    if(!empty($special->discount_price)){
                                        $discount_price = $special->discount_price;
                                        $orignal_price = $special->products_price;

                                        if(($orignal_price+0)>0){
											$discounted_price = $orignal_price-$discount_price;
											$discount_percentage = $discounted_price/$orignal_price*100;
										}else{
											$discount_percentage = 0;
										}
                                        echo "<span class='discount-tag'>".(int)$discount_percentage."%</span>";
                                    }

                            ?>
                            <span class="tag text-center">
                            @foreach($special->categories as $key=>$category)
                            	{{$category->categories_name}}@if(++$key === count($special->categories)) @else, @endif
                        	@endforeach
                            </span>
                            <h2 class="title text-center wrap-dot-1">{{$special->products_name}}</h2>

                            <div class="price text-center">
                            <small style="color: gray">{{$web_setting[19]->value}}{{$special->discount_price+0}}</small> <span><small style="color: gray">{{$web_setting[19]->value}}{{$special->products_price+0}}</small> {{$special->products_price_byn+0}} BYN</span></div>
                            <div class="product-hover">
                                <div class="icons">
                                    @if($special->products_type!=2)
                                        <a href="{{ URL::to('/product-detail/'.$special->products_slug)}}" class="fa fa-eye"></a>
                                    @endif
                                </div>
                                <div class="buttons">
                                    <a class="btn btn-block btn-secondary" href="{{ URL::to('/product-detail/'.$special->products_slug)}}">@lang('website.View Detail')</a>
                                </div>
                             </div>
                          </article>
                        </div>
                        @endif
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="group-banners">
    	<div class="row">
        	<div class="col-xs-12 col-sm-12">
                @if(count($result['commonContent']['homeBanners'])>0)
                    @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                        @if($homeBanners->type==7)
                        <div class="banner-image">
                            <a title="Banner Image" href="{{ $homeBanners->banners_url}}"><img class="img-fluid" src="{{asset('').$homeBanners->banners_image}}" alt="Banner Image"></a>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>

  </div>
</div>

<div class="container-fuild">
  <div class="container">
    <div class="products-area">
      <!-- heading -->
      <div class="heading">
        <h2>@lang('website.Categories') <small class="pull-right"><!--<a href="shop" >@lang('website.View All')</a>--></small></h2>
        <hr>
      </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <!-- Items -->
                    <div class="products products-5x">
                        <!-- categories -->
                        <?php $counter = 0;?>
                        @foreach($result['commonContent']['categories'] as $categories_data)
                                @if($counter<=9)
                                <div class="product">
                                    <div class="blog-post">
                                        <article>
                                            <div class="module">
                                            	<a href="{{ URL::to('/shop?category='.$categories_data->slug)}}" class="cat-thumb">
                                                   <img class="img-fluid" src="{{asset('').$categories_data->image}}" alt="{{$categories_data->name}}">
                                                </a>
                                                <a href="{{ URL::to('/shop?category='.$categories_data->slug)}}" class="cat-title">
                                                	{{$categories_data->name}}
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                @endif
                                <?php $counter++;?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="container-fuild">
  <div class="container">
    <div class="products-area">
      <!-- heading -->
      <div class="heading">
        <h2>@lang('website.Newest Products') <small class="pull-right"><a href="{{ URL::to('/shop')}}" >@lang('website.View All')</a></small></h2>
        <hr>
      </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <!-- Items -->
                    <div class="products products-5x">
                        <!-- Product -->
                        @if($result['products']['success']==1)
                        @foreach($result['products']['product_data'] as $key=>$products)
                        <div class="product">
                          <article>
                            <div class="thumb"> <img class="img-fluid" src="{{asset('').$products->products_image}}" alt="{{$products->products_name}}"> </div>
                            <?php

                                    $current_date = date("Y-m-d", strtotime("now"));



                                    $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));

                                    $date=date_create($string);

                                    date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));
                                    $after_date = date_format($date,"Y-m-d");



                                    if($after_date>=$current_date){

                                        print '<span class="new-tag">';

                                        print __('website.New');

                                        print '</span>';

                                    }



                                    if(!empty($products->discount_price)){

                                        $discount_price = $products->discount_price;

                                        $orignal_price = $products->products_price;



                                        if(($orignal_price+0)>0){
											$discounted_price = $orignal_price-$discount_price;
											$discount_percentage = $discounted_price/$orignal_price*100;
										}else{
											$discount_percentage = 0;
										}

                                        echo "<span class='discount-tag'>".(int)$discount_percentage."%</span>";

                                    }



                            ?>
                            <span class="tag text-center">
                            @foreach($products->categories as $key=>$category)
                                {{$category->categories_name}}@if(++$key === count($products->categories)) @else, @endif
                            @endforeach
                            </span>
                            <h2 class="title text-center wrap-dot-1">{{$products->products_name}}</h2>
                            <div class="price text-center"> @if(!empty($products->discount_price))

                                    <small style="color: gray">{{$web_setting[19]->value}}{{$products->discount_price+0}}</small> <span> <small style="color: gray">{{$web_setting[19]->value}}{{$products->products_price+0}}</small> {{$products->products_price_byn+0}} BYN</span> @else

                                    <small style="color: gray">{{$web_setting[19]->value}}{{$products->products_price+0}}</small> {{$products->products_price_byn+0}} BYN

                              @endif
                              </div>
                            <div class="product-hover">
                                <div class="icons">
                                    @if($products->products_type!=2)
                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="fa fa-eye"></a>
                                    @endif
                                </div>
                                <div class="buttons">
                                    <a class="btn btn-block btn-secondary" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
                                </div>
                            </div>
                            </article>
                        </div>
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


  </div>
</div>


