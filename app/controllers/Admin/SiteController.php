<?php
namespace Admin;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends BaseController {

    public function index()
    {

        return $this->theme->scope('site.index')->render();
    }
    public function login()
    {
        $method = \Request::method();

        if(\Request::isMethod('post')){
            $credentials = array(
                'email' => \Input::get('email'),
                'password' => \Input::get('password')
            );
            try
            {
                $user = \Sentry::authenticate($credentials, false);
                if ($user)
                {
                    if(\Input::get('remember')=='true')
                        \Sentry::loginAndRemember($user);
                    else
                        \Sentry::login($user, false);
                }
                return \Redirect::route('admin/dashboard');
            }
            catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                echo 'Password field is required.';
            }
            catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                echo 'Login field is required.';
            }
            catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                echo 'User not activated.';
            }
            catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                echo 'User not found.';
            }
        }
        return $this->theme->layout('login')->scope('site.login')->render();
    }
    public function logout()
    {
        \Sentry::logout();
        return \Redirect::to('admin/login');
    }
}
