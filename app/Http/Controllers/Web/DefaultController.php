<?php
/*
Project Name: IonicEcommerce
Project URI: http://ionicecommerce.com
Author: VectorCoder Team
Author URI: http://vectorcoder.com/
*/
namespace App\Http\Controllers\Web;
//use Mail;
//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
//for Carbon a value 
use Carbon;

//email
use Illuminate\Support\Facades\Mail;
use Session;

class DefaultController extends DataController
{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	//setStyle
	public function setStyle(Request $request){		
		session(['homeStyle' => $request->style]);		
		return redirect('/');
	}
	
	//
	public function settheme(Request $request){		
		session(['theme' => $request->theme]);		
		return redirect('/');
	}
	
	
	//index 
	public function index(Request $request){
		
		$title = array('pageTitle' => Lang::get("website.Home"));
		$result = array();			
		$result['commonContent'] = $this->commonContent();

		if(!empty($request->limit)){
			$limit = $request->limit;
		}else{
			$limit = 12;
		}
		
		//min_price
		if(!empty($request->min_price)){
			$min_price = $request->min_price;
		}else{
			$min_price = '';
		}

        if(!empty($request->countries_id)){
            $countries_id = $request->countries_id;
        }else{
            $countries_id = '';
        }
        if(!empty($request->region_id)){
            $region_id = $request->region_id;
        }else{
            $region_id = '';
        }
		
		//max_price
		if(!empty($request->max_price)){
			$max_price = $request->max_price;
		}else{
			$max_price = '';
		}

        if(!empty($request->min_emp)){
            $min_emp = $request->min_emp;
        }else{
            $min_emp = '';
        }

        //max_price
        if(!empty($request->max_emp)){
            $max_emp = $request->max_emp;
        }else{
            $max_emp = '';
        }


        if(!empty($request->min_age)){
            $min_age = $request->min_age;
        }else{
            $min_age = '';
        }

        //max_price
        if(!empty($request->max_age)){
            $max_age = $request->max_age;
        }else{
            $max_age = '';
        }

        if(!empty($request->min_payback)){
            $min_payback = $request->min_payback;
        }else{
            $min_payback = '';
        }

        //max_price
        if(!empty($request->max_payback)){
            $max_payback = $request->max_payback;
        }else{
            $max_payback = '';
        }
		
		//products
		$myVar = new DataController();
		$data = array(
		    'page_number'=>'0',
            'type'=>'',
            'limit'=>10,
            'min_price'=>$min_price,
            'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,
        );
		$special_products = $myVar->products($data);
		$result['products'] = $special_products;
		
		//special products
		$myVar = new DataController();
		$data = array('page_number'=>'0', 'type'=>'special', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,);
		$special_products = $myVar->products($data);
		$result['special'] = $special_products;
		
		//top seller
		$myVar = new DataController();
		$data = array('page_number'=>'0', 'type'=>'topseller', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,);
		$top_seller = $myVar->products($data);
		$result['top_seller'] = $top_seller;
		
		//most liked
		$myVar = new DataController();
		$data = array('page_number'=>'0', 'type'=>'mostliked', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,);
		$most_liked = $myVar->products($data);
		$result['most_liked'] = $most_liked;
		
		//is feature
		$myVar = new DataController();
		$data = array('page_number'=>'0', 'type'=>'is_feature', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,);
		$featured = $myVar->products($data);
		$result['featured'] = $featured;
		
		//is feature
		$myVar = new DataController();
		$data = array('page_number'=>'0', 'type'=>'flashsale', 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price,
            'min_emp'=>$min_emp,
            'max_emp'=>$max_emp,
            'min_age'=>$min_age,
            'max_age'=>$max_age,
            'min_payback'=>$min_payback,
            'max_payback'=>$max_payback,
            'region_id' => $region_id,
            'countries_id' => $countries_id,);
		$flash_sale = $myVar->products($data);
		$result['flash_sale'] = $flash_sale;
		//dd($result['flash_sale']);
		
		//news
		$myVar = new NewsController();
		$data = array('page_number'=>'0', 'type'=>'', 'limit'=>3, 'is_feature'=>1);
		$news = $myVar->getAllNews($data);
		$result['news'] = $news;
		
		//current time
		$currentDate = Carbon\Carbon::now();
		$currentDate = $currentDate->toDateTimeString();
		
		$slides = DB::table('sliders_images')
		   ->select('sliders_id as id', 'sliders_title as title', 'sliders_url as url', 'sliders_image as image', 'type', 'sliders_title as title')
		   ->where('status', '=', '1')
		   ->where('languages_id', '=', session('language_id'))
		   ->where('expires_date', '>', $currentDate)
		   ->get();
		
		$result['slides'] = $slides;
		
		//cart array
		$cart = '';
		$myVar = new CartController();
		$result['cartArray'] = $myVar->cartIdArray($cart);
		
		//liked products
		$result['liked_products'] = $this->likedProducts();
		
		$orders =  DB::select(DB::raw('SELECT orders_id FROM orders WHERE YEARWEEK(CURDATE()) BETWEEN YEARWEEK(date_purchased) AND YEARWEEK(date_purchased)'));
		
		if(count($orders)>0){
			$allOrders = $orders;
		}else{
			$allOrders =  DB::table('orders')->get();
		}
		
		$temp_i = array();
		foreach($allOrders as $orders_data){
			$mostOrdered = DB::table('orders_products')
							->select('orders_products.products_id')
							->where('orders_id', $orders_data->orders_id)
							->get();
			
			foreach($mostOrdered as $mostOrderedData){
				$temp_i[] = $mostOrderedData->products_id;		
			}		
		}	
		$detail = array();
		$temp_i = array_unique($temp_i);				
		foreach($temp_i as $temp_data){			
			$myVar = new DataController();
			$data = array('page_number'=>'0', 'type'=>'', 'products_id'=>$temp_data, 'limit'=>7, 'min_price'=>'', 'max_price'=>'',
                'min_emp'=>$min_emp,
                'max_emp'=>$max_emp,
                'min_age'=>$min_age,
                'max_age'=>$max_age,
                'min_payback'=>$min_payback,
                'max_payback'=>$max_payback,
                'region_id' => $region_id,
                'countries_id' => $countries_id,);
			$single_product = $myVar->products($data);
			if(!empty($single_product['product_data'][0])){
				$detail[] = $single_product['product_data'][0];
			}
		}
		
		$result['weeklySoldProducts'] = array('success'=>'1', 'product_data'=>$detail,  'message'=>"Returned all products.", 'total_record'=>count($detail));
		
		return view("index", $title)->with('result', $result); 
		
	}
	
