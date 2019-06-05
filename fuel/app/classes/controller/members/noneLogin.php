<?php
use Fuel\Core\View;

class Controller_NoneLogin extends Controller
{

    public function action_index()
    {
        Log::debug('ログインしてくださいページです');
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('auth/noneLogin'));
        $view->set('footer', View::forge('template/footer'));

        return $view;
    }
}
