@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.EditProduct') }} <small>{{ trans('labels.EditProduct') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/products')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.ListingAllProducts') }}</a></li>
      <li class="active">{{ trans('labels.EditProduct') }}</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- Info boxes --> 
    
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('labels.EditProduct') }} </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <!-- /.box-header -->
                        <!-- form start -->                        
                         <div class="box-body">
                          @if( count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                      <span class="sr-only">Error:</span>
                                      {{ $error }}
                                </div>
                             @endforeach
                          @endif
                        
                            {!! Form::open(array('url' =>'admin/updateproduct', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}                            	
                            	{!! Form::hidden('id',  $result['product'][0]->products_id, array('class'=>'form-control', 'id'=>'id')) !!}
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Product Type') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                          <option value="">{{ trans('labels.Choose Type') }}</option> 
                                          <option value="0" @if($result['product'][0]->products_type==0) selected @endif>{{ trans('labels.Simple') }}</option>
                                      </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.Product Type Text') }}.</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Category') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                   @if(!empty(session('categories_id')))
										@php
                                        $cat_array = explode(',', session('categories_id'));                                        
                                        @endphp
                                        <ul class="list-group list-group-root well">    
                                          @foreach ($result['categories'] as $categories)   
                                          @if(in_array($categories->id,$cat_array))                                 
                                          <li href="#" class="list-group-item"><label style="width:100%"><input 
                                          @if(in_array($categories->id,$result['mainCategories']))
                                          	checked
                                          @endif id="categories_<?=$categories->id?>" type="checkbox" class=" required_one categories" name="categories[]" value="{{ $categories->id }}" > {{ $categories->name }}</label></li>
                                          @endif
                                              @if(!empty($categories->sub_categories))
                                              <ul class="list-group">
                                                    	<li class="list-group-item" >
                                                    @foreach ($categories->sub_categories as $sub_category)
                                                    @if(in_array($sub_category->sub_id,$cat_array))  
                                                    <label><input
                                                    @if(in_array($sub_category->sub_id,$result['subCategories']))
                                                        checked
                                                    @endif
                                                     type="checkbox" name="categories[]" class="required_one sub_categories sub_categories_<?=$categories->id?>" parents_id = '<?=$categories->id?>' value="{{ $sub_category->sub_id }}"> {{ $sub_category->sub_name }}</label> @endif @endforeach</li>
                                                    
                                              </ul>
                                              @endif
                                          @endforeach                                          
                                        </ul>                                           
                                  @else
                                        <ul class="list-group list-group-root well">    
                                          @foreach ($result['categories'] as $categories)                                    
                                          <li href="#" class="list-group-item"><label style="width:100%"><input 
                                          @if(in_array($categories->id,$result['mainCategories']))
                                          	checked
                                          @endif
                                           id="categories_<?=$categories->id?>" type="checkbox" class=" required_one categories" name="categories[]" value="{{ $categories->id }}" > {{ $categories->name }}</label></li>
                                              @if(!empty($categories->sub_categories))
                                              <ul class="list-group">
                                                    	<li class="list-group-item" >
                                                    @foreach ($categories->sub_categories as $sub_category)<label><input 
                                                        @if(in_array($sub_category->sub_id,$result['subCategories']))
                                                        	checked
                                                        @endif
                                                         type="checkbox" name="categories[]" class="required_one sub_categories sub_categories_<?=$categories->id?>" parents_id = '<?=$categories->id?>' value="{{ $sub_category->sub_id }}"> {{ $sub_category->sub_name }}</label>
                                                    @endforeach</li>
                                              </ul>
                                              @endif
                                          @endforeach                                          
                                        </ul>    
                                    @endif                                      
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseCatgoryText') }}.</span>
                                      <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Manufacturers') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="manufacturers_id">
                                     	 <option value="">{{ trans('labels.Choose Manufacturer') }}</option>
                                         @foreach ($result['manufacturer'] as $manufacturer)
                                          <option
                                           @if($result['product'][0]->manufacturers_id == $manufacturer->id )
                                             selected  
                                           @endif
                                           value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                      	 @endforeach
                                      </select>
                                  	  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ChooseManufacturerText') }}..</span>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Countries') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_country_id" id="country">
                                          <option value="">{{ trans('labels.ChooseCountries') }}</option>
                                          @foreach ($result['countries'] as $country)
                                              <option value="{{ $country->countries_id }}"
                                                      @if($result['product'][0]->products_country_id == $country->countries_id )
                                                      selected
                                                      @endif
                                              >{{ $country->countries_name }}</option>
                                          @endforeach
                                      </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseCountriesText') }}.</span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Region') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_region_id" id="region">
                                          <option value="">{{ trans('labels.ChooseRegion') }}</option>
                                          @foreach ($result['region'] as $region)
                                              <option value="{{ $region->region_id }}"
                                                      @if($result['product'][0]->products_region_id == $region->region_id )
                                                      selected
                                                      @endif
                                              >{{ $region->region_name }}</option>
                                          @endforeach
                                      </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseRegionText') }}.</span>
                                  </div>
                              </div>
                                <hr>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSale') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                       <select class="form-control" onChange="showFlash()" name="isFlash" id="isFlash">
                                          <option value="no" @if($result['flashProduct'][0]->flash_status == 0)
                                             selected  
                                           @endif>{{ trans('labels.No') }}</option>
                                          <option value="yes"  @if($result['flashProduct'][0]->flash_status == 1)
                                             selected  
                                           @endif>{{ trans('labels.Yes') }}</option>
                                      </select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.FlashSaleText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="flash-container" style="display: none;">
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSalePrice') }}</label>
                                      <div class="col-sm-10 col-md-4">
                                        <input  class="form-control" type="text" name="flash_sale_products_price" id="flash_sale_products_price" value="{{$result['flashProduct'][0]->flash_sale_products_price}}">
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.FlashSalePriceText') }}</span>
                                        <span class="help-block hidden">{{ trans('labels.FlashSalePriceText') }}</span>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group">                                    
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSaleDate') }}</label>
                                      @if($result['flashProduct'][0]->flash_status == 1)
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly readonly type="text" name="flash_start_date" id="flash_start_date" value="{{ date('d/m/Y', $result['flashProduct'][0]->flash_start_date) }}">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.FlashSaleDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time" value="{{ date('h:i:sA', $result['flashProduct'][0]->flash_start_date) }}" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      @else
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly readonly type="text" name="flash_start_date" id="flash_start_date" value="">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.FlashSaleDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time" value="" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      @endif
                                      
                                    </div>
                                    
                                    <div class="form-group">                                    
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashExpireDate') }}</label>
                                      @if($result['flashProduct'][0]->flash_status == 1)
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly readonly type="text" name="flash_expires_date" id="flash_expires_date" value="{{ date('d/m/Y', $result['flashProduct'][0]->flash_expires_date) }}">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      	{{ trans('labels.FlashExpireDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="{{ date('h:i:sA', $result['flashProduct'][0]->flash_expires_date) }}" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      @else
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly readonly type="text" name="flash_expires_date" id="flash_expires_date" value="">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      	{{ trans('labels.FlashExpireDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      @endif
                                    </div>
                                    
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                      <div class="col-sm-10 col-md-4">
                                          <select class="form-control" name="flash_status">
                                              <option value="1">{{ trans('labels.Active') }}</option>
                                              <option value="0">{{ trans('labels.Inactive') }}</option>
                                          </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.ActiveFlashSaleProductText') }}</span>									  
                                      </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group  special-link">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Special') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" onChange="showSpecial()" name="isSpecial" id="isSpecial">
                                          <option 
                                           @if($result['product'][0]->products_id != $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 0)
                                             selected  
                                           @endif 
                                           value="no">{{ trans('labels.No') }}</option>
                                          <option
                                           @if($result['product'][0]->products_id == $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 1)
                                             selected  
                                           @endif 
                                           value="yes">{{ trans('labels.Yes') }}</option>
                                      </select>
                                 	  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> {{ trans('labels.SpecialProductText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="special-container" style="display: none;">
									<div class="form-group">
									  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SpecialPrice') }}</label>
									  <div class="col-sm-10 col-md-4">
									  	{!! Form::text('specials_new_products_price',  $result['specialProduct'][0]->specials_new_products_price, array('class'=>'form-control', 'id'=>'special-price')) !!}
									    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialPriceTxt') }}.</span>
                                        <span class="help-block hidden">{{ trans('labels.SpecialPriceNote') }}.</span>
									  </div>
									</div>
                              		<div class="form-group">
                              		 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExpiryDate') }}</label>
									  <div class="col-sm-10 col-md-4">
                                     @if(!empty($result['specialProduct'][0]->status) and $result['specialProduct'][0]->status == 1)
                                     	{!! Form::text('expires_date',  date('d/m/Y', $result['specialProduct'][0]->expires_date), array('class'=>'form-control datepicker', 'id'=>'expiry-date', 'readonly'=>'readonly')) !!}
                                     @else
                                     	{!! Form::text('expires_date',  '', array('class'=>'form-control datepicker',  'id'=>'expiry-date', 'readonly'=>'readonly')) !!}
                                     @endif
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialExpiryDateTxt') }}
                                        </span>
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
									  </div>
									</div>
                              		<div class="form-group">
									  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
									  <div class="col-sm-10 col-md-4">
										  <select class="form-control" name="status">
											  <option
                                               @if($result['specialProduct'][0]->status == 1 )
                                                 selected  
                                               @endif 
                                               value="1">{{ trans('labels.Active') }}
                                               </option>
											   <option
                                               @if($result['specialProduct'][0]->status == 0 )
                                                 selected 
                                               @endif 
                                               value="0">{{ trans('labels.Inactive') }}</option>
										  </select>
									       <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    	  {{ trans('labels.ActiveSpecialProductText') }}.</span>
									  </div>
									</div>
                               	</div>
                                
                                <hr>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.slug') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="hidden" name="old_slug" value="{{$result['product'][0]->products_slug}}">
                                    <input type="text" name="slug" class="form-control field-validate" value="{{$result['product'][0]->products_slug}}">
                                  	<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.slugText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                              <hr>

                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Business age') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_age" class="form-control field-validate" value="{{$result['product'][0]->products_age}}">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Business age') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Business age') }}</span>
                                  </div>
                              </div>

                              <hr>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Number Of Employees') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_emp" class="form-control field-validate" value="{{$result['product'][0]->products_emp}}">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Number Of Employees') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Number Of Employees') }}</span>
                                  </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Payback (month)') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_payback" class="form-control field-validate" value="{{$result['product'][0]->products_payback}}">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Payback (month)') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Payback (month)') }}</span>
                                  </div>
                              </div>
                              <hr>
                                @foreach($result['description'] as $description_data)
                                            
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductName') }} ({{ $description_data['language_name'] }})</label>
                                    <div class="col-sm-10 col-md-4">                                    
                                        <input type="text" name="products_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_name']}}'>                                        
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductNameIn') }} {{ $description_data['language_name'] }} </span>
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                        
                                    </div>
                                </div>



                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductCompanyName') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_company_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_company_name']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductCompanyNameIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductSite') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_site_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_site']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductSiteIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductTypesOfServices') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_types_of_services_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_types_of_services']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductTypesOfServicesIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductEmail') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_email_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_email']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductEmailIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductIncorporation') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_incorporation_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_incorporation']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductIncorporationIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductAddress') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_address_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_address']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductAddressIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductProfit') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_profit_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_profit']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductProfitIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductReason') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_reason_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_reason']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductReasonIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductContact') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_contact_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_contact']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductContactIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductPhone') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_phone_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_phone']}}'>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductPhoneIn') }} {{ $description_data['language_name'] }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>




                                
                                <div class="form-group external_link" style="display: none">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.External URL') }} ({{ $description_data['language_name'] }})</label>
                                      <div class="col-sm-10 col-md-4">
                                            <input type="text" name="products_url_<?=$description_data['languages_id']?>" class="form-control products_url" value='{{$description_data['products_url']}}'>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.External URL Text') }} ({{ $description_data['language_name'] }}) </span>
                                      <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                </div>
                                                                
                                <div class="form-group">
                                	<label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }} ({{ $description_data['language_name'] }})</label>
                                    <div class="col-sm-10 col-md-8">                                     
                                        <textarea  id="editor<?=$description_data['languages_id']?>" name="products_description_<?=$description_data['languages_id']?>" class="form-control" rows="5">{{stripslashes($description_data['products_description'])}}</textarea>
                                     
                                   	<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.EnterProductDetailIn') }} {{ $description_data['language_name'] }}</span>                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.left banner') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="file" name="products_left_banner_<?=$description_data['languages_id']?>" id="products_left_banner_<?=$description_data['languages_id']?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner text') }}</span>
                                    @if(!empty($description_data['products_left_banner']))
                                    <br>
                                    <input type="hidden" name="old_left_banner_<?=$description_data['languages_id']?>" value="{{$description_data['products_left_banner']}}">
                                    <img class="thumbnail" src="{{asset('').$description_data['products_left_banner']}}" alt="" width=" 100px">
                                    @endif
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner start date') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_left_banner_start_date_<?=$description_data['languages_id']?>" id="products_left_banner_start_date_<?=$description_data['languages_id']?>" value="@if(!empty($description_data['products_left_banner_start_date'] and $description_data['products_left_banner_start_date']>0)){{date('d/m/Y', $description_data['products_left_banner_start_date'])}}@endif">
                                    
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner start date text') }}</span>
                                  </div>
                                </div>
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner expire date') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_left_banner_expire_date_<?=$description_data['languages_id']?>" id="products_left_banner_expire_date_<?=$description_data['languages_id']?>"  value="@if(!empty($description_data['products_left_banner_expire_date'] and $description_data['products_left_banner_expire_date']>0)){{date('d/m/Y', $description_data['products_left_banner_expire_date'])}}@endif">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner expire date text') }}</span>
                                  </div>
                                </div>
                                                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.right banner') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
                                  	<input type="file" name="products_right_banner_<?=$description_data['languages_id']?>" id="products_right_banner_<?=$description_data['languages_id']?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner text') }}</span>
                                    @if(!empty($description_data['products_right_banner']))
                                    <br>
                                    <input type="hidden" name="old_right_banner_<?=$description_data['languages_id']?>" value="{{$description_data['products_right_banner']}}">
                                    <img class="thumbnail" src="{{asset('').$description_data['products_right_banner']}}" alt="" width=" 100px">
                                    @endif
                                  </div>
                                </div>
                                                                                           
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner start date') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
									@if(!empty($description_data['products_right_banner_start_date']) and $description_data['products_right_banner_start_date']!=0)
                                   	 <input class="form-control datepicker" readonly type="text" name="products_right_banner_start_date_<?=$description_data['languages_id']?>" id="products_right_banner_start_date_<?=$description_data['languages_id']?>" value="{{date('d/m/Y', $description_data['products_right_banner_start_date'])}}">
                                    @else
  								     <input class="form-control datepicker" readonly type="text" name="products_right_banner_start_date_<?=$description_data['languages_id']?>" id="products_right_banner_start_date_<?=$description_data['languages_id']?>">
									@endif
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner start date text') }}</span>
                                  </div>
                                </div>
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner expire date') }} ({{ $description_data['language_name'] }})</label>
                                  <div class="col-sm-10 col-md-4">
									@if(!empty($description_data['products_right_banner_expire_date']) and $description_data['products_right_banner_expire_date']!=0)
                                   		 <input class="form-control datepicker" readonly type="text" name="products_right_banner_expire_date_<?=$description_data['languages_id']?>" id="products_right_banner_expire_date_<?=$description_data['languages_id']?>" value="{{date('d/m/Y', $description_data['products_right_banner_expire_date'])}}">
									@else
									   <input class="form-control datepicker" readonly type="text" name="products_right_banner_expire_date_<?=$description_data['languages_id']?>" id="products_right_banner_expire_date_<?=$description_data['languages_id']?>">
									@endif
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner expire date text') }}</span>
                                  </div>
                                </div>
                                
                              @endforeach
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('products_price',  $result['product'][0]->products_price, array('class'=>'form-control number-validate', 'id'=>'products_price')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductPriceText') }}
                                    </span>                                  
                                    <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }} BYN</label>
                                  <div class="col-sm-10 col-md-4">
                                      {!! Form::text('products_price_byn',  $result['product'][0]->products_price_byn, array('class'=>'form-control number-validate', 'id'=>'products_price_byn')) !!}
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductPriceText') }}
                                    </span>
                                      <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                  </div>
                              </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsModel') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('products_model',  $result['product'][0]->products_model, array('class'=>'form-control', 'id'=>'products_model')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductsModelText') }}
                                    </span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>                                          
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::file('products_image', array('id'=>'products_image')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.UploadProductImageText') }}</span>
                                    <br>
                                    {!! Form::hidden('oldImage',  $result['product'][0]->products_image , array('id'=>'oldImage', 'class'=>'field-validate ')) !!}
                                    <img src="{{asset('').$result['product'][0]->products_image}}" alt="" width=" 100px">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.IsFeature') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="is_feature">
                                          <option value="0" @if($result['product'][0]->is_feature==0) selected @endif>{{ trans('labels.No') }}</option>
                                          <option value="1" @if($result['product'][0]->is_feature==1) selected @endif>{{ trans('labels.Yes') }}</option>                                       
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.IsFeatureProuctsText') }}</span>
                                  </div>
                                </div>
                                
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_status">
                                          <option value="1" @if($result['product'][0]->products_status==1) selected @endif >{{ trans('labels.Active') }}</option>
                                          <option value="0" @if($result['product'][0]->products_status==0) selected @endif>{{ trans('labels.Inactive') }}</option>                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.SelectStatus') }}</span>
                                  </div>
                                </div>
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary pull-right"  id="attribute-btn">{{ trans('labels.Add Atrributes') }} <i class="fa fa-angle-right 2x"></i></button>
								  
                                <button type="submit" class="btn btn-primary pull-right"  id="normal-btn" style="display: none">{{ trans('labels.addinventory') }} <i class="fa fa-angle-right 2x"></i></button>
								  
                                <button type="submit" class="btn btn-primary pull-right"  id="external-btn" style="display: none">{{ trans('labels.AddProducts') }} <i class="fa fa-angle-right 2x"></i></button>
                              </div>
                              
                              <!-- /.box-footer -->
                            {!! Form::close() !!}
                        </div>
                  </div>
              </div>
            </div>
            
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    
    <!-- Main row --> 
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<script src="{!! asset('resources/views/admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
		$(function () {
			
			//for multiple languages
			@foreach($result['languages'] as $languages)
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor{{$languages->languages_id}}');
			
			@endforeach
			
			//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
			
    });
</script>
@endsection 