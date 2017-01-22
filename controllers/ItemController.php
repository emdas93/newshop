<?php
class ItemController extends Controller{

  public $total_content;    // 총 게시글 수
  public $block_count;      // 생기게 될 블록 갯수 저장
  public $list_count;       // 생기게 될 페이지 갯수 저장
  public $present_page = null;
  const LIST_PER_PAGE = 9;
  const BLOCK_PER_PAGE = 10;
  function init($item_kind){
    $this->total_content = $this->_connect_model->get('Item')->getTotalItemList($item_kind)->cnt;
    $this->list_count = ceil($this->total_content/self::LIST_PER_PAGE);
    $this->block_count = ceil($this->list_count/self::BLOCK_PER_PAGE);
  }
  function indexAction($param){
    switch($param['pagename']){
      case 'food' :
        $param['subTitle'] = "보충식품";
        break;
      case 'machine' :
        $param['subTitle'] = "운동기구";
        break;
      case 'sports' :
        $param['subTitle'] = "스포츠용품";
        break;
    }
      $this->present_page = $param['pageNo'];
      $presentBlock = ceil($this->present_page / self::BLOCK_PER_PAGE);
      $this->init($param['pagename']);
      $list = $this->_connect_model->get('Item')->itemList($this->present_page, self::LIST_PER_PAGE, $param['pagename']);
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
      $index_view = $this->render($param);
      return $index_view;

    }
  }
  function writeViewAction($param){
    $index_view = $this->render($param);
    return $index_view;
  }
  function writeAction($param){
    $item_name = $this->_request->getPost('item_name');
    $item_title = $this->_request->getPost('item_title');
    $item_content = $this->_request->getPost('item_content');
    $item_titleImg = $this->fileUpload('item_titleImg'); // 따로 처리
    $item_imgSRC = $this->multiFileUpload('file');       // 따로 처리
    $item_price = $this->_request->getPost('item_price');
    $item_kind = $this->_request->getPost('item_kind');
    $item_owner = $this->_request->getPost('item_owner');
    $this->_connect_model->get('Item')->insert($item_name, $item_title, $item_content, $item_titleImg, $item_imgSRC, $item_price, $item_kind, $item_owner);
    $this->redirect('/item/index/'.$item_kind.'/1');

  }
  /***********************************************************************************************************************************/
    function fileUpload($file){
      $fileDir = "public/files/titleImg/";
      $fileURL = "";
      $file = $this->_request->getFile($file);
      $count = count($file["name"]);
      $fileName = $fileDir.date("ymdmiss").$file["name"];
      move_uploaded_file($file['tmp_name'],$fileName);
      $fileURL = $fileName;
      return $fileURL;
    }
    function multiFileUpload($file){
      $fileDir = "public/files/itemImg/";
      $fileURL = "";
      $file = $this->_request->getFile($file);
      $count = count($file["name"]);
      for($i=0;$i<$count;++$i){
        $fileName = $fileDir.date("ymdmiss").$file["name"][$i];
        move_uploaded_file($file['tmp_name'][$i],$fileName);
        $fileURL .= $fileName;
        if($i<$count-1) $fileURL .="::";
      }
      return $fileURL;
    }
    /***********************************************************************************************************************************/
  function viewAction($param){
    $row = $this->_connect_model->get('Item')->getItem($param['itemNo']);
    $param['row'] = $row;
    $param['imgSRC'] = explode('::', $row->item_imgSRC);
    $index_view = $this->render($param);
    return $index_view;
  }
  function buyViewAction($param){
    $row = $this->_connect_model->get('Item')->getItem($param['itemNo']);
    $param['row'] = $row;
    $index_view = $this->render($param);
    return $index_view;
  }
  function buyAction($param){
    $item_no          = $this->_request->getPost('item_no');
    $item_kind        = $this->_connect_model->get('Item')->getItem($item_no)->item_kind;
    $item_name        = $this->_request->getPost('item_name');
    $item_price       = $this->_request->getPost('item_price');
    $item_titleImg    = $this->_request->getPost('item_titleImg');
    $item_quantity    = $this->_request->getPost('item_quantity'); // 따로 처리
    $user_addr        = $this->_request->getPost('user_addr');       // 따로 처리
    $user_name        = $this->_request->getPost('user_name');
    $user_email       = $this->_request->getPost('user_email');
    $user_phone       = $this->_request->getPost('user_phone');
    $user_id          = $this->_request->getPost('user_id');
    $d_date           = Date('y-m-d m:i:s');
    $this->_connect_model->get('Item')->insertDelivery($item_no, $item_name, $item_price, $item_titleImg, $item_quantity, $user_addr, $user_name, $user_email, $user_phone, $user_id, $d_date);
    $this->redirect('/item/index/'.$item_kind.'/1');
  }
}
?>
