<?php
class AccountController extends Controller{
  function loginViewAction(){
    $index_view = $this->render();
    return $index_view;
  }
  function loginAction(){
    if(!$this->_request->isPost()){
      $this->httpNotFound();
    }
    $user_id = $this->_request->getpost('user_id');
    $user_pw = $this->_request->getPost('user_pw');

    $sql = "SELECT user_id,user_pw FROM user WHERE user_id=:user_id and user_pw=:user_pw";

    $user = $this->_connect_model->get('Account')->getUserRecord($user_id);

    if($user_id == $user->user_id && $user_pw == $user->user_pw){
      $this->_session->set('user',$user);
      $this->redirect('/');
    }else{
      $this->_session->set('user',null);
    }
  }
  function registerViewAction(){
    $index_view = $this->render();
    return $index_view;
  }
  function registerAction(){
    $user_id        = $this->_request->getPost('user_id');
    $user_pw        = $this->_request->getPost('user_pw');
    $user_name      = $this->_request->getPost('user_name');
    $user_birth     = $this->_request->getPost('user_birth');
    $user_phone     = $this->_request->getPost('user_phone');
    $user_addr      = $this->_request->getPost('user_addr');
    $user_email     = $this->_request->getPost('user_email');
    $user_gender    = $this->_request->getPost('user_gender');
    $this->_connect_model->get('Account')->insert($user_id,$user_pw,$user_name,$user_birth,$user_phone,$user_addr,$user_email,$user_gender);
    $this->redirect('/');

  }
  function idChk($arg){
    $sql = "SELECT user_id FROM user WHERE user_id={$arg['id']}";
    $user_id = $this->_connect_model->get("Account")->getRecord($sql);

    if($idChk->count >= 1){
        return "1";
    }else{
        return "0";
    }

  }
  function buyedAction(){

  }
  function userinfoAction(){

  }
  function logoutAction(){
    $this->_session->clear();
    $this->redirect('/');
  }
}
?>
