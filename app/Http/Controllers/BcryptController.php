<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;  
class BcryptController extends Controller {

   
    
	public function index(Request $pass)
	{ 
        dd(bcrypt($pass));
        
	}
     
  

}
