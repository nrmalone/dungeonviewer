<?php

class Home extends Controller
{
    public function index()
    {
        $DB = new Database();
        $data['title_page'] = WEBSITE_NAME . ' - Home';
        $this->view('home', $data);
    }
}