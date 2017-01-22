<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/master.css">
    <script src="<?php echo URL; ?>public/js/jQuery.js"></script>
    <script src="<?php echo URL; ?>public/js/master.js"></script>
    <script src="<?php echo URL; ?>public/js/config.js"></script>
    <title>SHOP</title>
  </head>
  <body>
    <div class="wrap">
      <header>
        <div class="loginDiv">
          <?php if($session->isAuthenticated()){ ?>
              <span><?php echo $session->get("user")->user_name; ?>님 환영합니다. </span>
              <span><a href="<?php echo URL?>account/logout">로그아웃</a></span>
              <span><a href="<?php echo URL?>account/userinfo">정보보기</a></span>
          <?php }else{ ?>
              <span><a href="<?php echo URL?>account/loginView">로그인</a></span>
              <span><a href="<?php echo URL?>account/registerView">회원가입</a></span>
          <?php } ?>
        </div>
        <div class="titleDiv">
            <a href="<?php echo URL ?>"><img src="<?php echo URL; ?>public/img/title.png" alt=""></a>
        </div>
        <div class="navDiv">
          <nav>
            <span><a href="<?php echo URL?>item/index/food/1">보충식품</a></span>
            <span><a href="<?php echo URL?>item/index/machine/1">운동기구</a></span>
            <span><a href="<?php echo URL?>item/index/sports/1">스포츠용품</a></span>
            <span><a href="<?php echo URL?>board/index/1">Q&amp;A</a></span>
            <span><a href="<?php echo URL?>item/writeView">제품등록</a></span>
          </nav>
        </div>
      </header>
      <div>
        <section>
          <div>

<div id="main">
    <?php print $_content; ?>
  </div>
  </section>
  <div class="footer_DIV">
  <footer>

  </footer>
  </div>
  </div>
  </div>
  </body>
  </html>
