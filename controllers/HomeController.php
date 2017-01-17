<?php
class HomeController extends Controller{
  function indexAction(){
    $index_view = $this->render();
    return $index_view;
  }
}
?>
