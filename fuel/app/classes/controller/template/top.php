<?php

class Controller_Template_Top extends Controller{

    public function action_index(){
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('moc/top'));
        $view->set('footer', View::forge('template/footer'));
        return $view;
    }
}