<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang; 
use App\User;
use App\UserProject;
use App\UserPrivileges;
use App\Menu;
use App\LogTransaction;
use DB;
use Cookie;

trait AuthenticatesUsers
{
    use RedirectsUsers;

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return $this->showLoginForm();
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
		 
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
         
        $credentials = $this->getCredentials($request);
        
        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) { 
             
			//get ip address
			$ip=\Request::getClientIp();
			 
            //set session list project that user has been located   
            $userID = Auth::user()->user_id;

            $listProject = DB::table('t_user_project AS userProject')
                ->select(
                'userProject.project_id', 
                'project.pt_name',
                'project.project_name' 
                ) 
                ->join('m_project AS project', 'project.project_id', '=', 'userProject.project_id') 
                ->where('userProject.user_id',$userID)
                ->orderBy('pt_name', 'ASC')
                ->get();   
    //            return $listProjectAndPT[0]->pt_id; 
            session()->set('listProject', $listProject); 

            //get Authorization then List Menu that user can accessed
            //select menu which groupID = Userlogin GroupID
            $groupUserID = Auth::user()->group_user_id;  
            $userPrivileges = UserPrivileges::where('group_user_id',(int)$groupUserID)->get();
            
            $listMenuID = array();
            foreach($userPrivileges as $p){
                array_push($listMenuID, $p->menu_id);
            }
            $listMenu = Menu::whereIn('menu_id', $listMenuID)->orderBy('child_no')->get();
            
            
//            $listMenu = Menu::where(function($query) {
//                        //get user groupID
//                        
//
//                        $query->where('group_user_id', $groupID)
//                              ->orWhere('group_user_id', 0);
//                        })->get(); 
            session()->set('listMenu', $listMenu);    
            
            //Make log login
            $data = array(); 
            $data['username'] = Auth::user()->email;  
            $data['activity_type'] = "Login Web";   
            $data['ip'] = $ip;   
            LogTransaction::insert($data);  
			
			//set cookie
			Cookie::queue('cashbank_username',$request['email'] , (86400 * 120)); 
			Cookie::queue('cashbank_password',$request['password'] , (86400 * 120));
         
            
            return $this->handleUserWasAuthenticated($request, $throttles); 
        } 

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) { 
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }
        
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->logout();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
