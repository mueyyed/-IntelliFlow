<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        dd("dd");

        return view('welcome_message');
    }

    //--------------------------------------------------------------------

}
