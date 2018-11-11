<?php
/**
*
* Class User
* @attributes : mail,password,[id,[first,[last,[phone,[rank]]]]]
*
*
*/
class User
{
	private $_id, $_first, $_last, $_phone, $_mail, $_password, $_rank;

	function __construct($mail,$password,$id='',$first='',$last='',$phone='',$rank=1)
	{
		$this->setMail($mail);
		$this->setPass($password);
		$this->setId($id);
		$this->setFirst($first);
		$this->setLast($last);
		$this->setPhone($phone);
		$this->setRank($rank);
	}

	// Accesseurs/Mutateurs
	public function getId(){
		return $this->_id;
	}

	public function getFirst(){
		return $this->_first;
	}

	public function getLast(){
		return $this->_last;
	}

	public function getPhone(){
		return $this->_phone;
	}

	public function getMail(){
		return $this->_mail;
	}

	private function getPass(){
		return $this->_password;
	}
	private function getRank(){
		return $this->_rank;
	}

	public function setId($id){
		$this->_id = $id;
	}

	public function setFirst($first){
		$this->_first = $first;
	}

	public function setLast($last){
		$this->_last = $last;
	}

	public function setPhone($phone){
		$this->_phone = $phone;
	}

	public function setMail($mail){
		$this->_mail = $mail;
	}

	public function setPass($pass){
		$this->_password = $pass;
	}
	public function setRank($rank){
		$this->_rank = $rank;
	}

	//Methods

