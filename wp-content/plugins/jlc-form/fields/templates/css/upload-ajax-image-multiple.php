<style>
.jlc-custom-form-upload-ajax-image-multiple-field
{
	position:relative;
	width:max-content;
	max-width:100%;
	width:100%;

	margin-bottom:20px;
}

.jlc-custom-form-upload-ajax-image-multiple-field-preview
{
	position:relative;
	display: flex;
	justify-content: flex-start;
	align-items:flex-start;
	padding: 10px;
	border-radius: 5px;
	box-shadow: inset 1px 1px 2px 0 #666;
}
.jlc-custom-form-upload-ajax-image-multiple-field-preview .jlc-custom-form-preview-block
{
	min-width:100px;
	min-height:100px;
	max-width:300px;
	max-height:300px;
	width:33%;
	padding:5px;
	border-radius:5px;
	position:relative;
	box-shadow:1px 1px 2px 0 #666;

	cursor:pointer;
}
.jlc-custom-form-upload-ajax-image-multiple-field-preview .jlc-custom-form-preview-block:hover
{
	box-shadow:1px 1px 2px 0 #017d89;
}

.jlc-custom-form-upload-ajax-image-multiple-field-preview .jlc-custom-form-preview-block .jlc-custom-form-preview-block-content
{
	width:100%;
	padding-top:100%;
	position:relative;
}
.jlc-custom-form-upload-ajax-image-multiple-field-preview .jlc-custom-form-preview-block.jlc-custom-form-add-image .jlc-custom-form-icon
{
	position:absolute;
	top:50%;
	left:50%;
	-webkit-transform:translate(-50%,-50%);
	-moz-transform:translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	-o-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);

	font-size:50px;
	font-weight:500;
	text-shadow:1px 1px solid #666;
}
.jlc-custom-form-upload-ajax-image-multiple-field-preview .jlc-custom-form-preview-block.jlc-custom-form-selected-image .jlc-custom-form-preview-block-content > img
{
	max-width:100%;
	max-height:100%;
	width:100%;
	height:auto;
	position:absolute;
	
	top:50%;
	left:50%;
	-webkit-transform:translate(-50%,-50%);
	-moz-transform:translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	-o-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);
}
/*
.jlc-custom-form-upload-ajax-image-multiple-field-preview img
{
	width:<?php echo (int)get_option( 'thumbnail_size_w', 200 ); ?>px;
	max-width:100%;
	display:block;
	margin-left:auto;
	margin-right:auto;
}
*/

.jlc-custom-form-upload-ajax-image-multiple-field .buttons
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
.jlc-custom-form-upload-ajax-image-multiple-field:hover .buttons
{
}

.jlc-custom-form-upload-ajax-image-multiple-field .buttons button,
.jlc-custom-form-upload-ajax-image-multiple-field .buttons .wait
{
	border:none;
	background-color:transparent;
	color:#ccc;
	text-shadow:1px 1px 0 #666;
	font-size:24px;
	padding:4px;
	line-height:1;
}
.jlc-custom-form-upload-ajax-image-multiple-field .buttons button:hover
{
	color:#fff;
}

@-webkit-keyframes jlc-custom-form-upload-ajax-image-multiple-field-wait-animation {
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
@-moz-keyframes jlc-custom-form-upload-ajax-image-multiple-field-wait-animation {
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
@-o-keyframes jlc-custom-form-upload-ajax-image-multiple-field-wait-animation {
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
@keyframes jlc-custom-form-upload-ajax-image-multiple-field-wait-animation {
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
.jlc-custom-form-upload-ajax-image-multiple-field .buttons .wait span
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

.jlc-custom-form-upload-ajax-image-multiple-field .buttons button.jlc-custom-form-change-image {display:none;}
.jlc-custom-form-upload-ajax-image-multiple-field .buttons button.jlc-custom-form-remove-image {display:none;}
.jlc-custom-form-upload-ajax-image-multiple-field.set .buttons button.jlc-custom-form-add-image {display:none;}
.jlc-custom-form-upload-ajax-image-multiple-field.set .buttons button.jlc-custom-form-change-image {display:block;}
.jlc-custom-form-upload-ajax-image-multiple-field.set .buttons button.jlc-custom-form-remove-image {display:block;}

.jlc-custom-form-upload-ajax-image-multiple-field.loading .buttons button.jlc-custom-form-add-image,
.jlc-custom-form-upload-ajax-image-multiple-field.loading .buttons button.jlc-custom-form-change-image,
.jlc-custom-form-upload-ajax-image-multiple-field.loading .buttons button.jlc-custom-form-remove-image
{
	display:none;
}
.jlc-custom-form-upload-ajax-image-multiple-field .buttons .wait
{
	display:none;
}
.jlc-custom-form-upload-ajax-image-multiple-field.loading .buttons .wait
{
	display:block;
}

.jlc-custom-form-upload-ajax-image-multiple-field input[type="file"]
{
	display:none;
}

</style>
