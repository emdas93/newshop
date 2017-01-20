<?php
class ItemController extends Controller{
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
    $index_view = $this->render($param);
    return $index_view;

  }
}
?>