	//myContactUs
	public function ContactUs(Request $request){
		$title = array('pageTitle' => Lang::get("website.Contact Us"));
		$result = array();			
		$result['commonContent'] = $this->commonContent();
		
		return view("contact-us", $title)->with('result', $result); 
	}
	
	//processContactUs
	public function processContactUs(Request $request){
		$name 		=  $request->name;
		$email 		=  $request->email;
		$subject 	=  $request->subject;
		$message 	=  $request->message;
		
		$result['commonContent'] = $this->commonContent();
		
		$data = array('name'=>$name, 'email'=>$email, 'subject'=>$subject, 'message'=>$message, 'adminEmail'=>$result['commonContent']['setting'][3]->value);
		
		Mail::send('/mail/contactUs', ['data' => $data], function($m) use ($data){
			$m->to($data['adminEmail'])->subject(Lang::get("website.contact us title"))->getSwiftMessage()
			->getHeaders()
			->addTextHeader('x-mailgun-native-send', 'true');	
		});
		
		return redirect()->back()->with('success', Lang::get("website.contact us message"));
	}
	
	//page
	public function page(Request $request){
		
		$pages = DB::table('pages')
					->leftJoin('pages_description','pages_description.page_id','=','pages.page_id')
					->where([['pages.status','1'],['type',2],['pages_description.language_id',session('language_id')],['pages.slug',$request->name]])->get();
		
		if(count($pages)>0){
			$title = array('pageTitle' => $pages[0]->name);
			$result['commonContent'] = $this->commonContent();
			$result['pages'] = $pages;			
			return view("page", $title)->with('result', $result);
		
		}else{
			return redirect()->intended('/') ;
		}
	}
	
	
}