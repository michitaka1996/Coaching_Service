 <header id="header">
     <h1 id="header__title"><?php echo Html::anchor('template/top', 'Athle'); ?></h1>
     <nav id="header__left">
         <ul>
             <li class="menu__list"><?php echo Html::anchor('', 'Shots'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Athletes'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Coaches'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'Community'); ?></li>
             <li class="menu__list"><?php echo Html::anchor('', 'What’s About'); ?></li>
             <!-- <li><a class="menu__list" href="">Athletes</a></li>
             <li><a class="menu__list" href="">Coaches</a></li>
             <li><a class="menu__list" href="">Community</a></li>
             <li><a class="menu__list" href="">What’s About?</a></li> -->
         </ul>
     </nav>
     <nav id="header__right">
         <ul>
             <!--会員登録 -->
             <li class="menu__list"><?php echo Html::anchor('signup', 'Signup'); ?></li>
             <!-- ログイン -->
             <li class="menu__list"><?php echo Html::anchor('signin', 'Signin'); ?></li>
         </ul>
     </nav>
 </header>