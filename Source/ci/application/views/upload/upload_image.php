<?php if($error):  
	echo $error; 
endif;?>
<?php  echo form_open_multipart('user/do_upload');?>
<input type="file" name="userfile"  size="20" />
<br/> <br/>
<input type="submit" name="" value="upload">
<?php echo form_close()?>
