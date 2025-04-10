<style>
.jlc-custom-form-upload-ajax-image-field
{
	position:relative;
	max-width:<?php echo (int)get_option( 'thumbnail_size_w' ); ?>px;
}

.jlc-custom-form-upload-ajax-image-field > img
{
	width:100%;
}

.jlc-custom-form-upload-ajax-image-field .buttons
{
	display:none;
	justify-content:space-around;
	align-items:center;

	position:absolute;
	top:50%;
	left:50%;
	-webkit-transform:translate(-50%,-50%);
	-moz-transform:translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	-o-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);

	padding:10px;
	background-color:rgba(50,50,50,.8);
}
.jlc-custom-form-upload-ajax-image-field:hover .buttons
{
	display:flex;
}

.jlc-custom-form-upload-ajax-image-field .buttons button
{
	border:none;
	background-color:transparent;
	color:#ccc;
	text-shadow:1px 1px 0 #666;
	font-size:24px;
	padding:4px;
	line-height:1;
}
.jlc-custom-form-upload-ajax-image-field .buttons button:hover
{
	color:#fff;
}

.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-change-image {display:none;}
.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-remove-image {display:none;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-add-image {display:none;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-change-image {display:block;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-remove-image {display:block;}
</style>
