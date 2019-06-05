<?php
use Fuel\Core\Response;

class Controller_Members extends Controller
{
    public function before()
    {
        if (!Auth::check()) {
            Log::debug('ログイン認証失敗です');
            Response::redirect('auth/noneLogin');
        } else {
            Log::debug('ログイン認証成功です');
        }
    }

    public function action_logout()
    {
        $auth = Auth::instance();
        Log::debug('ログアウトしてTOPへリダイレクトします');
        if ($auth->logout()) {
            Response::redirect('template/top');
        }
    }
}
