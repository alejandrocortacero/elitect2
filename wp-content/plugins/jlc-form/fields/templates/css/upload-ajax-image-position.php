<style>
.jlc-custom-form-upload-ajax-image-position-field
{
	width:100%;
	background-image:radial-gradient(#ccc 0%,#666 120%);
	border:2px inset #666;
}

.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview
{
	overflow:hidden;
	/*padding:5%;*/
	padding-top:100%;
}

.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-upload-ajax-image-field-img-layer
{
	max-width:100%;
	width:100%;
	/*padding-bottom:56.25%;*/

	background-size:100% auto;
	background-position:50% 50%;

	position:relative;
	overflow:visible;

/* */
	position: absolute;
	top: 25%;
	left: 0%;
	width: 100%;
	height: 50%;
	background-repeat:no-repeat;
	background-size:cover;
}

.jlc-custom-form-upload-ajax-image-position-field.for-portrait .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-upload-ajax-image-field-img-layer
{
	top: 0%;
	left: 25%;
	width: 50%;
	height: 100%;
}
@media (orientation:portrait)
{
	.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-upload-ajax-image-field-img-layer
	{
		/*padding-bottom:177.78%;*/
	}
}
.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-upload-ajax-image-field-img-layer .jlc-custom-form-upload-ajax-image-field-img
{
	position:relative;
	width:100%;
	height:auto;
	opacity:.8;
}

.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-upload-ajax-image-field-img-layer .limit
{
	border:1px dashed #0f0;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
}

.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .jlc-custom-form-move-image
{
	position:absolute;

	border:none;
	background-color:rgba(50,50,50,.8);
	color:#ccc;
	text-shadow:1px 1px 0 #666;
	font-size:24px;
	padding:8px;
	line-height:1;
	border-radius:10px;
	box-shadow:1px 1px 1px 0 #ccc;
}

.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .move-left
{
	left:2px;
	top:50%;
	-webkit-transform:translate(0,-50%);
	-moz-transform:translate(0,-50%);
	-ms-transform:translate(0,-50%);
	-o-transform:translate(0,-50%);
	transform:translate(0,-50%);
}
.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .move-right
{
	right:2px;
	top:50%;
	-webkit-transform:translate(0,-50%);
	-moz-transform:translate(0,-50%);
	-ms-transform:translate(0,-50%);
	-o-transform:translate(0,-50%);
	transform:translate(0,-50%);
}
.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .move-up
{
	left:50%;
	top:2px;
	padding-left:7px;
	padding-right:9px;
	-webkit-transform:translate(-50%,0);
	-moz-transform:translate(-50%,0);
	-ms-transform:translate(-50%,0);
	-o-transform:translate(-50%,0);
	transform:translate(-50%,0);
}
.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-upload-ajax-image-field-preview .move-down
{
	left:50%;
	bottom:2px;
	padding-left:7px;
	padding-right:9px;
	-webkit-transform:translate(-50%,0);
	-moz-transform:translate(-50%,0);
	-ms-transform:translate(-50%,0);
	-o-transform:translate(-50%,0);
	transform:translate(-50%,0);
}

.jlc-custom-form-upload-ajax-image-position-field.hide-vertical-controls .move-down, .jlc-custom-form-upload-ajax-image-position-field.hide-vertical-controls .move-up
{
	display:none;
}
.jlc-custom-form-upload-ajax-image-position-field.hide-horizontal-controls .move-right, .jlc-custom-form-upload-ajax-image-position-field.hide-horizontal-controls .move-left
{
	display:none;
}
</style>
