<?php
/*
Project Name: IonicEcommerce
Project URI: http://ionicecommerce.com
Author: VectorCoder Team
Author URI: http://vectorcoder.com/

*/
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Validator;
use App;
use Lang;
use DB;
//for password encryption or hash protected
use Hash;
use App\Administrator;

//for authenitcate login data
use Auth;



//for requesting a value 
use Illuminate\Http\Request;


class AdminRegionController extends Controller
{

    public function getRegionByCounty($country) {
        return DB::table('region')->where('region_countries_id', '=', $country)->get();
    }
	//listingCountries
	public function region(Request $request){
		$title = array('pageTitle' => Lang::get("labels.ListingCountries"));		
		
		$countryData = array();
		$message = array();
		$errorMessage = array();
		
		$regions = DB::table('region')->leftJoin('countries', 'countries_id', '=', 'region_countries_id')
			->orderBy('region_id','ASC')
			->paginate(60);

		
		$countryData['message'] = $message;
		$countryData['region'] = $regions;
		
		return view("admin.regions",$title)->with('countryData', $countryData);
	}
	
	//addcountry
	public function addregion(Request $request){
		$title = array('pageTitle' => Lang::get("labels.AddCountry") );
		
		$countryData = array();
		$message = array();
		$errorMessage = array();
		$countries = DB::table('countries')->select('countries_id', 'countries_name')->get();
		
		$countryData['message'] = $message;
        $countryData['countries'] = $countries;
        $temp = [];
        foreach ($countries as $country) {
            $temp[$country->countries_id] = $country->countries_name;
        }
        $countryData['countries'] = $temp;
		return view("admin.addregion",$title)->with('countryData', $countryData);
	}
		
	//addnewcountry	
	public function addnewregion(Request $request){
		
		$title = array('pageTitle' => Lang::get("labels.EditRegion"));
		$countryData = array();
		
		$categories_id = DB::table('region')->insertGetId([
					'region_name'  		 =>   $request->region_name,
					'region_countries_id'	 =>   $request->region_countries_id
					]);

		$countries = DB::table('countries')->select('countries_id', 'countries_name')->get();
        $countryData['countries'] = $countries;
        $temp = [];
        foreach ($countries as $country) {
            $temp[$country->countries_id] = $country->countries_name;
        }
        $countryData['countries'] = $temp;


		$countryData['message'] = Lang::get("labels.RegionAddedMessage");
		return view('admin.addregion', $title)->with('countryData', $countryData);
	}
	
	//editCountry
	public function editregion(Request $request){
		$title = array('pageTitle' => Lang::get("labels.EditCountry"));
		$countryData = array();		
		$countryData['message'] = array();
		
		$region = DB::table('region')->where('region_id', $request->id)->get();
        $countries = DB::table('countries')->select('countries_id', 'countries_name')->get();
        $countryData['countries'] = $countries;
        $temp = [];
        foreach ($countries as $country) {
            $temp[$country->countries_id] = $country->countries_name;
        }
        $countryData['countries'] = $temp;
		$countryData['region'] = $region;
		return view("admin.editregion",$title)->with('countryData', $countryData);
	}
	
	//updatecountry
	public function updateregion(Request $request){
		
		$title = array('pageTitle' => Lang::get("labels.EditCountry"));
		
		$countryData = array();		
		$countryData['message'] = Lang::get("labels.CountryUpdatedMessage");
				
		$countryUpdate = DB::table('region')->where('region_id', $request->id)->update([
					'region_name'  		 =>   $request->region_name,
					'region_countries_id'	 =>   $request->region_countries_id
					]);
        $countries = DB::table('countries')->select('countries_id', 'countries_name')->get();
        $countryData['countries'] = $countries;
        $temp = [];
        foreach ($countries as $country) {
            $temp[$country->countries_id] = $country->countries_name;
        }
        $countryData['countries'] = $temp;
		$country = DB::table('region')->where('region_id', $request->id)->get();
		$countryData['region'] = $country;
		
		return view("admin.editregion",$title)->with('countryData', $countryData);
	}
	
	//deletecountry
	public function deleteregion(Request $request){
		DB::table('region')->where('region_id', $request->id)->delete();
		return redirect()->back()->withErrors([Lang::get("labels.CountryDeletedMessage")]);
	}
}
