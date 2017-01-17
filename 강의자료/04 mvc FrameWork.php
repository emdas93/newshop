04-1. 데이타 아쿠세스를 처리하는 Model: MVC의 M
Framework상에서 Model은 메인처리(비지네스로지쿠) = DB처리를 하는 부분
목표 : Framework상에서 코딩 시 DB여부를 의식하지 않고 코딩할 수 있도록 한다.

Model을 나누어 구현 : ConnectionModel(DB 연결관리 Class), ExecuteModel(SQL 실행 Class)

* Controller에서 처리해야하는 것
1> [Request]와 Data입력을 처리
2> Model 호출
3> Model의 결과에 따라 View 생성을 요청
4> View 처리 결과 [Response]로 전달

1) ConnectionModel 클래스 :  1.DB 접속 관리 클래스
                             2.PDO 객체 생성 관리 클래스

2) ExecuteModel : DB 아쿠세스를 처리하는 기본 클래스( 상속 발생 )
