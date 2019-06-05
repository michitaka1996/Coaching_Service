<?php
use Fuel\Core\Response;

class Controller_Members extends Controller{
    public function before(){
        if(!Auth::check()){
            //ログインできてなければ　ログインページへ
            // Response::redirect()
        }
    }
}




//ベースコントローラ　