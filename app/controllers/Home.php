<?php

class Home extends Controller{

    public function index($title = '') {
        $post = $this->model('Post');
        $post->title = "This is our title";

        $this->view('home', ['title' => $post->title]);
    }

    public function register() {
        echo "this is register page";
    }
}

