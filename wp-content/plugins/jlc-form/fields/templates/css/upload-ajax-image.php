<style>
.jlc-custom-form-upload-ajax-image-field
{
	position:relative;
	width:max-content;
	max-width:100%;
	width:100%;

	margin-bottom:20px;
}

.jlc-custom-form-upload-ajax-image-field-preview
{
	position:relative;
}
.jlc-custom-form-upload-ajax-image-field-preview img
{
	width:<?php echo (int)get_option( 'thumbnail_size_w', 200 ); ?>px;
	max-width:100%;
	display:block;
	margin-left:auto;
	margin-right:auto;
}

.jlc-custom-form-upload-ajax-image-field .buttons
{
	display:flex;
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
}

.jlc-custom-form-upload-ajax-image-field .buttons button,
.jlc-custom-form-upload-ajax-image-field .buttons .wait
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

@-webkit-keyframes jlc-custom-form-upload-ajax-image-field-wait-animation {
	from
	{
		-webkit-transform: rotate(0deg);
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-o-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	to
	{
		-webkit-transform: rotate(360deg);
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-o-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}
@-moz-keyframes jlc-custom-form-upload-ajax-image-field-wait-animation {
	from
	{
		-webkit-transform: rotate(0deg);
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-o-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	to
	{
		-webkit-transform: rotate(360deg);
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-o-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}
@-o-keyframes jlc-custom-form-upload-ajax-image-field-wait-animation {
	from
	{
		-webkit-transform: rotate(0deg);
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-o-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	to
	{
		-webkit-transform: rotate(360deg);
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-o-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}
@keyframes jlc-custom-form-upload-ajax-image-field-wait-animation {
	from
	{
		-webkit-transform: rotate(0deg);
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-o-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	to
	{
		-webkit-transform: rotate(360deg);
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-o-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}
.jlc-custom-form-upload-ajax-image-field .buttons .wait span
{
	-webkit-animation-name: jlc-custom-form-upload-ajax-image-field-wait-animation;
	-moz-animation-name: jlc-custom-form-upload-ajax-image-field-wait-animation;
	-o-animation-name: jlc-custom-form-upload-ajax-image-field-wait-animation;
	animation-name: jlc-custom-form-upload-ajax-image-field-wait-animation;
	-webkit-animation-duration: 1s;
	-moz-animation-duration: 1s;
	-o-animation-duration: 1s;
	animation-duration: 1s;
	-webkit-animation-iteration-count: infinite;
	-moz-animation-iteration-count: infinite;
	-o-animation-iteration-count: infinite;
	animation-iteration-count: infinite;
}

.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-change-image {display:none;}
.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-remove-image {display:none;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-add-image {display:none;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-change-image {display:block;}
.jlc-custom-form-upload-ajax-image-field.set .buttons button.jlc-custom-form-remove-image {display:block;}

.jlc-custom-form-upload-ajax-image-field.loading .buttons button.jlc-custom-form-add-image,
.jlc-custom-form-upload-ajax-image-field.loading .buttons button.jlc-custom-form-change-image,
.jlc-custom-form-upload-ajax-image-field.loading .buttons button.jlc-custom-form-remove-image
{
	display:none;
}
.jlc-custom-form-upload-ajax-image-field .buttons .wait
{
	display:none;
}
.jlc-custom-form-upload-ajax-image-field.loading .buttons .wait
{
	display:block;
}

.jlc-custom-form-upload-ajax-image-field input[type="file"]
{
	display:none;
}

</style>
