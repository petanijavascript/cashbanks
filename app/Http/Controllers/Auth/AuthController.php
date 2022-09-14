<?php 
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller; 
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers; 
class AuthController extends Controller {
  
    
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $redirectTo = '/';
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'logout']]);
    }
 
    protected function validator(array $data)
    {  
        return Validator::make($data, [  
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
    } 
      
//    protected function create(array $data)
//    {
//        return User::create([ 
//            'Username' => $data['username'], 
//            'Password' => bcrypt($data['password']),
//            'FirstName' => $data['firstname'], 
//            'LastName' => $data['lastname'], 
//            'Email' => $data['email'], 
//            'GroupID' => $data['groupid'], 
//        ]);
//    }
    
     public function getLogout()
    { 
        session()->flush();
        return $this->logout();
    }
    
     
    
}
