<?php  

class CBlog extends CDatabase {


	public function generateBlogForm() {
		$content = '<form method="post" action="blogsetting.php">
								<table class="regular">
									<tr>
										<td>
											<label for="title">Rubrik</label><br>
											<input type="text" name="title" />
										</td>
										<td>
											<label for="author">Författare</label><br>
											<input type="text" name="author" />
										</td>
										<td>
											<label for="category">Kategori</label><br>
											<input type="text" name="category" placeholder="Viktigt: Ett ord"/>
										<td>
									</tr>
									<tr>
										<td colspan="3">
											<label for="description">Beskrivning</label><br>
											<textarea name="description" style="width:100%; height:150px"></textarea><br>
										<td>
									<tr>
									<tr>
										<td colspan="3">
											<input type="submit" name="submit" value="Skapa Bloggpost"/>
										</td>
									</tr>
								</table>
								</form>';
		return $content;
	}
	
	public function insertFormData() {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$description = $_POST['description'];
		$category = $_POST['category'];
		
		$sql = "INSERT INTO blog (title, author, description, category) VALUES (:title, :author, :description, :category)";
		$prepared = $this->db->prepare($sql);
		$prepared->execute(array('title' => $title, 'author' => $author, 'description' => $description, 'category' => $category));
	
	}
	
	public function showBlog() {
		$results = $this->db->query('SELECT * FROM blog ORDER BY id DESC');
		$result = $this->db->query('SELECT LEFT(description, 40) FROM blog');
		$blogPosts = $results->fetchAll(PDO::FETCH_ASSOC);

		$newLine = '';
		
		foreach ($blogPosts as $blogPost) {
			$newLine .=  '<h2><a href="nyhet.php?p='.$blogPost['id'].'">'.$blogPost['title'].'</a></h2>
									  <h4><i>Av: '.$blogPost['author'].'</i></h4>
									  <p class="descriptions">'.mb_substr($blogPost['description'], 0, 200, "utf-8").' ...<a href="nyhet.php?p='.$blogPost['id'].'"> Läs mer »</a></p>
									  <a href="kategori.php?category='.$blogPost['category'].'" class="centers">Kategori: '.$blogPost['category'].'</a>';
		}
			return $newLine;
	}
	
	public function showPost() {
		if (isset($_GET['p'])) {
			
			$page = $_GET['p'];
			$sql = 'SELECT * FROM blog WHERE id = :page';
			
			$prepare = $this->db->prepare($sql);
			$prepare->bindParam(':page', $page, PDO::PARAM_INT);
			$prepare->execute();
			
			$blogPost = $prepare->fetch(PDO::FETCH_ASSOC);
			
			$thePost = '<h2>'.$blogPost['title'].'</h2>
									<h4><i>Av: '.$blogPost['author'].'</i></h4>
									<p class="descriptions">'.$blogPost['description'].'</p>
									<a href="kategori.php?category='.$blogPost['category'].'" class="centers">Kategori: '.$blogPost['category'].'</a>';
			
			return $thePost;
						
		}
		else {
			echo "There is no post by this name :-(";
		}	
	}
	
	public function showEditMenu() {
		$results = $this->db->query('SELECT * FROM blog ORDER BY id DESC');
		$blogEditMenu = $results->fetchAll(PDO::FETCH_ASSOC);
		$newEditLine = '<a href="blogsetting.php"><h2>Skapa ny Post</h2></a><table class="editBlogMenuForm">';
		
		foreach ($blogEditMenu as $menuItem) {
			$newEditLine .= '<tr class="borderTop">
													<td colspan="2"><h2>' .$menuItem['title']. '</h2></td>
												</tr>
												<tr class="borderBottom">
													 <td align="left"><a href="edit-news.php?edit='.$menuItem['id'].'">Editera denna Post</a></td>
													 <td align="right"><a href="?delete='.$menuItem['id'].'">Ta bort denna Post</a></td>
											 </tr>';
		}
		$newEditLine .= '</table>'; 
		
		return $newEditLine;
	}
	
