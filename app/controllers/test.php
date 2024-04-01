<?php

class Test extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Test Chat';

        $this->view('testchat', $data);
    }
}