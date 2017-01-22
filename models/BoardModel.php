<?php
class BoardModel extends ExecuteModel{
  function boardList($pageNo,$list_per_page){
    $s_point = ($pageNo-1)*$list_per_page;
    $sql = "SELECT * FROM qna ORDER BY b_no DESC LIMIT $s_point,$list_per_page";
    return $this->getAllRecord($sql);
  }

  function getTotalBoardList(){
    $sql = 'SELECT count(*) cnt FROM qna';
    $cnt = $this->getRecord($sql);
    return $cnt;
  }

  function getContent($b_no){
    $sql = "SELECT * FROM qna WHERE b_no = :b_no";
    return $this->getRecord($sql, array('b_no' => $b_no));
  }
  public function insert($b_title,$b_content,$b_writer,$b_date,$b_viewed,$b_fileURL,$b_owner,$b_update) {
    $sql = "INSERT INTO qna VALUES('',:b_title,:b_content,:b_writer,:b_date,:b_viewed,:b_fileURL,:b_owner,:b_update)";
    $this->execute($sql, array(
      ':b_title'    => $b_title,
      ':b_content'  => $b_content,
      ':b_writer'   => $b_writer,
      ':b_date'     => $b_date,
      ':b_viewed'   => $b_viewed,
      ':b_fileURL'  => $b_fileURL,
      ':b_owner'    => $b_owner,
      ':b_update'   => $b_update
    ));
  }

  function contentUpdate($b_no, $b_title, $b_content, $b_date){
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
