<?php
class BlogApp extends AppBase {

  protected $_signinAction = array('account', 'signin');

  //DB접속 실행
  protected function doDbConnection() {
    $a = $this->_connectModel->connect('master', //접속이름
    array(
      'string'    => 'mysql:dbname=emdas;host=localhost;charset=utf8',  //DB이름 - weblog
      'user'      => 'root',                                            //DB사용자명
      'password'  => 'qweqwe12'                                             //DB사용자의 패스워드
    ));
    echo("<script>alert {$a};</script>");
  }//doDbConnection - function

  //Root Directory 경로를 반환
  public function getRootDirectory() {
    return dirname(__FILE__); //BlogApp.php가 저장되어 있는 디렉토리 or 호출 디렉토리
    //http://php.net/menual/en/function.dirname.php
  }//getRootDirectory - function

  //Blog APP에서 사용되는 Controller, Action
  //Contorller  - action    - path정보                    - 내용
  //1)account   - index     - /account                    - 계정 정보의 톱페이지
  //2)account   - signin    - /account/:action            - 로그인
  //3)account   - signout   - /account/:action            - 로그아웃
  //4)account   - signup    - /account/:action            - 계정등록
  //5)account   - follow    - /follow                     - 계정등록(회원가입)
  //6)blog      - index     - /                           - 블로그의 톱페이지
  //7)blog      - post      - /status/post                - 글작성
  //8)blog      - user      - /user/:user_name            - 사용자 작성글 일람
  //9)blog      - specific  - /user/:user_name/status/:id - 작성글의 상세보기

  // 1)  home    - index       - /
  // 2)  account - index       - /account
  // 3)  account - buyed       - /account/:action
  // 4)  account - login       - /account/:action
  // 5)  account - register    - /account/:action
  // 6)  account - userinfo    - /account/:action

  // 7)  board   - index       - /board
  // 8)  board   - update      - /board/:action
  // 9)  board   - view        - /board/:action
  // 10) board   - write       - /board/:action

  // 11) item    - index       - /item
  // 12) item    - view        - /item/:action
  // 13) item    - buyView     - /item/:action
  // 14) item    - write       - /item/:action

  //Routiong 정의를 반환
  protected function getRouteDefinition() {
    return array(

      // HomeController 클래스 관련 Routing
      '/'                           => array('controller' => 'home', 'action' => 'index'),

      // AccountController 클래스 관련 Routing

      '/account'                    => array('controller' => 'account', 'action' => 'index'),
      '/account/:action'            => array('controller' => 'account', 'action' => 'buyed'),
      '/account/:action'            => array('controller' => 'account', 'action' => 'login'),
      '/account/:action'            => array('controller' => 'account', 'action' => 'register'),
      '/account/:action'            => array('controller' => 'account', 'action' => 'userinfo'),
      '/account/:action'            => array('controller' => 'account', 'action' => 'logout'),

      // BoardController 클래스 관련 Routing
      '/board'                      => array('controller' => 'board', 'action' => 'index'),
      '/board/:action'              => array('controller' => 'board', 'action' => 'update'),
      '/board/:action'              => array('controller' => 'board', 'action' => 'view'),
      '/board/:action'              => array('controller' => 'board', 'action' => 'write'),

      // ItemController 클래스 관련 Routing
      '/item'                      => array('controller' => 'item', 'action' => 'index'),
      '/item/:action'              => array('controller' => 'item', 'action' => 'view'),
      '/item/:action'              => array('controller' => 'item', 'action' => 'buyView'),
      '/item/:action'              => array('controller' => 'item', 'action' => 'write')

    );

  }//getRouteDefinition - function
  //var_dump(getRouteDefinition()); 디버깅 코드

}//BlogApp -class

 ?>
