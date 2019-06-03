<?php

class Controller_Signup extends Controller
{
    const PASS_LENGTH_MIN = 6;
    const PASS_LENGTH_MAX = 20;

    public function action_index()
    {
        $error = '';
        $formData = '';

        // Fieldestクラスは、formの生成や入力された中身のバリデーションをしてくれる
        // 実際の生成やバリデーション処理はFormクラスとValidationクラスが行っている
        //第１にはインスタンスに名前をつけることができる
        $form = Fieldset::forge('signupform');

        //ユーザー名、email,パスワード、パスワード再　でー＞addでformインスタンスのメソッドにアクセス


        // addメソッドでformを生成、第一引数：name属性の値、第二引数：ラベルの文言、第三引数：色々な属性を配列形式で
        // add_ruleメソッドでバリデーションを設定（使えるルールはValidationクラスと全く同じ。Validationクラスを使っているので。）
        $form->add('username', 'ユーザー名', array('type'=>'text', 'placeholder'=>'ユーザー名'))
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);

        $form->add('email', 'Email', array('type'=>'email', 'placeholder'=>'Email'))
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);

        $form->add('password', 'Password', array('type'=>'password', 'placeholder'=>'パスワード'))
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_LENGTH_MIN)
            ->add_rule('max_length', self::PASS_LENGTH_MAX);

        $form->add('password_re', 'Password（再入力）', array('type'=>'password', 'placeholder'=>'パスワード（再入力）'))
            // match_fieldをつける場合は必ず他のadd_ruleの前につける
            ->add_rule('match_field', 'password')
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_LENGTH_MIN)
            ->add_rule('max_length', self::PASS_LENGTH_MAX);
        
        //submitタグを作ってあげる
        $form->add('submit', '', array('type'=>'submit', 'value'=>'登録'));


        //ボタンを押したときにはメソッドか帰ってくる if(!empty($post)){}と同じ
        // Inputクラス　Input::method()でHTTPメソッドが返ってくるので、POSTかどうかを確認
        if (Input::method() === 'POST') {

            // バリデーションインスタンスを取得
            $val = $form->validation();
             //バリデーションクラスにはrunメソッドが用意されている　runメソッドでバリデーションを実行
            //バリデーションに引っかかっているかどうか判定
            if ($val->run()) {
                //validatedメソッドで入力された情報をとることができるそれを変数に
                $formData = $val->validated();
                //Auth　は ログインログアウト、チェックなど、認証に関してのユーザー情報を処理する内容があらかじめ入っているインスタンス
                //Authインスタンスはstaticメソッド　失敗した場合はfalseが返ってくる　成功の場合はユーザーレコードのID
                $auth = Auth::instance(); //Authインスタンス生成　静的クラス

                //ユーザー登録
                //create_userでDBに接続して自動的にユーザー情報を作ってくれる ユーザー名 パス　email
                if($auth->create_user($formData['username'], $formData['password'], $formData['email'])){
                    // メッセージ格納 Sessionでメッセージを出す setとset_flashがある
                    //set_flashは1回だけセッションを取得 第１にキー　第２にメッセージ
                    Session::set_flash('sucMsg','ユーザー登録が完了しました！');
                    // リダイレクト　コントローラ/アクション(indexは入れても入れなくてもいい)　これでmypgeに飛ぶ
                    Response::redirect('member/mypage');
                }else{
                    // メッセージ格納
                    Session::set_flash('errMsg','ユーザー登録に失敗しました！時間を置いてお試し下さい！');
                }

            //情報をとることができなくなった場合　バリデーションに失敗した場合
            } else {
                // エラー格納　エラーメッセージを取得
                $error = $val->error();
                // メッセージ格納　エラーメッセージを実際に表示
                Session::set_flash('errMsg','ユーザー登録に失敗しました！時間を置いてお試し下さい！');
            }
            // フォームにPOSTされた値をセット　エラーになったとしても前回のものを保持しておける
            $form->repopulate();
        }

        //変数としてビューを割り当てる
        $view = View::forge('template/index');
        $view->set('head',View::forge('template/head'));
        $view->set('header',View::forge('template/header'));
        $view->set('contents',View::forge('auth/signup'));
       
        //ビューの中のビューs
         //buildメソッドでHTMLを生成して、signupform 第３引数は必ずfalseにしてあげる　falseがないと自動でサニタイズされてしまう
        $view->set_global('signupform', $form->build(''), false);
        $view->set_global('error', $error);
        $view->set_global('formData' ,$formData);

        // レンダリングした HTML をリクエストに返す
        return $view;
    }
}

