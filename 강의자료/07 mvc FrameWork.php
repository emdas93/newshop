07. Routing을 하는 Router 클래스
모든 Request는 Front Controller에게 전달
Routing : Request URL로부터 ActionController와 Action명을 구해내는 것

* MVC에서 URL을 다루는 방법들 : Directory 변조
                              MVC에서 Web페이지 != php파일
통상적인 GET방법>
  http://www.example.com/bbs.php?mode=browse&page=2
방법 1>
  http://www.example.com/bbs/browse?page=2
  Controller : bbs, action : browse, 파라메타 : page=2
방법 2> ? or &를 없애자
  http://www.example.com/bbs/browse/page/2
  도메인명/키1/값1/키2/값2....
  다양한 프레임워크에서 채택하고있는 방법(유사)
방법 3> 사용자에 따라 다르게 존재할 수 있다

* Routing 정보의 정의 : AppBase클래스의 서브클래스의 getRouteDefinition()에서 처리

* 디버깅 코드 실행
var_dump(getRouteDefinition());
'/' => array('controller' => 'blog', 'action' => 'index')
[/] => Array(
  [controller]  => blog    :blogController,
  [action]      => index   :indexAction()
);