	// Class method to authenticate a user when sign-in.
	public function authenticate($bdd){
		// We check if we have any errors generated during a previous attempt and unset those error if necessary.
		if (isset($_SESSION['errors']['user_LogError']) && !empty($_SESSION['errors']['user_LogError'])){
			unset($_SESSION['errors']['user_LogError']);
		}

		// We select into the database all entries which match with the email that user has entered.
		$auth = $bdd->prepare("SELECT * FROM `users` WHERE `users_email` = :mail");
		$auth->bindValue(':mail', $this->getMail());
		$exec = $auth->execute();

		// If our query sends an error (code 400), we throw a custom exception.
		if (!$exec)
			throw new CustomException("An error occured, please check your query in User.php -> authenticate()");

		// We count our results.
		$result = $auth->rowCount();

		// If we have only one result, we try to create a session else we redirect to the login page.
		if ($result == 1) {
			
			$user = $auth->fetch();

			// We check if the password that user has entered match with which is into the database.
			$verifPassword = password_verify($this->getPass(), $user['users_pwd']);
			// If it's true, we create the session. Otherwise, we redirect the user to the login page.
			if($verifPassword){
				$_SESSION['user']['ID'] = $user['users_id'];
				$_SESSION['user']['MAIL'] = $user['users_email'];
				$_SESSION['user']['FIRST'] = $user['users_first'];
				$_SESSION['user']['LAST'] = $user['users_last'];
				$_SESSION['user']['PHONE'] = $user['users_phone'];
				$_SESSION['user']['RANK'] = $user['users_rank'];
				$_SESSION['user']['PASS'] = $user['users_pwd'];
				$_SESSION['user']['CONNECT'] = Date("Y-m-d-H-i-s");
				$file = '../logs/connections.txt';
				$newLine = "\nConnexion : ".$_SESSION['user']['CONNECT']." - ".$_SESSION['user']['ID']." ".$_SESSION['user']['MAIL']." Statut : OK ";
				file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX);
				// file put content: utilisé à la place de file open, file write et file close
				header('Location: index.php');
			} else {
				$_SESSION['errors']['user_LogError'] = 'Nom d\'utilisateur ou mot de passe incorrect';
				header('Location: login-register.php');

			}

			
		} else {
			$_SESSION['errors']['user_LogError'] = 'Nom d\'utilisateur ou mot de passe incorrect';
			header('Location: login-register.php'); 
		}
	}

	// Class method to check if a user exist or not.
	public function exist($bdd){
		if (isset($_SESSION['errors']['user_exist']) && !empty($_SESSION['errors']['user_exist'])){
			unset($_SESSION['errors']['user_exist']);
		}
		$auth = $bdd->prepare("SELECT * FROM `users` WHERE `users_email` = :mail");
		$auth->bindValue(':mail', $this->getMail()); // We use bindVlue() instead of bindParam() cause we use an object method, which throws an exception with the second function.
		
		$exec = $auth->execute();

		if (!$exec)
			throw new CustomException("An error occured, please check your query in User.php -> exist()");
		$result = $auth->rowCount();

		if($result > 0){

			return true;
		} else {

			return false;

		}


	}

	static function delete($bdd, $id){
		$delUser = $bdd->prepare('DELETE FROM `users` WHERE users_id = ?');
		$deleteUser = $delUser->execute(array($id));
	}

	public function add($bdd){

		$addUser = $bdd->prepare('INSERT INTO `users`(`users_first`, `users_last`, `users_phone`, `users_email`, `users_pwd`, `users_rank`) VALUES (:first,:last,:phone, :email,:pass,:rank)');
		$addUser->bindValue(':first', $this->getFirst(), PDO::PARAM_STR);
		$addUser->bindValue(':last', $this->getLast(), PDO::PARAM_STR);
		$addUser->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
		$addUser->bindValue(':email', $this->getMail(), PDO::PARAM_STR);
		$addUser->bindValue(':pass', $this->getPass(), PDO::PARAM_STR);
		$addUser->bindValue(':rank', $this->getRank(), PDO::PARAM_INT);

		
 		$exec = $addUser->execute();

		//DEBUG request
   		echo "<pre>";
 		$addUser->debugDumpParams();
 		echo "</pre>";



		/*if(!$exec){

			throw new CustomException("An error occured, please check your query in User.php -> add()");
		} */
	}

	public function update($bdd){

		$updateUser = $bdd->prepare("UPDATE `users`SET `users_first`= :first, `users_last`= :last, `users_phone`=:phone, `users_email`=:email, `users_rank` = :rank WHERE `users_id` = :id");
		$updateUser->bindValue(':first', $this->getFirst(), PDO::PARAM_STR);
		$updateUser->bindValue(':last', $this->getLast(), PDO::PARAM_STR);
		$updateUser->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
		$updateUser->bindValue(':email', $this->getMail(), PDO::PARAM_STR);
		$updateUser->bindValue(':rank', $this->getRank(), PDO::PARAM_INT);
		$updateUser->bindValue(':id', $this->getId(), PDO::PARAM_INT);

		$exec = $updateUser->execute();

		/*DEBUG request
   		echo "<pre>";
 		$updateUser->debugDumpParams();
 		echo "</pre>";*/

		
		if(!$exec){

			throw new CustomException("An error occured, please check your query in User.php -> update()");
		} 
	}

	public function resync($bdd){
		
		$auth = $bdd->prepare("SELECT * FROM `users` WHERE `users_email` = :mail");
		$auth->bindValue(':mail', $this->getMail());
		$exec = $auth->execute();

		//Si la query renvoie une erreur, on lève une exception
		if (!$exec)
			throw new CustomException("An error occured with bdd, please check your query in User.php -> resync()");

		$result = $auth->rowCount();
		if ($result == 1) {
			// Creating session
			$user = $auth->fetch();

			if($user){
				$_SESSION['user']['ID'] = $user['users_id'];
				$_SESSION['user']['MAIL'] = $user['users_email'];
				$_SESSION['user']['FIRST'] = $user['users_first'];
				$_SESSION['user']['LAST'] = $user['users_last'];
				$_SESSION['user']['PHONE'] = $user['users_phone'];
				

			} 
		} 
	}

	static function listUser($bdd){		

		$statement = $bdd->query('SELECT * FROM users');
		while($item = $statement->fetch()){
			echo '<tr>';
			echo '<td>' . $item['users_last']. '</td>';
			echo '<td>' . $item['users_first']. '</td>';
			echo '<td>' . $item['users_email']. '</td>';
			echo '<td>' . $item['users_phone']. '</td>';
			echo '<td>' . $item['users_rank']. '</td>';
			echo '<td width=320>';
			echo ' ';
			echo '<a class="btn btn-primary id="update" href="updateUser.php?id=' . $item['users_id'] . '"><i class="fas fa-pencil-alt"></i> Modifier</a>';
			echo ' ';
			echo '<a class="btn btn-danger" id="delete" href="deleteUser.php?id=' . $item['users_id'] . '"><i class="fas fa-trash-alt"> Supprimer</a>';
			echo '</td>';
			echo '</tr>';
		}
	}

	static function getUser($bdd,$id){

		$getUser = $bdd->prepare("SELECT * FROM `users` WHERE `users_id` = ?");
		$getUser->execute(array($id));
		$infoUser = $getUser->fetch();
		//echo "<pre>";
        //$getUser->debugDumpParams();
       // echo "class <br />";
        //var_dump($infoUser);
        //echo "</pre>";
		return $infoUser;
	}
}