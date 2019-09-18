@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.AddProduct') }} <small>{{ trans('labels.AddProduct') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/products')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.ListingAllProducts') }}</a></li>
      <li class="active">{{ trans('labels.AddProduct') }}</li>
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
            <h3 class="box-title">{{ trans('labels.AddNewProduct') }} </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                    <div class="box box-info">
                        <!-- form start -->                        
                         <div class="box-body">
                          @if( count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                    {{ $error }}
                                </div>
                             @endforeach
                          @endif
                        
                            {!! Form::open(array('url' =>'admin/addnewproduct', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}             
                            	<div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Product Type') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                          <option value="">{{ trans('labels.Choose Type') }}</option> 
                                          <option value="0">{{ trans('labels.Simple') }}</option>
                                      </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.Product Type Text') }}.</span>
                                  </div>
                                </div>
                                
                                <hr>                                           
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
                                          <li href="#" class="list-group-item"><label style="width:100%"><input id="categories_<?=$categories->id?>" type="checkbox" class=" required_one categories" name="categories[]" value="{{ $categories->id }}" > {{ $categories->name }}</label></li>
                                          @endif
                                              @if(!empty($categories->sub_categories))
                                              <ul class="list-group">
                                                    	<li class="list-group-item" >
                                                    @foreach ($categories->sub_categories as $sub_category)
                                                    @if(in_array($sub_category->sub_id,$cat_array))  
                                                    <label><input type="checkbox" name="categories[]" class="required_one sub_categories sub_categories_<?=$categories->id?>" parents_id = '<?=$categories->id?>' value="{{ $sub_category->sub_id }}"> {{ $sub_category->sub_name }}</label> @endif @endforeach</li>
                                                    
                                              </ul>
                                              @endif
                                          @endforeach                                          
                                        </ul>                                           
                                  @else
                                   <ul class="list-group list-group-root well">    
                                      @foreach ($result['categories'] as $categories)                                    
                                      <li href="#" class="list-group-item"><label style="width:100%"><input id="categories_<?=$categories->id?>" type="checkbox" class=" required_one categories" name="categories[]" value="{{ $categories->id }}" > {{ $categories->name }}</label></li>
                                          @if(!empty($categories->sub_categories))
                                          <ul class="list-group">
                                                    <li class="list-group-item" >
                                                @foreach ($categories->sub_categories as $sub_category)<label><input type="checkbox" name="categories[]" class="required_one sub_categories sub_categories_<?=$categories->id?>" parents_id = '<?=$categories->id?>' value="{{ $sub_category->sub_id }}"> {{ $sub_category->sub_name }}</label>@endforeach</li>
                                                
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
                                          <option value="">{{ trans('labels.ChooseManufacturers') }}</option>                                      	
                                         @foreach ($result['manufacturer'] as $manufacturer)
                                          <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                         @endforeach
                                      </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseManufacturerText') }}.</span>
                                  </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSale') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                       <select class="form-control" onChange="showFlash()" name="isFlash" id="isFlash">
                                          <option value="no">{{ trans('labels.No') }}</option>
                                          <option value="yes">{{ trans('labels.Yes') }}</option>
                                      </select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.FlashSaleText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="flash-container" style="display: none;">
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSalePrice') }}</label>
                                      <div class="col-sm-10 col-md-4">
                                        <input  class="form-control" type="text" name="flash_sale_products_price" id="flash_sale_products_price" value="">
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.FlashSalePriceText') }}</span>
                                        <span class="help-block hidden">{{ trans('labels.FlashSalePriceText') }}</span>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group">                                    
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSaleDate') }}</label>
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" readonly value="">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.FlashSaleDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" name="flash_start_time" readonly id="flash_start_time" value="" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group">                                    
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashExpireDate') }}</label>
                                      <div class="col-sm-10 col-md-2">
                                        <input  class="form-control datepicker" readonly type="text" readonly name="flash_expires_date" id="flash_expires_date" value="">     
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      	{{ trans('labels.FlashExpireDateText') }}</span>                               
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                      <div class="col-sm-10 col-md-2 bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="" >
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
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
                                <div class="form-group special-link">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Special') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                       <select class="form-control" onChange="showSpecial()" name="isSpecial" id="isSpecial">
                                          <option value="no">{{ trans('labels.No') }}</option>
                                          <option value="yes">{{ trans('labels.Yes') }}</option>
                                      </select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.SpecialProductText') }}.</span>
                                  </div>
                                </div>
                                
                                <div class="special-container" style="display: none;">
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SpecialPrice') }}</label>
                                      <div class="col-sm-10 col-md-4">
                                        <input  class="form-control" type="text" name="specials_new_products_price" id="special-price" value="">
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialPriceTxt') }}.</span>
                                        <span class="help-block hidden">{{ trans('labels.SpecialPriceNote') }}.</span>
                                      </div>
                                    </div>
                                    <div class="form-group">                                    
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExpiryDate') }}</label>                                      <div class="col-sm-10 col-md-4">
                                        <input  class="form-control datepicker" readonly readonly type="text" name="expires_date" id="expiry-date" value="">
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialExpiryDateTxt') }}
                                        </span>
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                      <div class="col-sm-10 col-md-4">
                                          <select class="form-control" name="status">
                                              <option value="1">{{ trans('labels.Active') }}</option>
                                              <option value="0">{{ trans('labels.Inactive') }}</option>
                                          </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.ActiveSpecialProductText') }}.</span>									  
                                      </div>
                                    </div>
                                </div>
                                
                                <hr>

                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Business age') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_age" class="form-control field-validate">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Business age') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Business age') }}</span>
                                  </div>
                              </div>

                                <hr>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Number Of Employees') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_emp" class="form-control field-validate">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Number Of Employees') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Number Of Employees') }}</span>
                                  </div>
                              </div>
                                <hr>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('website.Payback (month)') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <input type="number" name="products_payback" class="form-control field-validate">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('website.Payback (month)') }} </span>
                                      <span class="help-block hidden">{{ trans('website.Payback (month)') }}</span>
                                  </div>
                              </div>
                                <hr>

                              @foreach($result['languages'] as $languages)
                                
                                <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductName') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                            <input type="text" name="products_name_<?=$languages->languages_id?>" class="form-control field-validate">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductNameIn') }} {{ $languages->name }} </span>
                                      <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductCompanyName') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_company_name_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductCompanyNameIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductSite') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_site_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductSiteIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductTypesOfServices') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_types_of_services_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductTypesOfServicesIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductEmail') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_email_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductEmailIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductIncorporation') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_incorporation_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductIncorporationIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductCountry') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_country_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductCountryIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductAddress') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_address_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductAddressIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductProfit') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_profit_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductProfitIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductReason') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_reason_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductReasonIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductContact') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_contact_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductContactIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductPhone') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_phone_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductPhoneIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>




                                  <div class="form-group">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OrganizationName') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                          <input type="text" name="products_name_<?=$languages->languages_id?>" class="form-control field-validate">
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EnterProductNameIn') }} {{ $languages->name }} </span>
                                          <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                  </div>
                                
                                <div class="form-group external_link" style="display: none">
                                      <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.External URL') }} ({{ $languages->name }})</label>
                                      <div class="col-sm-10 col-md-4">
                                            <input type="text" name="products_url_<?=$languages->languages_id?>" class="form-control products_url">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.External URL Text') }} {{ $languages->name }} </span>
                                      <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                      </div>
                                </div>
                                                                
                                <div class="form-group">
                                	<label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }} ({{ $languages->name }})</label>
                                    <div class="col-sm-10 col-md-8">
                                    	<textarea id="editor<?=$languages->languages_id?>" name="products_description_<?=$languages->languages_id?>"class="form-control" rows="5"></textarea>
                                    	<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                       {{ trans('labels.EnterProductDetailIn') }} {{ $languages->name }}</span>
                                      </div>
                                </div>
                                                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.left banner') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                  	<input type="file" name="products_left_banner_<?=$languages->languages_id?>" id="products_left_banner_<?=$languages->languages_id?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner text') }}</span>
                                  </div>
                                </div>                                                                
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner start date') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_left_banner_start_date_<?=$languages->languages_id?>" id="products_left_banner_start_date_<?=$languages->languages_id?>">
                                    
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner start date text') }}</span>
                                  </div>
                                </div>
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner expire date') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_left_banner_expire_date_<?=$languages->languages_id?>" id="products_left_banner_expire_date_<?=$languages->languages_id?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner expire date text') }}</span>
                                  </div>
                                </div>
                                                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.right banner') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                  	<input type="file" name="products_right_banner_<?=$languages->languages_id?>" id="products_right_banner_<?=$languages->languages_id?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner text') }}</span>
                                  </div>
                                </div>
                                                               
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner start date') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_right_banner_start_date_<?=$languages->languages_id?>" id="products_right_banner_start_date_<?=$languages->languages_id?>">
                                    
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner start date text') }}</span>
                                  </div>
                                </div>
                                                               
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.banner expire date') }} ({{ $languages->name }})</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input class="form-control datepicker" readonly type="text" name="products_right_banner_expire_date_<?=$languages->languages_id?>" id="products_right_banner_expire_date_<?=$languages->languages_id?>">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.banner expire date text') }}</span>
                                  </div>
                                </div>
                                
                              @endforeach
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('products_price',  '', array('class'=>'form-control number-validate', 'id'=>'products_price')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductPriceText') }}
                                    </span>                                  
                                    <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }} BYN</label>
                                  <div class="col-sm-10 col-md-4">
                                      {!! Form::text('products_price_byn',  '', array('class'=>'form-control number-validate', 'id'=>'products_price_byn')) !!}
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductPriceText') }}
                                    </span>
                                      <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                  </div>
                              </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsModel') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('products_model',  '', array('class'=>'form-control', 'id'=>'products_model')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ProductsModelText') }}
                                    </span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::file('products_image', array('id'=>'products_image', 'class'=>'field-validate')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.UploadProductImageText') }}</span>
                                  </div>
                                </div>
                                                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.IsFeature') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="is_feature">
                                          <option value="0">{{ trans('labels.No') }}</option>
                                          <option value="1">{{ trans('labels.Yes') }}</option>                                       
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.IsFeatureProuctsText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_status">
                                          <option value="1">{{ trans('labels.Active') }}</option>
                                          <option value="0">{{ trans('labels.Inactive') }}</option>                                       
                                      </select>
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