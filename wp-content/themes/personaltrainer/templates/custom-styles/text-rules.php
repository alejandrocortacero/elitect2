<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>

<?php echo $selector; ?>
{
	color:<?php echo $color; ?>;
}

<?php if( $with_hover ) : ?>
<?php echo $selector; ?>:hover
{
	color:<?php echo $hover_color; ?>;
}
<?php endif; ?>


