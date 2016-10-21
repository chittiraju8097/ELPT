<?php
include 'init.php';
?>
<form action="edit.php" method="post">
	<center><br>
		<table>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Firstname*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="first_name" value="<?php if($user_data['first_name']!='') echo $user_data['first_name'];?>" size="50" placeholder="<?php if($user_data['first_name'] !='') echo $user_data['first_name'];else echo "Provide your firstname"; ?>" ></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Lastname*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="last_name" size="50" value="<?php if($user_data['last_name']!='') echo $user_data['last_name'];?>" placeholder="<?php if($user_data['last_name'] !='') echo $user_data['last_name'];else echo "Provide lastname"; ?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Gender*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="gender" size="50" placeholder="<?php if($user_data['gender'] !='') echo $user_data['gender'];else echo "Ex: M"; ?>" value="<?php if($user_data['gender']!='') echo $user_data['gender'];?>" ></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Year*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="year" size="50" placeholder="<?php if($user_data['year'] !='') echo $user_data['year'];else echo "Ex: E3"; ?>" value="<?php if($user_data['year']!='') echo $user_data['year'];?>"></td>
		</tr>
		<tr>
			<td><br></td
		</tr>
		<tr>
			<td>Branch(optional)</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="branch" size="50" placeholder="<?php if($user_data['branch'] !='') echo $user_data['branch'];else echo "Ex: CSE"; ?>" value="<?php if($user_data['branch']!='') echo $user_data['branch'];?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Class*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="class" size="50" value="<?php if($user_data['class']!='') echo $user_data['class'];?>" placeholder="<?php if($user_data['class'] !='') echo $user_data['class'];else echo "Ex: SF-9"; ?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
	</table>
	<input type="submit" value="Update" style="margin-bottom:7px; width:74%;height:7%;background: linear-gradient(to bottom, #0BA3AD 0%, #0C9FA8 19%, #10696E 100%) repeat scroll 0% 0% transparent;padding: 1%;border-radius: 5px;margin-top: 7px;text-align: center;color:#FFF;font-weight:bold;">
</form>
