<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>

<?php echo $selector; ?>
{
	<?php if( $type == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $color0; ?> 0, <?php echo $color1; ?> 100%);
	<?php elseif( $type == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $color0; ?> 0, <?php echo $color1; ?> 100%);
	<?php else : ?>
		background-image: none;
		background-color: <?php echo $color0; ?>;
	<?php endif; ?>
}

<?php if( $with_hover ) : ?>
<?php echo $selector; ?>:hover
{
	<?php if( $type == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $color0_darker; ?> 0, <?php echo $color1_darker; ?> 100%);
	<?php elseif( $type == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $color0_darker; ?> 0, <?php echo $color1_darker; ?> 100%);
	<?php else : ?>
		background-color: <?php echo $color0_darker; ?>;
	<?php endif; ?>
}
<?php endif; ?>

