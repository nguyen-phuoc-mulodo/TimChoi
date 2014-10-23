<?php
echo "<table>";
	echo "<thead>";
		echo"<tr>";
			echo "<th>Stt</th>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
			echo "<th>Email</th>";
			echo "<th>Avatar</th>";
			echo "<th>Action</th>";
		echo "</tr>";
	echo"</thead>";
	echo"<tbody>";
		$i=1;
		foreach($data as $value){
			echo "<tr>";
				echo"<td>".$i."</td>";
				echo"<td>".$value["firstname"]."</td>";
				echo"<td>".$value["lastname"]."</td>";
				echo"<td>".$value["email"]."</td>";
				echo"<td>".$value["avatar"]."</td>";
				echo"<td>";
					echo anchor('users/add_friend/'.$value['id'],"Add friend");
				echo"</td>";
			echo"</tr>";
		}
	echo"</tbody>";
echo"</table>";
