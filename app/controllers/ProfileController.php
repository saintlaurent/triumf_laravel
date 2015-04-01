<?php
/**
 * Created by PhpStorm.
 * User: Catherine
 * Date: 4/1/15
 * Time: 11:08 AM
 */


class ProfileController extends BaseController {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */



    public function signIn()
    {
        // How to implement http://laravel.com/docs/4.2/security
        $auth = Auth::attempt(
            array(
                'user_name' => Input::get('username'), // Check email
                'hashed_password' => Input::get('password')
            )
        );
       

        if($auth)
        {
            //return "logged in";
            $username = Input::get('username');
            $user = User::where('user_name', '=', $username);

            //  return View::make('blog')->with('posts', $posts);
            if ($user->count()){

                $user = $user->first();

                return View::make('home')->with('user',$user);
            }
            return "<p>Sorry, profile not found.</p>";
        }
        else
        {
            return "failed to login";
        }
    }

}

