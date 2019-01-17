<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Auth;
class CronController extends Controller{
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Log out Back
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
        
    }
    
   // Using for the user assign question for reviewe
    public function getAssignQuestion(){
      \UserService::CronUserList();
     }
    
}
