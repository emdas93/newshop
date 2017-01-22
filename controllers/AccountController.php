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
    $user = $this->_connect_model->get('Account')->getUserRecord($user_id);
    if($user == false){
      $this->redirect('/');
    }
    if($user_id == $user->user_id && $user_pw == $user->user_pw && !($user_id == "" || $user_pw == "")){
      $this->_session->set('user',$user);
      $this->_session->setAuthenticateStaus(true);
      $this->redirect('/');
    }else{
      $this->_session->setAuthenticateStaus(false);
      $this->redirect('/');
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
  function buyListAction(){
    $user_id = $this->_session->get('user')->user_id;
    $list = $this->_connect_model->get('Account')->buyList($user_id);
    $index_view = $this->render(array('list'=>$list));
    return $index_view;
  }
  function userinfoAction(){
    $index_view = $this->render();
    return $index_view;
  }
  function logoutAction(){
    $this->_session->clear();
    $this->redirect('/');
  }
}
?>
