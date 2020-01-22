<?php


class PagesController extends Controller {
    function __construct(){

    }

    public function index(){
        $this->view('pages/index');
    }
}