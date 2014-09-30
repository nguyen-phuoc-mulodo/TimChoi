<html>
<head>
	<title>Add location</title>
	<meta  charset="utf-8" name="name" content="content">
</head>
<body>
	<h2>Add Location</h2>
	<?php
		echo form_open("user/add");
		if(validation_errors()){
			echo'<h3>Whoops! There was an error</h3>';
			echo validation_errors();
		}
	?>
	<table border="0">
		<tr>
			<td>Tên địa điểm:</td>
			<td><?php echo form_input($name_location); ?></td>
		</tr>
		<tr>
			<td>Mô tả:</td>
			<td><?php echo form_input($description); ?></td>
			</tr>
		<tr>
			<td>Lat:</td>
			<td><?php echo form_input($lat); ?></td>
		</tr>
		<tr>
			<td>Long:</td>
			<td><?php echo form_input($long); ?></td>
		</tr>
		<tr>
			<td>User_id:</td>
			<td><?php echo form_input($user_id); ?></td>
		</tr>
	</table>
	<?php echo form_submit('submit', 'Create'); ?> or <?php echo anchor('user/index', 'cancel'); ?>
	<?php echo form_close(); ?>
</body>
</html>
