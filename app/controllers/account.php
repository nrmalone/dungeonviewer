<?php

class Account extends Controller
{
    public function index()
    {
        $user = $this->loadModel('User');
        $data['title_page'] = 'Account Info';

        $userModel = new User;

        $this->view('account', $data);
        $userModel->updateaccount($_POST);
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

    public function signout()
    {
        $user = $this->loadModel('User');

        $userModel = new User;
        $userModel->signout();
    }
}