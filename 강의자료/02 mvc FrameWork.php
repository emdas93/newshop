02-1. Action을 실행하는 컨트롤러 : MVC 에 C에 해당

Controller의 주목적 Action을 실행하는 것
Controller의 종류
1) Front Controller
2) Action Controller :
  APP에 실행되어야 할 여러개의 Action을 정의
  Routing : Request된 URL로부터 적절한 ActionController와
            Action Method를 결정
  Dispatch : Request된 정보를 기반으로 Action Method를 실행
  Action Method : DB처리를 통해 Response로 보낼 화면을 Rendering한다.

* Action Controller의 기본기능 정의하는 클래스
 : 모든 Action Controller의 부모 클래스를 정의
 실행순서
 1> index.php : APP 본체클래스를 인스탄스화 run() 실행
 2> run() 실행
 2-1> Request된 URL을 분석(Routing관련)
 2-2> Controller의 Action명을 획득
 2-3> APP클래스의 getContent()를 실행
 2-3-1> Controller의 서브클래스(Action Controller)를 인스턴스화
 2-3-1-1> Action Controller의 Dispatch()를 실행
 2-3-1-1-1> Action Controller의 내부의 Action Method를 실행
              : 요청된 Content(Rendering된 HTML 데이터 : View의 반환결과)를 획득
 2-3-1-2> Dispatch()의 반환 Response 클래스의 결과처리
 2-3-2> Content가 return
 2-4> Response 클래스에 결과처리
 3> Response 전송

 * 추상클래스 : 객체 생성 불가,
   추상클래스를 정의하면 사용하기위해 반드시 계승 후 사용하여야 한다.
   계승할 때 반드시 구현해야 하는 메소드가 있다면 추상 메소드로 정의한다,

 * Action Method = 한개의 화면을 나타내게 설계
   ex) 회원가입 화면 - 회원가입 Action, 샹품등록 화면 - 상품등록 Action
