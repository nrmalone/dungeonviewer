<?php

class User extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Account';

        $this->view('account', $data);
    }

    public function signup()
    {
        $data['title_page'] = 'Signup';

        $this->view('signup', $data);
    }

    public function signin()
    {
        $data['title_page'] = 'Signin';

        $this->view('signin', $data);
    }
}