<?php
	session_start();
	include("../config.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | News</title
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.content img{
				
			}
			.content td{
				padding: 10px;
			}
			.content a{
				text-decoration: none;
				color: #00f;
			}
			.content a:hover{
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../nav1.php");
			else{
				include("../nav2.php");
				$username = $_SESSION['Username'];
			}
			$sql = "SELECT * FROM News ORDER BY Date DESC";
			$result = mysqli_query($conn,$sql);
		?>
		<div class="br"></div>
		<div class="content">
			<h2>Latest News</h2>
			<table>
				<?php
					while($row = mysqli_fetch_assoc($result)){
						$name = $row['Name'];
						$heading = $row['Heading'];
						$image = $row['Image'];
						$description = $row['Description'];
						$description = substr($description, 0, 100);
						$date = $row['Date'];
						echo "<tr>
								<td width='30%'><img src='../$image' alt='$name'></td>	
								<td>
									<h4>$heading</h4>
									<p>Update on $date</p>
									<p>$description...<a href='description/?name=$name'>more</a></p>
								</td>								
							</tr>";
					}
				?>
			</table>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>