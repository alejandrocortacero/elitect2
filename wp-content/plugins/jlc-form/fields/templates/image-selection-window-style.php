<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<style>
#jlc-custom-form-upload-ajax-image-selection-window .images-layer
{
	display:flex;
	justify-content:flex-start;
	flex-wrap:wrap;

	max-height:600px;
	overflow:auto;
}
#jlc-custom-form-upload-ajax-image-selection-window .images-layer img
{
	max-width:30%;
	max-height:160px;
	width:auto;
	height:auto;

	margin-right:1%;
	margin-bottom:1%;
}
#jlc-custom-form-upload-ajax-image-selection-window .images-layer img.selected
{
	box-shadow:0 0 2px 1px #116611;
	opacity:.5;
}
</style>
