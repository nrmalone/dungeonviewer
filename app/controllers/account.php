<?php

class Account extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Account Info';

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

    public function signout()
    {
        $user = $this->loadModel('User');

        $userModel = new User;
        $userModel->signout();
    }

    public function updateusername()
    {
        $user = $this->loadModel('User');
        $data['title_page'] = 'Update Username';

        $this->view('account', $data);

        $userModel = new User;
        $userModel->updateusername($_POST);
    }

    public function updateemail()
    {
        $user = $this->loadModel('User');
        $data['title_page'] = 'Update Email';

        $this->view('account', $data);

        $userModel = new User;
        $userModel->updateemail($_POST);
    }
}