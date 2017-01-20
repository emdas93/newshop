<?php
class HomeController extends Controller{
  function indexAction(){
    $param['user'] = $this->_session->get('user');
    $index_view = $this->render($param);
    return $index_view;
  }
}
?>
