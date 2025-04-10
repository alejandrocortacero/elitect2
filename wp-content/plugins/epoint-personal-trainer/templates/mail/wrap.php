<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php echo esc_html( $mail_heading ); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-color:#FFFFFF;">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#F6F6F6; color:#111111;">
		<tr>
			<td style="padding:30px;color:#FFFFFF;background-color:#d8d54b;"><h1 style="text-align:center;color:#FFFFFF;font-size:26px;"><?php echo esc_html( $email_heading ); ?><h1></td>
		</tr>
		<tr>
			<td style="padding:20px;"><?php echo nl2br( $message ); ?></td>
		</tr>
		<tr>
			<td style="font-family:verdana;font-size:8px; padding:20px;color:#FFFFFF;background-color:#d8d54b;">
				<p><b>Aviso legal:</b></p>
				<p>Párrafo con texto legal</p>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;padding:10px; font-size:14px;"><a style="text-align:center;color:#d8d54b;text-decoration:none;" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></td>
		</tr>
	</table>
</body>
</html>
