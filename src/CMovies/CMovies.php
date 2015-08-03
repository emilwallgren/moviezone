<?php  

class CMovies extends CDatabase {

	public function generateMovieForm() {
		
		$form = '<form method="post" action="'.$this->insertFormData().'" enctype="multipart/form-data">
							<table id="movieCreation">
								<tr>
									<td colspan="4">
										<label for="title">Titel:</label><br>
										<input type="text" name="title" style="width:100%;"/><br>
									</td>
									<td colspan="4">
										<label for="trailerlink">Trailerlänk:</label><br>
										<input type="text" name="trailerlink" style="width:100%;"/><br>
									</td>
									<td colspan="4">
										<label for="IMDBlink">IMDB-länk:</label><br>
										<input type="text" name="IMDBlink" style="width:100%;"/><br>
									</td>
								</tr>
								<tr>
									<td colspan="12">
										<label for="kategori">Kategori(er):</label><br>
										<p>OBS: Välj mellan Action, Äventyr, Thriller, Romantik, Komedi eller Drama. Att kombinera går också bra!</p>
										<input type="text" name="kategori" style="width:100%;"><br>
									</td>
								</tr>
								<tr>
									<td colspan="12">
										<label for="description">Beskrivning:</label><br>
										<textarea name="description" style="width:100%; height:150px;"></textarea><br>
										<hr>
										<p>Här måste du välja 4 bilder. Huvudbild är bilden som visas i filmlistan. De 4 bilderna får inte ha samma filnamn och får bara användas en gång per bild.</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label for="imageUpload">Huvudbild:</label><br>
										<input type="file" name="imageUpload" id="imageUpload"><br>
									</td>
									<td colspan="3">
										<label for="bildEtt">Extrabild Ett:</label><br>
										<input type="file" name="bildEtt" id="imageUpload"><br>
									</td>
									<td colspan="3">
										<label for="bildTva">Extrabild Två:</label><br>
										<input type="file" name="bildTva" id="imageUpload"><br>
									</td>
									<td colspan="3">
										<label for="bildTre">Extrabild Tre:</label><br>
										<input type="file" name="bildTre" id="imageUpload"><br>
									</td>
								</tr>
								<tr>
									<td>
										<input type="submit" name="submit" value="Skapa Film"/>
									</td>
								</tr>
							</table>
						</form>';
							
		return $form;
		
	}
	
