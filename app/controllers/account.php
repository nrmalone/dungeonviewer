<?php

class Account extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Account';

        $this->view('account', $data);
    }

    public function signup()
    {
        $user = $this->loadModel('User');
        $data['title_page'] = 'Signup';

        $this->view('signup', $data);

        $userModel = new User;
        $userModel->signup($_POST);
    }

    public function signin()
    {
        $user = $this->loadModel('User');
        $data['title_page'] = 'Signin';

        $this->view('signin', $data);

        $userModel = new User;
        $userModel->signin($_POST);
    }
}