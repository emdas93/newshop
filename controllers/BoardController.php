<?php
class BoardController extends Controller{

  public $total_content;    // 총 게시글 수
  public $block_count;      // 생기게 될 블록 갯수 저장
  public $list_count;       // 생기게 될 페이지 갯수 저장
  public $present_page = null;
  const LIST_PER_PAGE = 10;
  const BLOCK_PER_PAGE = 10;
  function init(){
    $this->total_content = $this->_connect_model->get('Board')->getTotalBoardList()->cnt;
    $this->list_count = ceil($this->total_content/self::LIST_PER_PAGE);
    $this->block_count = ceil($this->list_count/self::BLOCK_PER_PAGE);
  }

  function indexAction($param){
    $this->present_page = $param['pageNo'];
    $presentBlock = ceil($this->present_page / self::BLOCK_PER_PAGE);
    $this->init();
    $list = $this->_connect_model->get('Board')->boardList($this->present_page, self::LIST_PER_PAGE);
    $param['list'] = $list;
    $param['total_content']   = $this->total_content;
    $param['block_count']     = $this->block_count;
    $param['list_count']      = $this->list_count;
    $param['list_per_page']   = self::LIST_PER_PAGE;
    $param['list_per_block']  = self::BLOCK_PER_PAGE;
    $param['startPage']       = ceil(($presentBlock-1)*self::LIST_PER_PAGE)+1;
    $param['endPage']         = $param['startPage']+self::LIST_PER_PAGE;
    if($param['endPage'] > $this->list_count){
      $param['endPage']  = $this->list_count+1;
    }
    $index_view = $this->render($param);
    return $index_view;
  }
  function viewAction($param){
    $param['row'] = $this->_connect_model->get('Board')->getContent($param['pageNo']);
    $view = $this->render($param);
    return $view;
  }
  function writeViewAction(){
    $param['user'] = $this->_session->get('user');
    if($param['user'] == null) $this->render('/');
    $index_view = $this->render($param);
    return $index_view;
  }
  function writeAction(){
    $b_title        = $this->_request->getPost('b_title');
    $b_content      = $this->_request->getPost('b_content');
    $b_writer       = $this->_request->getPost('b_writer');
    $b_date         = $this->_request->getPost('b_date');
    $b_fileURL      = $this->_request->getPost('FILE');
    $b_owner        = $this->_session->get('user')->user_id;
    $this->_connect_model->get('Board')->insert($b_title,$b_content,$b_writer,$b_date,0,$b_fileURL,$b_owner,0);
    $this->redirect('/board/index/1');
  }
  function updateViewAction($param){
    $pageNo = $param['pageNo'];
    $row = $this->_connect_model->get("Board")->getContent($pageNo);
    $param['row'] = $row;
    $index_view = $this->render($param);
    return $index_view;
  }
  function updateAction($param){
    $b_title = $this->_request->getPost("b_title");
    $b_date = $this->_request->getPost("b_date");
    $b_content = $this->_request->getPost("b_content");
    $this->_connect_model->get("Board")->contentUpdate($param['pageNo'],$b_title, $b_content, $b_date);
    $this->redirect('/board/index/1');
  }
  function isLogin(){
    $user = $this->_session->get("user");
    
  }
}
?>