	public function insertFormData() {
		if (isset($_POST['submit'])) {
			
		$title = $_POST['title'];
		$category = $_POST['kategori'];
		$description = $_POST['description'];
		$trailerLink = $_POST['trailerlink'];
		$imdbLink = $_POST['IMDBlink'];
		$imageUpload = $_FILES['imageUpload']['name'];
		$bildEtt = $_FILES['bildEtt']['name'];
		$bildTva = $_FILES['bildTva']['name'];
		$bildTre = $_FILES['bildTre']['name'];
		
		$sql = "INSERT INTO filmer (title, category, description, trailerlink, IMDBlink, imageName, imageOne, imageTwo, imageThree, dateTime) VALUES (:title, :category, :description, :trailerlink, :IMDBlink, :imageUpload, :bildEtt, :bildTva, :bildTre, CURRENT_TIMESTAMP)";
		$prepared = $this->db->prepare($sql);
		$prepared->execute(array('title' => $title, 'category' => $category, 'description' => $description, 'trailerlink' => $trailerLink, 'IMDBlink' => $imdbLink, 'imageUpload' => $imageUpload, 'bildEtt' => $bildEtt, 'bildTva' => $bildTva, 'bildTre' => $bildTre));
		
		$target_dir = "images/";
		$target_file_1 = $target_dir . basename($imageUpload);
		$target_file_2 = $target_dir . basename($bildEtt);
		$target_file_3 = $target_dir . basename($bildTva);
		$target_file_4 = $target_dir . basename($bildTre);
		$uploadOk = 1;
		$imageFileType_1 = pathinfo($target_file_1,PATHINFO_EXTENSION);
		$imageFileType_2 = pathinfo($target_file_2,PATHINFO_EXTENSION);
		$imageFileType_3 = pathinfo($target_file_3,PATHINFO_EXTENSION);
		$imageFileType_4 = pathinfo($target_file_4,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submitImage"])) {
		
		    $check_1 = getimagesize($_FILES["imageUpload"]["tmp_name"]);
		    $check_2 = getimagesize($_FILES["bildEtt"]["tmp_name"]);
		    $check_3 = getimagesize($_FILES["bildTva"]["tmp_name"]);
		    $check_4 = getimagesize($_FILES["bildTre"]["tmp_name"]);
		    
		    if($check_1 !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "Huvudbild is not an image.";
		        $uploadOk = 0;
		    }
		    
		    if($check_2 !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "Extrabild 1 is not an image.";
		        $uploadOk = 0;
		    }
		    
		    if($check_3 !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "Extrabild 2 is not an image.";
		        $uploadOk = 0;
		    }
		    
		    if($check_4 !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "Extrabild 3 is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file_1)) {
		    echo "Sorry, huvudbild already exists.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if (file_exists($target_file_2)) {
		    echo "Sorry, extrabild 1 already exists.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if (file_exists($target_file_3)) {
		    echo "Sorry, extrabild 2 already exists.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if (file_exists($target_file_4)) {
		    echo "Sorry, extabild 3 already exists.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		
		
		
		// Check file size
		if ($_FILES["imageUpload"]["size"] > 500000) {
		    echo "Sorry, huvudbild is too large.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if ($_FILES["bildEtt"]["size"] > 500000) {
		    echo "Sorry, extrabild ett is too large.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if ($_FILES["bildTva"]["size"] > 500000) {
		    echo "Sorry, extrabild två is too large.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if ($_FILES["bildTre"]["size"] > 500000) {
		    echo "Sorry, extrabild tre is too large.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		
		// Allow certain file formats
		if($imageFileType_1 != "jpg" && $imageFileType_1 != "png" && $imageFileType_1 != "jpeg"
		&& $imageFileType_1 != "gif" ) {
		    echo "Huvudbild = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if($imageFileType_2 != "jpg" && $imageFileType_2 != "png" && $imageFileType_2 != "jpeg"
		&& $imageFileType_2 != "gif" ) {
		    echo "Extrabild ett = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if($imageFileType_3 != "jpg" && $imageFileType_3 != "png" && $imageFileType_3 != "jpeg"
		&& $imageFileType_3 != "gif" ) {
		    echo "Extrabild två = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		if($imageFileType_4 != "jpg" && $imageFileType_4 != "png" && $imageFileType_4 != "jpeg"
		&& $imageFileType_4 != "gif" ) {
		    echo "Extrabild tre = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		     die('not working');
		}
		
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		    die('not working');
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file_1) && move_uploaded_file($_FILES["bildEtt"]["tmp_name"], $target_file_2) && move_uploaded_file($_FILES["bildTva"]["tmp_name"], $target_file_3) && move_uploaded_file($_FILES["bildTre"]["tmp_name"], $target_file_4)) {
		        
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		         die('not working');
		    }
		}
		
		
		}
	
	}
	
