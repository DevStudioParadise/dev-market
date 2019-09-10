@if($result['filters'])

 <div id="accordion"  class="filters" role="tablist">
 	<div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="title" href="#collapseAccordian1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAccordian1">
                @lang('website.All Categories')
            </h2>
        </div>
        <div class="collapse block" id="collapseAccordian1" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            @include('common.categories')
        </div>
    </div>

 	<form enctype="multipart/form-data" name="filters" method="get">
        <input type="hidden" name="min_price" id="min_price" value="0">
        <input type="hidden" name="max_price" id="max_price" value="{{$result['filters']['maxPrice']}}">
        <input type="hidden" name="min_emp" id="min_emp" value="0">
        <input type="hidden" name="max_emp" id="max_emp" value="500">
        <input type="hidden" name="min_age" id="min_age" value="0">
        <input type="hidden" name="max_age" id="max_age" value="500">
        <input type="hidden" name="min_payback" id="min_payback" value="0">
        <input type="hidden" name="max_payback" id="max_payback" value="36">
        @if(app('request')->input('filters_applied')==1)
        <input type="hidden" name="filters_applied" id="filters_applied" value="1">
        <input type="hidden" name="options" id="options" value="<?php echo implode($result['filter_attribute']['options'],',')?>">
        <input type="hidden" name="options_value" id="options_value" value="<?php echo implode($result['filter_attribute']['option_values'], ',')?>">
        @else
        <input type="hidden" name="filters_applied" id="filters_applied" value="0">
        @endif
        <div class="card">
        	<!--id="headingOne"-->
			<div class="card-header" >
				<h2 class="title">
					@lang('website.Filters')
				</h2>
			</div>
			<div class="block">
            	<div class="card-title">@lang('website.Price')</div>
				<div class="card-body">
                    <div id="slider-range"></div>
                    <div id="slider-values">
                        <div class="slider-value-0">{{$web_setting[19]->value}}<input type="text" readonly id="min_price_show"></div>
                        <div class="slider-value-1">{{$web_setting[19]->value}}<input type="text" readonly id="max_price_show"></div>
                    </div>
                    <input type="hidden" class="maximum_price" value="{{$result['filters']['maxPrice']}}">
				</div>
			</div>

            <div class="block">
                <div class="card-title">@lang('website.Number Of Employees')</div>
                <div class="card-body">
                    <div id="slider-range-emp"></div>
                    <div id="slider-values-emp">
                        <div class="slider-value-emp-0"><input type="text" readonly id="min_emp_show"></div>
                        <div class="slider-value-emp-1"><input type="text" readonly id="max_emp_show"></div>
                    </div>
                    <input type="hidden" class="maximum_emp" value="500">
                </div>
            </div>

            <div class="block">
                <div class="card-title">@lang('website.Business age')</div>
                <div class="card-body">
                    <div id="slider-range-age"></div>
                    <div id="slider-values-age">
                        <div class="slider-value-age-0">@lang('labels.Month')<input type="text" readonly id="min_age_show"></div>
                        <div class="slider-value-age-1">@lang('labels.Month')<input type="text" readonly id="max_age_show"></div>
                    </div>
                    <input type="hidden" class="maximum_age" value="500">
                </div>
            </div>

            <div class="block">
                <div class="card-title">@lang('website.Payback (month)')</div>
                <div class="card-body">
                    <div id="slider-range-payback"></div>
                    <div id="slider-values-payback">
                        <div class="slider-value-payback-0"><input type="text" readonly id="min_payback_show"></div>
                        <div class="slider-value-payback-1"><input type="text" readonly id="max_payback_show"></div>
                    </div>
                    <input type="hidden" class="maximum_payback" value="36">
                </div>
            </div>

            @if(count($result['filters']['attr_data'])>0)
            @foreach($result['filters']['attr_data'] as $key=>$attr_data)
                <div class="block">
                    <div class="card-title @if(count($result['filters']['attr_data'])==$key+1) last @endif">{{$attr_data['option']['name']}}</div>
                       <div class="card-body">
                        <ul class="list">
                            @foreach($attr_data['values'] as $key=>$values)
                            <li >
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input filters_box" name="{{$attr_data['option']['name']}}[]" type="checkbox" value="{{$values['value']}}" 								 									<?php
          if(!empty($result['filter_attribute']['option_values']) and in_array($values['value_id'],$result['filter_attribute']['option_values'])) print 'checked';
                                    ?>>
                                    {{$values['value']}}
                                  </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
            @endif

            <div class="alret alert-danger" id="filter_required">
            </div>

            <div class="button">
            <?php
				$url = '';
            	if(isset($_REQUEST['category'])){
					$url = "?category=".$_REQUEST['category'];
					$sign = '&';
				}else{
					$sign = '?';
				}
				if(isset($_REQUEST['search'])){
					$url.= $sign."search=".$_REQUEST['search'];
				}
			?>
        	<a href="{{ URL::to('/shop'.$url)}}" class="btn btn-dark" id="apply_options"> @lang('website.Reset') </a>
             @if(app('request')->input('filters_applied')==1)
        	<button type="button" class="btn btn-secondary" id="apply_options_btn"> @lang('website.Apply')</button>
            @else
        	<!--<button type="button" class="btn btn-secondary" id="apply_options_btn" disabled> @lang('website.Apply')</button>-->
            <button type="button" class="btn btn-secondary" id="apply_options_btn" > @lang('website.Apply')</button>
            @endif
        </div>
		</div>
  </form>
</div>
@endif