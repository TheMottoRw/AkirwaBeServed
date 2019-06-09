<?php
class Receiver{
	public $conn;
	function __construct(){
		try{
			$this->conn=new PDO("mysql:host=localhost;dbname=akirwa","root","");
			echo "Database connected successfull ";
			$this->isAdminExist([]);

		}catch(PDOException $ex){
			echo "Errors occured ".$ex->getMessage();
		}
	}
	public function isAdminExist($datas){
		$qy=$this->conn->prepare("SELECT * FROM users WHERE category=:cate");
		$qy->execute(array("cate"=>'admin'));
		if($qy->rowCount()==0){
			$qry=$this->conn->prepare("INSERT INTO users SET officename=:office,email=:email,username=:uname,password=:pwd,category=:cate");
		$qry->execute(array("office"=>'Sysowner',"email"=>'carinebagabo@gmail.com',"uname"=>'Carine',"pwd"=>'123@xyz',"cate"=>'admin'));
		if($qry->rowCount()==0){
			echo "Error ".json_encode($qry->errorInfo());
		}
	}
	}
	public function saveUser($datas){
		$qy=$this->conn->prepare("INSERT INTO users SET officename=:office,email=:email,username=:uname,password=:pwd,category=:cate");
		$qy->execute(array("office"=>$datas['officename'],"email"=>$datas['email'],"uname"=>$datas['uname'],"pwd"=>$datas['pwd'],"cate"=>$datas['category']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	public function getUser($datas){
		$qy=$this->conn->prepare("SELECT * FROM user");
		$qy->execute(array("email"=>$datas['email'],"uname"=>$datas['uname'],"pwd"=>$datas['pwd']));
		$ft=$qy->fetchAll(PDO::FETCH_ASSOC);
	}
	public function updateUser($datas){
		$qy=$this->conn->prepare("UPDATE users SET email=:email,username=:uname,password=:pwd WHERE id=:id");
		$qy->execute(array("id"=>$datas['id'],"email"=>$datas['email'],"uname"=>$datas['uname'],"pwd"=>$datas['pwd']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	public function saveAppointment($datas){
		$qy=$this->conn->prepare("INSERT INTO appointments SET leader=:leader,app_daydate=:day,time_from=:timefrom,time_to=:timeto,user_phone=:phone");
		$qy->execute(array("leader"=>$datas['leader'],"day"=>$datas['day'],"timefrom"=>$datas['timefrom'],"timeto"=>$datas['timeto'],"phone"=>$datas['phone']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	public function getAppointments($datas){
		$qy=$this->conn->prepare("SELECT * FROM appointments where id=:id");
		$qy->execute(array("id"=>$datas['id']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	public function saveSchedule($datas){
		$qy=$this->conn->prepare("INSERT INTO schedules SET day_date=:day,time_from=:timefrom,time_to=:timeto,user_id=:userid");
		$qy->execute(array("day"=>$datas['day'],"timefrom"=>$datas['timefrom'],"timeto"=>$datas['timeto'],"userid"=>$datas['userid']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	public function getSchedules($datas){
		$qy=$this->conn->prepare("SELECT * FROM schedules where user_id=:userid");
		$qy->execute(array("iuserd"=>$datas['userid']));
		if($qy->rowCount()==1){
			echo "ok";
		}else{
			echo "fail";
		}
	}
}
$receiver=new Receiver();
// $receiver->saveUser(array("officename"=>"Bushoki","uname"=>"Bushoki","email"=>"bushoki@gov.rw","pwd"=>"Bushoki@Rulindo","category"=>"Sector"));
// $receiver->saveAppointment(array("leader"=>'2',"phone"=>'0723456123',"day"=>"2019-06-09","timefrom"=>"08:00:00","timeto"=>"08:30:00"));
$receiver->saveSchedule(array("userid"=>'2',"day"=>"2019-06-09","timefrom"=>"14:00:00","timeto"=>"16:00:00"));
?>