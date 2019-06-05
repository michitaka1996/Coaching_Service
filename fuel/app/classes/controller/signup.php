<?php
use Fuel\Core\Controller;
use Fuel\Core\Fieldset;
use Fuel\Core\Log;
use Fuel\Core\Response;

//やる処理 バリデーションして　ビューに処理を渡す
class Controller_Signup extends Controller
{
    const PASS_MIN = 6;
    const PASS_MAX = 20;

    public function action_index()
    {
        Log::debug('サインアップ画面');
        $error = '';
        $formData = '';
        //fieldSetで自動的に書いてくれる
        //form全体をオブジェクトとして扱うことのできるクラス
        //引数は一意　名前をつけることができる
        $form = Fieldset::forge('signupform');

        $form->add('username', 'ユーザー名', array('type' => 'text', 'placeholder' => 'ユーザー名'))
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);

        $form->add('email', 'Email', array('type' => 'email', 'placeholder' => 'Email'))
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);


        //self::　で自分のプロパティにアクセス
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

        $form->add('submit', '', array('type' => 'submit', 'value' => '登録'));







        //Inputクラスは静的メンバ
        if (Input::method() === 'POST') {
            Log::debug('POST送信がありました');
            //入力のあった内容  formの確認
            $val = $form->validation();

            if ($val->run()) {
                Log::debug('入力内容があります');
                //入力内容を勝手にバリデーションしたやつs
                $formData = $val->validated();
                Log::debug('入力内容' . print_r($formData, true));
                $auth = Auth::instance();

                if ($auth->create_user($formData['username'], $formData['password'], $formData['email'])) {
                    //ログイン成功時
                    Log::debug('ログイン成功しました');
                    Session::set_flash('sucMsg', 'ユーザー登録が完了しました！');
                    Response::redirect('members/mypage');
                } else {
                    //ログイン失敗時
                    Log::debug('ログイン失敗しました');
                    $error = $val->error();
                    Session::set_flash('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
                }
                $form->repopulate();
            } else if (!($val->run())) {
                Log::debug('なんらかの要因によりバリデーション失敗しました');
                $error = $val->error();
                Log::debug('エラー内容' . print_r($error, true));
                Session::set_flash('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
            }
        }





        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('auth/signup'));
        $view->set('footer', View::forge('template/footer'));
        $view->set_global('signupform', $form->build(''), false); //falseはデフォルト値

        return $view;
    }
}
