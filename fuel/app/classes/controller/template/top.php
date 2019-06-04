<?php

class Controller_Template_Top extends Controller{

    public function action_index(){
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));

        return $view;
    }
}