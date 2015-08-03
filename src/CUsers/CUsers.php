<?php  
class CUsers extends CDatabase {

	public function showLogin() {
		if (isset($_SESSION['loggedIn'])) {
			return '<br><a href="?logout">Logga ut</a>
							<br><a href="settings.php">Inställningar</a>';
			
		}
		else {
			return '<br><a href="login.php">Logga in</a><br>';
		}
	}
	
	public function loginForm() {
		
			$form = '	<form method="post" action="'.$this->login().'" class="centerThisLogin">
								<table>
									<tr>
										<td>
											<label for="username">Användarnamn:</label>
										</td>
										<td>
											<input type="text" name="username"/>
										</td>
									<tr>
									<tr>
										<td>
											<label for="password">Lösenord:</label>
										</td>
										<td>
											<input type="password" name="password"/><br>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right">
											<input type="submit" name="submit" value="Logga In"/>
										</td>
									</tr>
								</table>
								</form>';
	
		return $form;
	}
	
	public function login() {
		if (isset($_POST['submit'])) {
		
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$sql = 'SELECT * FROM users WHERE username = :username';
			$prepared = $this->db->prepare($sql);
			$prepared->execute(array('username' => $username));
			$userData = $prepared->fetch(PDO::FETCH_ASSOC);
			
			$userPassword = $userData['password'];
			
			if ($password == $userPassword) {
				$_SESSION['loggedIn'] = $username;
				header("location: settings.php");
			}
			else {
				echo "Fel Lösenord eller Användarnamn. Försök igen.";
			}	
		}
	}
	
	public function logout() {
		if (isset($_GET['logout']) && isset($_SESSION['loggedIn'])) {
			session_destroy();
			header("location: hem.php");
			
		}
	}
	
	public function loginProtected() {
		if (!isset($_SESSION['loggedIn'])) {
			die('Logga in om du vill ta del av denna sidan...');
		}
	}
	
	public function createUser() {
		$form = '<form method="post">
							<label for="username">Användarnamn:</label>
							<input type="text" name="username"/>
							<label for="password">Lösenord:</label>
							<input type="text" name="password"/>
							<input type="submit" name="submit"/>
						</form>';
						
		if (isset($_POST['submit'])) {
		
		$username = $_POST['username'];
		$password = $_POST['password'];
						
		$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
		$prepared = $this->db->prepare($sql);
		$prepared->execute(array('username' => $username, 'password' => $password));
		
		}
		
		if (!isset($_GET['user'])) {
			return $form;
		}
	}	
	
	public function generateUserList() {
		
		$userList = $this->db->query('SELECT * FROM users');
		$userInformation = $userList->fetchAll(PDO::FETCH_ASSOC);
		$text = '<a href="edit-users.php"><h2>Skapa Användare</h2></a>
			<table class="regular"><tr>
								<td><b>Användarnummer:</b></td>
								<td><b>Användarnamn</b></td>
								<td><b>Lösenord</b></td>
							</tr>';
		$count = 1;
		
		foreach ($userInformation as $userData) {
			
			$text .= '<tr>
									<td><p>'.$count.'</p></td>
									<td><p>'.$userData['username'].'</p></td>
									<td><p>xxxxx</p></td>
									<td><p><a href="edit-users.php?user='.$userData['id'].'">Editera användare</a></p></td>
									<td><p><a href="?delete='.$userData['id'].'">Ta bort användare</a></p></td>
								</tr>';
			
			$count++;
			
		}
		$text .= '</table>';
		
		return $text;
		
	}
	
	public function deleteUser() {
		if (isset($_GET['delete'])) {
			$userID = $_GET['delete'];
			
			$sql = 'DELETE FROM users WHERE id = :userId';
			$prepared = $this->db->prepare($sql);
			$prepared->execute(array('userId' => $userID));
		}
	}
	
	public function updateUser() {
		
		if(isset($_GET['user'])) {
			$user = $_GET['user'];
			
			if (isset($_POST['submitEdit'])) {
			
				$username = $_POST['username'];
				$password = $_POST['password'];
			
				$sql = 'UPDATE users SET username=?, password=? WHERE id=?';
				$prepared = $this->db->prepare($sql);
				$prepared->execute(array($username, $password, $user));
				
			}
			
			$sql = 'SELECT * FROM users WHERE id = :userID';
			$prepared = $this->db->prepare($sql);
			$prepared->bindParam(':userID', $user, PDO::PARAM_INT);
			$prepared->execute();
			$formData = $prepared->fetch(PDO::FETCH_ASSOC);
		
			$form = '<form method="post">
								<label for="username">Användarnamn:</label>
								<input type="text" name="username" value="'.$formData['username'].'"/>
								<label for="password">Lösenord:</label>
								<input type="text" name="password" value="'.$formData['password'].'"/>
								<input type="submit" name="submitEdit"/>
							</form>';

			return $form;
		
		}
	}
	
	
}