	public function deletePost() {
		if (isset($_GET['delete'])) {
			$postToDelete = $_GET['delete'];
			
			$sql = 'DELETE FROM blog WHERE id = :postToDelete';
			$prepared = $this->db->prepare($sql);
			$prepared->bindParam(':postToDelete', $postToDelete, PDO::PARAM_INT);
			$prepared->execute();
			
			$page = $_SERVER['PHP_SELF'];
			header("Refresh: 0; url=$page");
			
		}
	}
	
	public function editPost() {
		if (isset($_GET['edit'])) {
			$edit = $_GET['edit'];
			
			$sql = 'SELECT * FROM blog WHERE id = :editID';
			$prepared = $this->db->prepare($sql);
			$prepared->bindParam(':editID', $edit, PDO::PARAM_INT);
			$prepared->execute();
			$data = $prepared->fetchAll(PDO::FETCH_ASSOC);
			$content = '';
			
			foreach ($data as $inputData) {
				$content = '<form method="post" action="'.$_SERVER['PHP_SELF'].'?edit='.$edit.'">
										<table class="regular">
											<tr>
												<td>
													<label for="title">Rubrik</label><br>
													<input type="text" name="title" value="'.$inputData['title'].'"/>
												</td>
												<td>
													<label for="author">Författare</label><br>
													<input type="text" name="author" value="'.$inputData['author'].'"/>
												</td>
												<td>
													<label for="category">Kategori</label><br>
													<input type="text" name="category" value="'.$inputData['category'].'"/>
												<td>
											</tr>
											<tr>
												<td colspan="3">
													<label for="description">Beskrivning</label><br>
													<textarea name="description" style="width:100%; height:150px">'.$inputData['description'].'</textarea><br>
												<td>
											<tr>
											<tr>
												<td colspan="3">
													<input type="submit" name="submitEdit" value="Ändra Bloggpost"/>
												</td>
											</tr>
										</table>
										</form>';
				
			}
						
			return $content;
		
			} 
			
		}
	
	public function updatePost() {
		if (isset($_POST['submitEdit'])) {
			$edit = $_GET['edit'];
			$title = $_POST['title'];
			$author = $_POST['author'];
			$category = $_POST['category'];
			$description = $_POST['description'];
			
			$sql = 'UPDATE blog SET title=?, author=?, category=?, description=? WHERE id=?';
			$prepared = $this->db->prepare($sql);
			$prepared->execute(array($title, $author, $category, $description, $edit));
	}											
}

	public function showBlogForCategory() {
		
		if (isset($_GET['category'])) {
		$category = $_GET['category'];
		
		$sql = 'SELECT * FROM blog WHERE category=? ORDER BY id DESC';
		$prepared = $this->db->prepare($sql);
		$prepared->execute(array($category));
		$blogPosts = $prepared->fetchAll(PDO::FETCH_ASSOC);

		$newLine = '';
		
		foreach ($blogPosts as $blogPost) {
			$newLine .=  '<h2><a href="nyhet.php?p='.$blogPost['id'].'">'.$blogPost['title'].'</a></h2>
									  <h4><i>Av: '.$blogPost['author'].'</i></h4>
									  <p class="descriptions">'.substr($blogPost['description'], 0, 200).'...</p>
									  <a href="kategori.php?category='.$blogPost['category'].'" class="centers">Kategori: '.$blogPost['category'].'</a>';
		}
		
		return $newLine;
	}
	}
	
	public function blogForHomePage() {
	
		$query = $this->db->query('SELECT * FROM blog ORDER BY id DESC LIMIT 3');
		$blogPosts = $query->fetchAll(PDO::FETCH_ASSOC);
		$threePosts = '<div class="container blogForHomePage"><h2>Blogginlägg</h2>';
		
		foreach ($blogPosts as $blogPost) {
			$threePosts .= '<div class="col-md-4">
												<a href="nyhet.php?p='.$blogPost['id'].'">
													<h3>'.$blogPost['title'].'</h3></a>
													<p>'.substr($blogPost['description'], 0, 200).'...</p>
											</div>';
		}
		
		$threePosts .= '</div>';
		
		return $threePosts;
	}


}