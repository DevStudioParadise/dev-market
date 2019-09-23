@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.AddRegion') }} <small>{{ trans('labels.AddRegion') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/region')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.ListingRegion') }} </a></li>
      <li class="active">{{ trans('labels.AddRegion') }} </li>
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
            <h3 class="box-title">{{ trans('labels.AddRegion') }}</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              	  <div class="box box-info"><br>

                       	@if($countryData['message'])

						<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						 {{ $countryData['message'] }}
						</div>
						@endif
						
                        <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                        <!-- /.box-header -->
                        <!-- form start -->                        
                         <div class="box-body">

                            {!! Form::open(array('url' =>'admin/addnewregion', 'method'=>'post', 'class' => 'form-horizontal  form-validate', 'enctype'=>'multipart/form-data')) !!}

                            <div class="form-group">
								<label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CountryName') }}
                                </label>
								<div class="col-sm-10 col-md-4">
									{!! Form::select('region_countries_id', $countryData['countries'])!!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.CountryNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
								</div>
							</div>
                             <div class="form-group">
								<label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.RegionName') }}
                                </label>
								<div class="col-sm-10 col-md-4">
									{!! Form::text('region_name',  '', array('class'=>'form-control  field-validate', 'id'=>'region_name'))!!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.RegionNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
								</div>
							</div>
							

							
							<!-- /.box-body -->
							<div class="box-footer text-center">
								<button type="submit" class="btn btn-primary">{{ trans('labels.AddRegion') }}</button>
								<a href="{{ URL::to('admin/region')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
@endsection 