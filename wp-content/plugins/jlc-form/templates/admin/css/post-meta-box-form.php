<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<style>
<?php echo self::get_selector_line( $meta_box_ides, 'label' ); ?>
{
	display:block;
}
<?php echo self::get_selector_line( $meta_box_ides, '> input' ); ?>
{
	display:block;
	max-width:100%;
	margin-bottom:10px;
}

<?php echo self::get_selector_line( $meta_box_ides, 'fieldset' ); ?>
{
	margin-bottom:5px;
	margin-top:5px;
}
<?php echo self::get_selector_line( $meta_box_ides, 'fieldset label' ); ?>
{
	display:inline-block;
}
<?php echo self::get_selector_line( $meta_box_ides, 'fieldset input' ); ?>
{
	display:inline-block;
	max-width:100%;
	margin-bottom:0;
}
<?php echo self::get_selector_line( $meta_box_ides, '.jlc-custom-form-table-variable-field-sheet fieldset' ); ?>
{
	margin-top:0;
	margin-bottom:0;
}
</style>
