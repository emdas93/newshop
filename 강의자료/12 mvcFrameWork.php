12. mvc FrameWork의 동작
* Front Controller에서 Action이 실행되어 HTML이 출력되기까지 과정
1> Client(browser)에서 URL 접근
2> Front Controller(index.php) 실행
3> APP객체 생성(AppBase계승한 BlogApp)
  4> App객체의 생성자에서 처리
    - Error표시 여부 처리
    - initialized
      - Router, Request, Response, Session, ConnectionModel, Router 객체생성
      - Router객체 생성 시 routeConverter()실행 <Routing 정의에 대한 처리>
    - doDBConnection()실행 <DB서버 접속 처리 : PDO객체생성처리>
  5> App객체에서 run()실행
    6> Router의 getRouteParams()실행
      - Routing 정의에 대해 Request URL에서 잘라낸 경로정보를 패턴매칭시켜
        Routing정의에서 경로정보, Controller명, Action명 알아냄
    7> AppBase에 정의되어있는 getContent()실행
       getContent(Controller명, Action명, Routing정의에서 경로정보)
       - Controller명을 활용해서 Controller객체를 생성
         : AppBase의 getControllerObject()를 이용
       8> 생성된 Controller객체를 이용 dispatch()실행
          dispatch(Action명, Routing정의에서 경로정보) * Routing경로정보를 계속 참조하는 이유 : 게시글 번호, 상품번호 등 이용
          - Action명을 이용해서 Action메소드를 알아내고 Action메소드 실행
       9> Action 메소드의 실행
         10> 생성된 Controller객체의 render()실행
           - View클래스 객체 생성(View파일의 경로, Default정보)
           - View클래스 render()실행
             render(Controller명 / Action명, Action메소드에서 전달된 Token, Layout파일명)
             :  HTML이 출력된다.
    11> HTML 정보를 Response의 $_content에 설정
    12> Response의 send()실행
        : http의 Header + Body(HTML 컨텐츠)

* URL 예제
  - http://weblog.localhost/index_error.php/account/signup
    base URL : index_error.php
    path : /account/signup
  - http://weblog.localhost/account/signup
    base URL : index.php
    path : /account/signup
