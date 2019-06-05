<?php
use Fuel\Core\Controller;

class Controller_Members_Mypage extends Controller{
    public function action_index(){

        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('members/mypage'));
        $view->set('footer', View::forge('template/footer'));

        return $view;
    }
}