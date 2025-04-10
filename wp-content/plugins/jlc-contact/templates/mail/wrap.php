<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php echo esc_html( $mail_heading ); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
		<tr>
			<td><h1 style="text-align:center;"><?php echo esc_html( $email_heading ); ?><h1></td>
		</tr>
		<tr>
			<td><?php echo nl2br( $message ); ?></td>
		</tr>
		<tr>
			<td><a style="text-align:center;" href="<?php echo get_bloginfo( 'siteurl' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></td>
		</tr>
	</table>
</body>
</html>
