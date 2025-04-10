<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php echo esc_html( $email_heading ); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-color:#EEEEEE;">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
		<tr>
			<td style="padding:20px;background-color:#213e6e;color:#FFFFFF;"><h1 style="text-align:center;color:#FFFFFF;"><?php echo esc_html( $email_heading ); ?><h1></td>
		</tr>
		<tr>
			<td style="padding:20px;color:#111111;"><?php echo nl2br( $message ); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;background-color:#213e6e;color:#FFFFFF;"><a style="text-align:center;color:#FFFFFF;" href="<?php echo get_bloginfo( 'siteurl' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></td>
		</tr>
	</table>
</body>
</html>
