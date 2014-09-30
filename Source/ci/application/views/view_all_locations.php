<html>
<head>
	<title>Test delete location</title>
	<meta name="name" charset='utf-8' content="content">
	<style type="text/css" media="screen">
		table{
			border-collapse: collapse;
			border: 1px solid #000;
			margin: 30px;
		}
		td{
			border: 1px solid #000;
			padding: 15px;
		}
		tr{
			margin: 20px;
		}
	</style>
</head>
<body>
	<h1>Test delete location</h1>
	<?php
	echo "<table>";
		foreach ($data as $row) {
			echo "<tr>";
			echo "<td>".$row['id']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['description']."</td>";
			echo "<td>".$row['lat']."</td>";
			echo "<td>".$row['long']."</td>";
			echo "<td>".anchor('user/remove_location/'.$row['id'],'delete')."</td>";
			echo "</tr>";
		}
	echo "</table>";
	?>
</body>
</html>