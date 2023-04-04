<?php

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\CurdModel;


class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('adminlogin'))
        {
            return redirect()->to('/web-admin');
        }
        else
        {
            if(session()->has('adminlogin'))
            {
                $this->curd_model = new CurdModel;
                $data['session'] = session()->get('adminlogin');
                $user = $this->curd_model->get_1('*', 'login', array('id'=>$data['session']['user_id']));
                if($user->session_id ==  $data['session']['login_id'])
                {
                    $this->curd_model->update_session();
                }
                else
                {
                    session()->remove('adminlogin');
                    return redirect()->to('/web-admin');
                }
                
            }
            else
            {
                return redirect()->to('/web-admin');
            }
            
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}

?>