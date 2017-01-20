<?php
	class AccountModel extends ExecuteModel {
		public function getUserRecord($user_id) {
			$sql = "SELECT * FROM user WHERE user_id = :user_id";
			$userData = $this->getRecord($sql,array(':user_id' => $user_id));
			return $userData;
		}
		public function insert($user_id,$user_pw,$user_name,$user_birth,$user_phone,$user_addr,$user_email,$user_gender) {
	    // $password = password_hash($password, PASSWORD_DEFAULT);
	    $now = new DateTime();
	    $sql = "INSERT INTO user VALUES('',:user_id,:user_pw,:user_name,:user_birth,:user_phone,:user_addr,:user_email,:user_gender,:time_stamp)";
	    $this->execute($sql, array(
	      ':user_id' => $user_id,
	      ':user_pw' => $user_pw,
				':user_name' => $user_name,
				':user_birth' => $user_birth,
				':user_phone' => $user_phone,
				':user_addr' => $user_addr,
				':user_email' => $user_email,
				':user_gender' => $user_gender,
	      ':time_stamp' => $now->format('Y-m-d H:i:s')
	    ));
		}
	}
?>