	public function showMovieList() {
	
		if(isset($_GET['number']) && !isset($_GET['pag'])) {
			$number = $_GET['number'];
			$number = intval(trim($number));
		}
		else {
			$number = 10;
		}
		
		$sql = 'SELECT * FROM filmer ORDER BY dateTime DESC LIMIT :number';
		$prepared = $this->db->prepare($sql);
		$prepared->bindParam(':number', $number, PDO::PARAM_INT);
		$prepared->execute();
		$totalMovieList = $prepared->fetchAll(PDO::FETCH_ASSOC);
		$display = '';
		
		foreach ($totalMovieList as $movie) {
			$display .= '<table class="listTable"><tr>
										<td rowspan="2" class="leftCol"><img src="img.php?src='.$movie['imageName'].'&width=200&height=265&crop-to-fit" alt="'.$movie['title'].'"></td>
										<td class="movieTitle rightCol"><a href="film.php?number='.$movie['id'].'">'.$movie['title'].'</a></td>
									 </tr>
									 <tr>
										<td class="movieDescription rightCol">'.substr($movie['description'], 0, 400).' ...</td>
									</tr></table>';
		}
		
			$display .=	'<p class="movieRanking">Välj antal filmer att visas: <a href="?number=10">10</a>, <a href="?number=7">7</a>, <a href="?number=5">5</a>, <a href="?number=3">3</a>, <a href="?number=1">1</a></p>';
			
			$display .= '<table class="incDec">
													<tr>
															<td>
																<a href="?number='.$number.'&pag=0">Föregående Filmer</a>
															</td>
															<td>
																<a href="?number='.$number.'&pag=1">Nästa Filmer</a>
															</td>
														</tr>
										</table>';
		
		//if (!isset($_GET['pag'])) {	
			//return $display;
		//}
	}
	
