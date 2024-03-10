<?php

class Home extends Controller
{
    public function index()
    {
        $DB = new Database();
        $data['title_page'] = WEBSITE_NAME . ' - Home';
        $this->view('home', $data);
    }

    public function sitepolicies()
    {
        $data['title_page'] = 'Site Policies';
        $this->view('sitepolicies', $data);
    }

    public function about()
    {
        $data['title_page'] = 'About ' . WEBSITE_NAME;
        $this->view('about', $data);
    }
}