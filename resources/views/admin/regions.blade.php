@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>  {{ trans('labels.Region') }} <small>{{ trans('labels.ListingRegion') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active"> {{ trans('labels.Region') }}</li>
    </ol>
  </section>
  
  <!--  content -->
  <section class="content"> 
    <!-- Info boxes --> 
    
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('labels.ListingRegion') }} </h3>
            <div class="box-tools pull-right">
            	<a href="addregion" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddRegion') }}</a>
            </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">              		
				  @if (count($errors) > 0)
					  @if($errors->any())
						<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  {{$errors->first()}}
						</div>
					  @endif
				  @endif
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('labels.ID') }}</th>
                      <th>{{ trans('labels.RegionName') }}</th>
                      <th>{{ trans('labels.CountryName') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($countryData['region'])>0)
                    @foreach ($countryData['region'] as $key=>$countries)
                        <tr>
                            <td>{{ $countries->region_id }}</td>
                            <td>{{ $countries->region_name }}</td>
                            <td>{{ $countries->countries_name }}</td>
                            <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editregion/{{ $countries->region_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a  data-toggle="tooltip" data-placement="bottom" title=" {{ trans('labels.Delete') }}" id="deleteRegionId" region_id ="{{ $countries->region_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                           </td>
                        </tr>
                    @endforeach
                    @else
                       <tr>
                            <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                       </tr>
                    @endif
                  </tbody>
                </table>
                <div class="col-xs-12 text-right">
                	{{$countryData['region']->links('vendor.pagination.default')}}
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
        <!-- deleteCountryModal -->
	<div class="modal fade" id="deleteRegionModal" tabindex="-1" role="dialog" aria-labelledby="deleteRegionModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteRegionModalLabel">{{ trans('labels.DeleteCountry') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/deleteregion', 'name'=>'deleteRegion', 'id'=>'deleteRegion', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'region_id')) !!}
		  <div class="modal-body">						
			  <p>{{ trans('labels.DeleteRegionText') }}</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary" id="deleteCountry">{{ trans('labels.DeleteRegion') }}</button>
		  </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>
    
    <!--  row --> 
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
@endsection 