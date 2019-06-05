<?php
use Fuel\Core\Fieldset;
use Auth\Auth;
use Fuel\Core\Response;

class Controller_Signin extends Controller
{
    const PASS_MIN = 6;
    const PASS_MAX = 20;

    public function action_index()
    {

        Log::debug('ログイン画面');
        $error = '';
        $formData = '';

        $form = Fieldset::forge('signinform');


        $form->add('username', 'ユーザー名', array('type' => 'text', 'placeholder' => 'ユーザー名'))
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);


        $form->add('password', 'Password', array('type' => 'password', 'placeholder' => 'パスワード'))
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_MIN)
            ->add_rule('max_length', self::PASS_MAX);

        $form->add('password_re', 'Password（再入力）', array('type' => 'password', 'placeholder' => 'パスワード（再入力）'))
            // match_fieldをつける場合は必ず他のadd_ruleの前につける
            ->add_rule('match_field', 'password')
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_MIN)
            ->add_rule('max_length', self::PASS_MAX);

        $form->add('submit', '', array('type' => 'submit', 'value' => 'ログイン'));



        if (Input::method() === 'POST') {
            Log::debug('POST送信がありました');
            $val = $form->validation();

            if ($val->run()) {
                Log::debug('入力内容が取得できました');
                $formData = $val->validated();
                Log::debug('ユーザー情報とマッチしているか確認していきます');
                //auth認証で
                $auth = Auth::instance();
                if ($auth->login($formData['username'], $formData['password'])){
                    Log::debug('ユーザー情報とマッチしています');
                    Response::redirect('members/mypage');
                }else{
                    Log::debug('ログイン失敗しました');
                    $error = $val->error();
                }
            }else{
                Log::debug('バリデーション失敗しました');
                $error = $val->error();
                Log::debug('エラー内容'.print_r($error, true));
            }
        }


        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('auth/signin'));
        $view->set('footer', View::forge('template/footer'));
        $view->set_global('signinform', $form->build(''), false);
        return $view;
    }
}
