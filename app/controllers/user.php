<?php

class User extends Controller
{
    public function index()
    {
        $data['title_page'] = 'DND Viewer - User Info';

        $this->view('signin', $data);
    }
}