<?php 
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class StuAuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('StudentIsLoggedIn')) {
            return redirect()->to(base_url('/student-login'))->with('alert_error','You must be logged in!');
        }else{
            /*$is_franchise = $this->check_franchise();
            if(! $is_franchise){
                return redirect()->to('/member-dashboard')->with('alert_error','You must be Franchise!');
            }*/
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
    /*public function check_franchise(){
        helper('custom');
        if(url_is('/registration-list') ||
            url_is('/new-registration') ||
            url_is('/edit-registration/*') ||
            url_is('/view-registration/*') ||
            url_is('/registration-d/*') ||
            url_is('/get_districts') ||
            url_is('/certified-stu-list') || 
            url_is('/download_cert/*') || 
            url_is('/download_marksheet/*') || 
            url_is('/edit-request/*')
        ){
            return is_franchise();
        }
        return true;
    }*/
}