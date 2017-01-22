<?php
class ItemModel extends ExecuteModel{
  function itemList($pageNo,$list_per_page, $item_kind){
    $s_point = ($pageNo-1)*$list_per_page;
    $sql = "SELECT * FROM item_board WHERE item_kind = :item_kind ORDER BY item_no DESC LIMIT $s_point,$list_per_page";
    return $this->getAllRecord($sql, array(':item_kind' => $item_kind));
  }

  function getTotalItemList($item_kind){
    $sql = 'SELECT count(*) cnt FROM item_board WHERE item_kind = :item_kind';
    $cnt = $this->getRecord($sql, array(':item_kind' => $item_kind));
    return $cnt;
  }

  function getItem($item_no){
    $sql = "SELECT * FROM item_board WHERE item_no = :item_no";
    return $this->getRecord($sql, array('item_no' => $item_no));
  }
  public function insert($item_name, $item_title, $item_content, $item_titleImg, $item_imgSRC, $item_price, $item_kind, $item_owner) {
    $sql = "INSERT INTO item_board VALUES('',:item_name, :item_title, :item_content, :item_titleImg, :item_imgSRC, :item_price, :item_kind, :item_owner)";
    $this->execute($sql, array(
      ':item_name'      => $item_name,
      ':item_title'     => $item_title,
      ':item_content'   => $item_content,
      ':item_titleImg'  => $item_titleImg,
      ':item_imgSRC'    => $item_imgSRC,
      ':item_price'     => $item_price,
      ':item_kind'      => $item_kind,
      ':item_owner'     => $item_owner
    ));
  }

  public function insertDelivery($item_no, $item_name, $item_price, $item_titleImg, $item_quantity, $user_addr, $user_name, $user_email, $user_phone, $user_id, $d_date) {
    $sql = "INSERT INTO delivery VALUES('',:item_no, :item_name, :item_price, :item_titleImg, :item_quantity, :user_addr, :user_name, :user_email, :user_phone, :user_id, :d_date)";
    $this->execute($sql, array(
      ':item_no'          => $item_no,
      ':item_name'        => $item_name,
      ':item_price'       => $item_price,
      ':item_titleImg'    => $item_titleImg,
      ':item_quantity'    => $item_quantity,
      ':user_addr'        => $user_addr,
      ':user_name'        => $user_name,
      ':user_email'       => $user_email,
      ':user_phone'       => $user_phone,
      ':user_id'          => $user_id,
      ':d_date'           => $d_date
    ));
  }

  function contentUpdate($b_no, $b_title, $b_content, $b_date){ // 미수정
    $sql = "UPDATE qna SET b_title=:b_title, b_content=:b_content, b_date=:b_date WHERE b_no=:b_no ";
    $this->execute($sql, array(
      ':b_title'    => $b_title,
      ':b_content'  => $b_content,
      ':b_date'     => $b_date,
      ':b_no'       => $b_no
    ));
  }

  function getFileDir($b_no){
    $sql = "SELECT b_fileURL FROM qna WHERE b_no = :b_no";
    $fileDir = $this->getRecord($sql, array(':b_no' => $b_no));
    return $fileDir;
  }
  
}
?>
