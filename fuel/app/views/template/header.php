 <header id="header">
     <h1 id="header__title"><?php echo Html::anchor('template/top', 'Athle'); ?></h1>
     <nav id="header__left">
         <ul>
             <li class="menu__list"><?php echo Html::anchor('', 'Videos'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Athletes'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Coaches'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Community'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('members/mypage', 'Mypage'); ?></li>
         </ul>
     </nav>
     <nav id="header__right">
         <ul>
             <!--未ログインなら会員登録 -->
             <?php if (!Auth::check()) { ?>
                 <li class="menu__list"><?php echo Html::anchor('signup', 'Signup'); ?></li>
             <?php } else { ?>
                 <li class="menu__list"><?php echo Html::anchor('members/logout', 'Logout'); ?></li>
             <?php } ?>

             <!-- ログイン -->
             <li class="menu__list"><?php echo Html::anchor('signin', 'Signin'); ?></li>
         </ul>
     </nav>
 </header>