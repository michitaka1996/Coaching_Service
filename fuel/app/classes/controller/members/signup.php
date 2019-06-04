<?php
use Fuel\Core\Controller;
use Fuel\Core\Fieldset;

//やる処理 バリデーションして　ビューに処理を渡す
class Controller_Member_Signup extends Controller
{
    const PASS_MIN = 6;
    const PASS_MAX = 20;

    public function action_index()
    {
        $error = '';
        $formData = '';
        //fieldSetで自動的に書いてくれる
        //form全体をオブジェクトとして扱うことのできるクラス
        //引数は一意　名前をつけることができる
        $form = Fieldset::forge('signupForm');

        $form->add('username', 'ユーザー名', array('type' => 'text', 'placeholder' => 'ユーザー名'))
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 1);

        $form->add('email', 'Email', array('type' => 'email', 'placeholder' => 'Email'))
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 1);


        $form->add('password', 'Password', array('type' => 'password', 'placeholder' => 'パスワード'))
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('min_length', PASS_MIN)
            ->add_rule('max_length', PASS_MAX);
        
        //Inputクラスは静的メンバ
        if(Input::method() == 'POST'){
            
            $val = $form->validation();
            //バリデーションtrueなら simpleauthを使って実際にログイン
            if($val->run){
                $formData = $val->vaildated();
                Log::debug($formData);
                $auth = Auth::instance();

            }
        }
    }
}