	public function pagination() {
		
		if (isset($_GET['number'])) {
			$number = intval(trim($_GET['number']));
		}else {
			$number = 10;
		}
		
		if (isset($_GET['pag'])) {
			$pag = intval(trim($_GET['pag']));
		}
		else {
			$pag = 0;
		}
		
		if (isset($_GET['number']) && isset($_GET['pag'])) {
			$rowPlace = intval(trim($_GET['pag'])) * intval(trim($_GET['number']));
		}
		else {
			$rowPlace = 0;
		}
		
		$sql = 'SELECT * FROM filmer ORDER BY dateTime DESC LIMIT :number OFFSET :rowPlace';
		$prepared = $this->db->prepare($sql);
		$prepared->bindParam(':number', $number, PDO::PARAM_INT);
		$prepared->bindParam(':rowPlace', $rowPlace, PDO::PARAM_INT);
		$prepared->execute();
		$totalMovieList = $prepared->fetchAll(PDO::FETCH_ASSOC);
		$displayPag = '<table class="listTable">';
			
		
		foreach ($totalMovieList as $movie) {
			$displayPag .= '<tr>
													<td rowspan="2" class="leftCol"><img src="img.php?src='.$movie['imageName'].'&width=200&height=265&crop-to-fit" alt="'.$movie['title'].'"></td>
													<td class="movieTitle rightCol"><a href="film.php?number='.$movie['id'].'">'.$movie['title'].'</a></td>
											 </tr>
											 <tr>
													<td class="movieDescription rightCol">'.substr($movie['description'], 0, 400).' ...</td>
											</tr>
											';
		}
		
			$displayPag .=	'<tr>
												<td colspan="2">
												<p class="movieRanking">Välj antal filmer att visas: <a href="?number=10">10</a>, <a href="?number=7">7</a>, <a href="?number=5">5</a>, <a href="?number=3">3</a>, <a href="?number=1">1</a></p>
												</td>
											</tr>';
		
		
		if ($pag < 1) {
			$pagDecrease = 1;
			$pagIncrease = $pag += 1;
		}else {
			$pagDecrease = --$pag;
			$pagIncrease = $pag += 2;
		}
		
		$rows = $this->db->query('SELECT COUNT(*) FROM filmer');
		$rowCount = $rows->fetch(PDO::FETCH_NUM);
		$rowNumber = intval(trim($rowCount[0]));
		$rowPlaceTest = $rowNumber - $rowPlace;
		
			
		$displayPag .= '<tr class="center">
											<td>
												<a href="?number='.$number.'&pag='.$pagDecrease.'">Föregående Filmer</a>
											</td>';
			
			if ($rowPlaceTest > $number) {
					$displayPag .= '<td>
													<a href="?number='.$number.'&pag='.$pagIncrease.'">Nästa Filmer</a>
												</td>
											</tr>';
				}else {
					$displayPag .= '<td align="center">
													<p>Slut på Filmer...</p>
												</td>
											</tr>';
				}
			
			
			$displayPag .= '</table>';
		
			return $displayPag;	
	
	}
	
	
	

public function showSingleMovie() {

	if(isset($_GET['number'])) {
		$number = $_GET['number'];
		$number = intval(trim($number));
	}
	else {
		$number = 1;
	}
	
	$sql = 'SELECT * FROM filmer WHERE id = :number';
	$prepared = $this->db->prepare($sql);
	$prepared->bindParam(':number', $number, PDO::PARAM_INT);
	$prepared->execute();
	$display = '';
	
	foreach ($prepared as $movie) {
		$display .= '<h1>'.$movie['title'].'</h1>
								<table style="width:900px" id="singleMovieTable">
									<tr>
										<td rowspan="2" colspan="2"><img src="img.php?src='.$movie['imageName'].'&width=250&height=370&crop-to-fit" alt="'.$movie['title'].'"></td>
										<td colspan="4" valign="top">'.$movie['description'].'</td>
									</tr>
									<tr>
										<td colspan="2" align="center" valign="bottom"><a href="'.$movie['trailerlink'].'">Länk till Trailer</a></td>
										<td colspan="2" align="center" valign="bottom"><a href="'.$movie['IMDBlink'].'">Länk till IMDB</a></td>
									</tr>
									<tr>
										<td colspan="6"><h2>Fler bilder:</h2></td>
									</tr>
									<tr>
										<td colspan="2" align="center" class="tableDataExtraImage"><img src="img.php?src='.$movie['imageOne'].'&width=300&height=200&crop-to-fit" alt="'.$movie['title'].'-1"></td>
										<td colspan="2" align="center" class="tableDataExtraImage"><img src="img.php?src='.$movie['imageTwo'].'&width=300&height=200&crop-to-fit" alt="'.$movie['title'].'-2"></td>
										<td colspan="2" align="center" class="tableDataExtraImage"><img src="img.php?src='.$movie['imageThree'].'&width=300&height=200&crop-to-fit" alt="'.$movie['title'].'-3"></td>
									</tr>
								</table>';
	}
	
	return $display;
	
}

public function movieForHomePage() {

	$query = $this->db->query('SELECT * FROM filmer ORDER BY dateTime DESC LIMIT 3');
	$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	$threeMovies = '<div class="container moviePicsContainer"><h2>Nyhetsfilmer</h2>';
	
	foreach ($movies as $movie) {
		$threeMovies .= '<a href="film.php?number='.$movie['id'].'">
											<div class="col-md-4 moviePics">
												<div class="moviePicsImage">
												<img src="img.php?src='.$movie['imageName'].'&w=100px&h=100px&stretch" alt="'.$movie['title'].'" />
												</div>
												<p>'.$movie['title'].'</p>
											</div>
										</a>';
	}
	
	$threeMovies .= '</div>';
	
	return $threeMovies;
}

public function showEditMenu() {
	$results = $this->db->query('SELECT * FROM filmer ORDER BY id DESC');
	$movieEditMenu = $results->fetchAll(PDO::FETCH_ASSOC);
	$newEditLine = '<a href="filmsetting.php"><h2>Skapa ny Film</h2></a>';
	
	foreach ($movieEditMenu as $menuItem) {
		$newEditLine .= '<table style="width:300px" id="movieEditMenu">
											<tr class="borderTop">
											 <td colspan="2"><h2>' .$menuItem['title']. '</h2></td>
											</tr>
											<tr class="borderBottom">
											 <td align="left"><a href="edit-film.php?edit='.$menuItem['id'].'">Editera denna Film</a></td>
											 <td align="right"><a href="?delete='.$menuItem['id'].'">Ta bort denna Film</a></td>
											</tr>
										 </table>';
	}
	return $newEditLine;
}

public function deletePost() {
	if (isset($_GET['delete'])) {
		$movieToDelete = $_GET['delete'];
		
		$sql = 'DELETE FROM filmer WHERE id = :movieToDelete';
		$prepared = $this->db->prepare($sql);
		$prepared->bindParam(':movieToDelete', $movieToDelete, PDO::PARAM_INT);
		$prepared->execute();
		
		$page = $_SERVER['PHP_SELF'];
		header("Refresh: 0; url=$page");
		
	}
}

public function editMovie() {
	if (isset($_GET['edit'])) {
		$edit = $_GET['edit'];
		
		$sql = 'SELECT * FROM filmer WHERE id = :editID';
		$prepared = $this->db->prepare($sql);
		$prepared->bindParam(':editID', $edit, PDO::PARAM_INT);
		$prepared->execute();
		$data = $prepared->fetchAll(PDO::FETCH_ASSOC);
		$content = '';
		
		foreach ($data as $inputData) {
			$content = '<form method="post" action="'.$_SERVER['PHP_SELF'].'?edit='.$edit.'" enctype="multipart/form-data">
									<table id="movieCreation">
										<tr>
											<td colspan="3">
												<label for="title">Titel:</label><br>
												<input type="text" name="title" style="width:100%;" value="'.$inputData['title'].'"/><br>
											</td>
											<td colspan="4">
												<label for="trailer">Trailerlänk:</label><br>
												<input type="text" name="trailer" style="width:100%;" value="'.$inputData['trailerlink'].'"/><br>
											</td>
											<td colspan="4">
												<label for="imdb">IMDB-länk:</label><br>
												<input type="text" name="imdb" style="width:100%;" value="'.$inputData['IMDBlink'].'"/><br>
											</td>
										</tr>
										<tr>
											<td colspan="12">
												<label for="category">Kategori(er):</label><br>
												<p>OBS: Välj mellan Action, Äventyr, Thriller, Romantik, Komedi eller Drama. Att kombinera går också bra!</p>
												<input type="text" name="category" style="width:100%;" value="'.$inputData['category'].'"><br>
											</td>
										</tr>
										<tr>
											<td colspan="12">
												<label for="description">Beskrivning:</label><br>
												<textarea name="description" style="width:100%; height:150px;">'.$inputData['description'].'</textarea><br>
												<hr>
												<p>Här kan du ändra bild. Du måste inte ändra bild eller fylla i något här. Lämnar du någon bild oredigerad ändras inte den oredigerade bilden utan stannar kvar precis som den är.</p>
											</td>
										</tr>
										<tr>
											<td colspan="3">
												<label for="imageUpload">Bild på Film är:</label><br>
												<img src="img.php?src='.$inputData['imageName'].'&height=150">
												<input type="file" name="imageUpload" id="imageUpload">
											</td>
											<td colspan="3">
												<label for="bildEtt">Extrabild ett är:</label><br>
												<img src="img.php?src='.$inputData['imageOne'].'&height=100">
												<input type="file" name="bildEtt" id="imageUpload">
											</td>
											<td colspan="3">
												<label for="bildTva">Extrabild två är:</label><br>
												<img src="img.php?src='.$inputData['imageTwo'].'&height=100">
												<input type="file" name="bildTva" id="imageUpload">
											</td>
											<td colspan="3">
												<label for="bildTre">Extrabild tre är:</label><br>
												<img src="img.php?src='.$inputData['imageThree'].'&height=100">
												<input type="file" name="bildTre" id="imageUpload">
											</td>
										</tr>
										<tr>
											<td>
												<input type="submit" name="submitEdit" value="Ändra Film"/>
											</td>
										</tr>
										</table>
									</form>';
										
		}
		
		return $content;
	
		} 
		
	}
	
