<?php 
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MemAlreadyLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('MemberIsLoggedIn')) {
            return redirect()->to(base_url('/member-dashboard'));
            //echo 'hi'; exit;
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}