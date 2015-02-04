<?php
echo '<table border="1" style="width:50%"><tr><th>Username</th><th>Email</th><th>Action</th></tr>';
if(!empty($user_datas))
{
foreach($user_datas as $users)
{
	$email = $users['User']['email'];
	echo '<tr align="center"><td style="width:25%;">';
	echo $users['User']['username'];
	echo '</td><td style="width:25%;">';
	echo $users['User']['email'];
	echo '</td><td>';
	echo '<a onclick="delete_contacts(\''.$email.'\')"><span class="btn btn-danger"><i class="icon-trash" style="cursor:pointer;"></i></a>';
	echo '</td></tr>';
}
}
else
{
	echo '<tr><td colspan="2" align="center">No Contacts Found</td></tr>';
}
echo '</table>';

?>
