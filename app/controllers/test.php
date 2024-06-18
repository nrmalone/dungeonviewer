<?php

class Test extends Controller
{
    public function index()
    {
        $data['title_page'] = 'testing page';

        $test = $this->loadModel('TestModel');
        $testModel = new TestModel;

        $this->view('test', $data);

        $testModel->testSanitization($_POST);
    }

    public function display($userID) {
        $test = $this->loadModel('TestModel');
        $testModel = new TestModel;

        $data['user'] = $testModel->display($userID);
        $this->view('testdisplay', $data);
    }
}