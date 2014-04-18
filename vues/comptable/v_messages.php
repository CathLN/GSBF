<div class ="message">
<ul>
<?php 
foreach($_REQUEST['messages'] as $message)
	{
      echo "<li>$message</li>";
	}
?>
</ul></div>