		public function updateMovie() {
			if (isset($_POST['submitEdit'])) {
				$edit = $_GET['edit'];
				$title = $_POST['title'];
				$category = $_POST['category'];
				$description = $_POST['description'];
				$trailerLink = $_POST['trailer'];
				$imdbLink = $_POST['imdb'];
				$imageUpload_1 = $_FILES['imageUpload']['name'];
				$imageUpload_2 = $_FILES['bildEtt']['name'];
				$imageUpload_3 = $_FILES['bildTva']['name'];
				$imageUpload_4 = $_FILES['bildTre']['name'];
				
				if(empty($imageUpload_1) && empty($imageUpload_2) && empty($imageUpload_3) && empty($imageUpload_4)) {
				
					$sql = 'UPDATE filmer SET title=?, category=?, description=?, trailerlink=?, IMDBlink=?, dateTime=CURRENT_TIMESTAMP WHERE id=?';
					$prepared = $this->db->prepare($sql);
					$prepared->execute(array($title, $category, $description, $trailerLink, $imdbLink, $edit));
					
					header('location:'.$_SERVER['PHP_SELF'].'?edit='.$edit.'');
				
				}
				
				if (!empty($imageUpload_1) || !empty($imageUpload_2) || !empty($imageUpload_3) || !empty($imageUpload_4)) {
					
				
					$sqlOne = 'SELECT * FROM filmer WHERE id = :edit';
					$preparedOne = $this->db->prepare($sqlOne);
					$preparedOne->execute(array('edit' => $edit));
					$content = $preparedOne->fetch(PDO::FETCH_ASSOC);
					$imagePath_1 = $content['imageName'];
					$imagePath_2 = $content['imageOne'];
					$imagePath_3 = $content['imageTwo'];
					$imagePath_4 = $content['imageThree'];
					
					if (isset($_POST['imageName'])) {
						unlink('images/' . $imagePath_1);
					}
					
					if (isset($_POST['bildEtt'])) {
						unlink('images/' . $imagePath_2);
					}
					
					if (isset($_POST['bildTva'])) {
						unlink('images/' . $imagePath_3);
					}
					
					if (isset($_POST['bildTre'])) {
						unlink('images/' . $imagePath_4);
					}
					
					if (empty($imageUpload_1)) {
						$imageUpload_1 = $content['imageName'];
					}
					
					if (empty($imageUpload_2)) {
						$imageUpload_2 = $content['imageOne'];
					}
					
					if (empty($imageUpload_3)) {
						$imageUpload_3 = $content['imageTwo'];
					}
					
					if (empty($imageUpload_4)) {
						$imageUpload_4 = $content['imageThree'];
					}
					
					
					$sql = 'UPDATE filmer SET title=?, category=?, description=?, trailerlink=?, IMDBlink=?, imageName=?, imageOne=?, imageTwo=?, imageThree=?, dateTime=CURRENT_TIMESTAMP WHERE id=?';
					$prepared = $this->db->prepare($sql);
					$prepared->execute(array($title, $category, $description, $trailerLink, $imdbLink, $imageUpload_1, $imageUpload_2, $imageUpload_3, $imageUpload_4, $edit));
					
					//Ladda upp nya bilden
					
					$target_dir = "images/";
					$target_file_1 = $target_dir . basename($imageUpload_1);
					$target_file_2 = $target_dir . basename($imageUpload_2);
					$target_file_3 = $target_dir . basename($imageUpload_3);
					$target_file_4 = $target_dir . basename($imageUpload_4);
					$uploadOk = 1;
					$imageFileType_1 = pathinfo($target_file_1,PATHINFO_EXTENSION);
					$imageFileType_2 = pathinfo($target_file_2,PATHINFO_EXTENSION);
					$imageFileType_3 = pathinfo($target_file_3,PATHINFO_EXTENSION);
					$imageFileType_4 = pathinfo($target_file_4,PATHINFO_EXTENSION);
					
					// Check if image file is a actual image or fake image & check if the file exists
					
					if (isset($_POST['imageUpload'])) {
						$check_1 = getimagesize($_FILES["imageUpload"]["tmp_name"]);
						if($check_1 !== false) {
						    echo "Huvudbild is an image - " . $check_1["mime"] . ".";
						    $uploadOk = 1;
						} else {
						    echo "Huvudbild is not an image.";
						    $uploadOk = 0;
						}
						if (file_exists($target_file_1)) {
						    echo "Sorry, huvudbild already exists.";
						    $uploadOk = 0;
						     die('not working');
						}
					}
					if (isset($_POST['bildEtt'])) {
						$check_2 = getimagesize($_FILES["bildEtt"]["tmp_name"]);
						if($check_2 !== false) {
						    echo "File is an image - " . $check_2["mime"] . ".";
						    $uploadOk = 1;
						} else {
						    echo "Extrabild 1 is not an image.";
						    $uploadOk = 0;
						}
						if (file_exists($target_file_2)) {
						    echo "Sorry, extrabild 1 already exists.";
						    $uploadOk = 0;
						     die('not working');
						}
					}
					if (isset($_POST['bildTva'])) {
						$check_3 = getimagesize($_FILES["bildTva"]["tmp_name"]);
						if($check_3 !== false) {
						    echo "File is an image - " . $check_3["mime"] . ".";
						    $uploadOk = 1;
						} else {
						    echo "Extrabild 2 is not an image.";
						    $uploadOk = 0;
						}
						if (file_exists($target_file_3)) {
						    echo "Sorry, extrabild 2 already exists.";
						    $uploadOk = 0;
						     die('not working');
						}
					}
					if (isset($_POST['bildTre'])) {
						$check_4 = getimagesize($_FILES["bildTre"]["tmp_name"]);
						if($check_4 !== false) {
						    echo "File is an image - " . $check_4["mime"] . ".";
						    $uploadOk = 1;
						} else {
						    echo "Extrabild 3 is not an image.";
						    $uploadOk = 0;
						}
						if (file_exists($target_file_4)) {
						    echo "Sorry, extabild 3 already exists.";
						    $uploadOk = 0;
						     die('not working');
						}
					}			
					
					
					// Check file size
					if ($_FILES["imageUpload"]["size"] > 500000) {
					    echo "Sorry, huvudbild is too large.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if ($_FILES["bildEtt"]["size"] > 500000) {
					    echo "Sorry, extrabild ett is too large.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if ($_FILES["bildTva"]["size"] > 500000) {
					    echo "Sorry, extrabild två is too large.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if ($_FILES["bildTre"]["size"] > 500000) {
					    echo "Sorry, extrabild tre is too large.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					
					// Allow certain file formats
					if($imageFileType_1 != "jpg" && $imageFileType_1 != "png" && $imageFileType_1 != "jpeg"
					&& $imageFileType_1 != "gif" ) {
					    echo "Huvudbild = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if($imageFileType_2 != "jpg" && $imageFileType_2 != "png" && $imageFileType_2 != "jpeg"
					&& $imageFileType_2 != "gif" ) {
					    echo "Extrabild ett = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if($imageFileType_3 != "jpg" && $imageFileType_3 != "png" && $imageFileType_3 != "jpeg"
					&& $imageFileType_3 != "gif" ) {
					    echo "Extrabild två = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					if($imageFileType_4 != "jpg" && $imageFileType_4 != "png" && $imageFileType_4 != "jpeg"
					&& $imageFileType_4 != "gif" ) {
					    echo "Extrabild tre = Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					     die('not working');
					}
					
					
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					    die('not working');
					// if everything is ok, try to upload file
					} else {
					    if (!empty($imageUpload_1)) {
					    		move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file_1); 
					      }  
					     if (!empty($imageUpload_2))
					        move_uploaded_file($_FILES["bildEtt"]["tmp_name"], $target_file_2);
					     }
					     if (!empty($imageUpload_3))
					     		move_uploaded_file($_FILES["bildTva"]["tmp_name"], $target_file_3);
					     }
					     if (!empty($imageUpload_4)) {
					     		move_uploaded_file($_FILES["bildTre"]["tmp_name"], $target_file_4);
					     }
					  	 else {
					        echo "Sorry, there was an error uploading your file.";
					         die('not working');
					    }
						}
					
		}	
		
		public function searchHeader() {
			$formHeader = '	<form method="get" action="kategori.php">
												<input type="text" name="searchText" placeholder="Sök Film" />
												<input type="submit" name="submitSearch" value="Sök" id="submitSearch" />
											</form>';
											
			return $formHeader;
		}
		
		public function presentSearch() {
											
			if (isset($_GET['searchText'])) {
				$searchText = $_GET['searchText'];
				
				$sql = "SELECT * FROM filmer WHERE title LIKE :searchText OR category LIKE :searchText ORDER BY dateTime DESC";
				$prepared = $this->db->prepare($sql);
				$prepared->execute(array('searchText' => '%'.$searchText.'%'));
				$datas = $prepared->fetchAll(PDO::FETCH_ASSOC);
				$display = '<h2 style="text-transform: uppercase;">Resultat: '.$searchText.'</h2>';
				
				foreach ($datas as $data) {
					$display .= '<table class="listTable"><tr>
												<td rowspan="2" class="leftCol"><img src="img.php?src='.$data['imageName'].'&width=200&height=265&crop-to-fit"></td>
												<td class="movieTitle rightCol"><a href="film.php?number='.$data['id'].'">'.$data['title'].'</a></td>
											 </tr>
											 <tr>
												<td class="movieDescription rightCol">'.substr($data['description'], 0, 400).' ...</td>
											</tr></table>';
				}
				
				return $display;
			
			}
		}
		
		public function showCategories() {
			$displayCategories = '<div class="container">
															<h2>Filmkategorier</h2>
															<div class="row">
																<a href="kategori.php?searchText=action">
																	<div class="col-md-4 movieCategory" id="Action">
																		<div class=layerCategory>
																			<h2>Action</h2>
																		</div>
																	</div>
																</a>
					
																<a href="kategori.php?searchText=%C3%A4ventyr">
																	<div class="col-md-4 movieCategory" id="Adventure">
																		<div class=layerCategory>
																			<h2>Äventyr</h2>
																		</div>
																	</div>
																</a>
																	
							
																<a href="kategori.php?searchText=thriller">
																	<div class="col-md-4 movieCategory" id="Thriller">
																		<div class=layerCategory>
																			<h2>Thriller</h2>
																		</div>
																	</div>
																</a>
															</div>
																		
															<div class="row">
																<a href="kategori.php?searchText=romantik">
																	<div class="col-md-4 movieCategory" id="Romantic">
																		<div class=layerCategory>
																			<h2>Romantik</h2>
																		</div>
																	</div>
																</a>
																			
																<a href="kategori.php?searchText=komedi">
																	<div class="col-md-4 movieCategory" id="Comedy">
																		<div class=layerCategory>
																			<h2>Komedi</h2>
																		</div>
																	</div>
																</a>
																
																<a href="kategori.php?searchText=drama">
																	<div class="col-md-4 movieCategory" id="Drama">
																		<div class=layerCategory>
																			<h2>Drama</h2>
																		</div>
																	</div>
																</a>
															</div>
																			
														</div>';
														
			return $displayCategories;
		}
		
		public function mostPopular() {
			
			$sql = 'SELECT * FROM filmer ORDER BY dateTime DESC LIMIT 2';
			$prepared = $this->db->prepare($sql);
			$prepared->execute();
			$datas = $prepared->fetchAll(PDO::FETCH_ASSOC);
			$mostPopular = '<div class="container" id="mostPopular">
												<div class="col-md-6">
													<h2>Populärast</h2>
												</div>
												<div class="col-md-6">
													<h2>Senast Hyrda</h2>
												</div>';
			
			foreach ($datas as $data) {
			
			$mostPopular .= '<div class="col-md-6">
												<a href="film.php?number='.$data['id'].'">
													<h3>'.$data['title'].'</h3>
													<img src="img.php?src='.$data['imageName'].'&height=300" alt="'.$data['title'].'"/>
												</a>
												</div>';
											
			}
			
			$mostPopular .= '</div>';
		
			return $mostPopular;
		}
		
		
		
}





									
		
		
	





