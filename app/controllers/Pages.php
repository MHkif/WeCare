<?php

class Pages extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $params = [
            'title' => "HOME",
        ];

        $this->view('pages/index', $params);
    }
}
