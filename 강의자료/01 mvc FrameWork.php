1. mvc frame work 작성
  1) フレームワーク의 개념
  Framework : Web 어플이 사용하는 기본 기능을 정리해 둔 것
  어플 : application
  기본기능
  중복적이고 반복적인 기능
  사용자로부터의 Request처리
  DB처리
  결과페이지 송신 : Response
  Framework : 웹 서비스 제공하는 어플리케이션의 개발시 필요
  기본적인 처리에 대한 것들을 클래스로 정의해서 제공해 주는 것
  프로그래머는 Framework제공의 클래스들을 상속(계승)하여 Method Override해 개발
  프로그래머가 자기가 작성하고자 하는 서비스에 집중할 수 있도록 해줌.
  오버라이도된 메소드는 자동으로 호출됨( 다형성 )

  협업 가능 : 통일성있는 코딩

  2) MVC Framework
  (1) M : Model(モデル) : Data Access담당 ( Main 처리 )
  DB관련, Business Logic  : ビジネスロジック
  (2) V : View(뷰 -) : 처리의 결과 - HTML5(HTML + CSS + JS)
  (3) C : controller(コントローラー)
  Request 정보를 이용하여 Model에 처리를 의뢰
  의뢰결과가 리턴되어 오면 view에 화면생성 의뢰
  의뢰결과가 리턴되면 Response함
    [클라이언트가 프론트 콘트롤러에 요청 -
    어플리케이션 실행 - 컨트롤러 실행 -
    컨트롤러가 모델에 데이터 요청 -
    모델은 요청 데이터를 뷰에 보냄 -
    뷰는 html를 붙여 컨트롤러에 보냄 -
    컨트롤러는 return 정보를 클라이언트에게 보내줌]

    객체지향 MVC의 Controller
    Action(アクション)　어떤 처리를 하는 것
    사용자의 Request에 대한 하나의 Action 정의
    (1) DB에 대한 처리 요청 : Model 실행
    (2) 1번의 처리 결과에 대해 화면 생성을 View에 요청

    * OOAction() 메소드가해당 Request만큼 존재
    ex->rightAction()l
   B 객체지향 MVC의 모델
   Application 의 독자적인 기능(ビジネスロジック)을 위한 DB처리
   C 객체지향 MVC의 view : 화면, UI

   * MVC의 장점
   (1) Request에서 사용되는 URL의 변경
   (2) 뷰를 수정 => Model
   (3) 비지내스 로짓쿠의 변경 => 뷰, Controller 수정 없음

   * 최신 MVC Framework : Front Controller 를 가지고 있음
   Front Controller: 모든 처리의 기점, 모든 Request 수용
   Request에 대해서 TURL  (URL 정보를 이용해서 )
   Front Controller VS Action Controller( mvc의
   * Routing(루-팅구) : 실행해야하는 컨트롤러와 아쿠숀를 결정
   ex) Request URL => http://www.example.com/account
   => 처리 컨트롤러(Action Controller) :
    AccountController
    indexAction()

    * Application Class
    (1) 루-팅구를 실행 : 실행해야 하는 컨트롤러와 Action 결정
    (2) 컨트롤러의 인스턴스화, 액션메소드 실행
    (2-1) Model 실행
    (2-2) View 실행
    (2-3) Response

    <<< Request ~~~~ Response 처리 흐름 >>>
    (1) 리퀘에스토
    (2) 후로토콘토로-라-(아푸리케-숀 클래스의 오부제쿠토를 생성)
    (3) 아푸리케-숀 클래스의 오부제쿠토
        (Response, Request, Session,
         Router(루-타-), BaseModel 등의 오부제쿠토 생성
         Routing
         Controller & Action 결정
         Controller Object를 생성)
    (4) Action Controller
        (Action 실행
         모델의 객체 생성 => DB처리
         뷰의 객체 생성 => 화면생성
         화면을 Application 전달)
    (5) Application Class의 객체
        레스폰스 오부제쿠토의 메소드를 호출해서 전달받은
        화면을 Client로 송신(Send)
    (6) Response

    <<< 환경 설정 >>>
    1) virtual Host 설정
    httpd-vhosts.conf 파일을 수정
    (xampp설치폴더\apache\conf\extra\ 폴더내부)

    수정내용>>>
    NameVirtualHost *:80
    <VirtualHost *:80>
       DocumentRoot "C:\xampp\htdocs"
       Servername localhost
    </VirtualHost>
    <VirtualHost *:80>
       DocumentRoot "C:\xampp\htdocs\weblog.localhost\mvc_htdocs"
       Servername weblog.localhost
       DirectoryIndex index.php index.html
    </VirtualHost>

    2) host파일 설정
    C:\Windows\System32\drivers\etc\host
    127.0.0.1 weblog.localhost 추가

    3) mvc_htdocs 내의 htaccess 파일설정
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteRule ^(.*)$ index.php[QSA,L]
    </IfModule>

    <<< 파일 작성 >>>
    1) Front Controller : index.php
    2) BootStrap : bootstrap.php
    3) Class Loader : Loader.php

    파일 상호관계
    1) Client Request
    2) Front Controller의 실행
      - Bootstrap 실행
      - Class Loading
    3) application 실행

    Class Loader작성
    <?php

      class Loader {
        protected $_directories = array();
        // autoLoad 대상 Directory를 저장하는 property

        public function regDirectory($dir){
          $this->_directories[] = $dir;
          // array_push($$this->_directories,$dir);
          // http://php.net/manual/kr/function.array-push.php
        }

        public function register(){
          spl_autoload_register(array($this,'requireClsFile'));
          //http://php.net/manual/kr/function.spl.autoload-register.php
        }

        public function requireClsFile($class){
          foreach ($this->_directories as $dir){
            $file = $dir . '/' . $class . '.php';
            if(is_readable($file)){
              //http://php.net/manual/kr/function.is-readable.php
              require $file;
              return;
            }
          }
        }
      }
    ?>

    bootstrap.php 작성
    <?php
      require 'mvc/Loader.php';
      $loader = new Loader();
      $loader->regDirectory(dirname(__FILE__), '/mvc');
      $loader->regDirectory(dirname(__FILE__), '/models');
      // __FILE__ : 현재 파일의 directory 를 저장 하고있는 정수
      // dirname() : 지정한 파일 경로의 부모 directory의 경로를 ㅏㅂㄴ환
      // http://php.net/manual/kr/function.dirname.php
      $loader->register();
    ?>

    front controller 작성
    <?php
      require '../bootstrap.php';
      require '../BlogApp.php';

      $app = new BlogApp(false);
        // error 출력 여부 (true 표시, false 미표시)
      $app->run();
    ?>
