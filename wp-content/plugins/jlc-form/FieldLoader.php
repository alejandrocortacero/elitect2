<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormFieldLoader', false ) )
{

class JLCCustomFormFieldLoader
{
	public static function get_hidden_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormHiddenField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'hidden.php' ) ) );

		return new JLCCustomFormHiddenField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_text_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTextField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'text.php' ) ) );

		return new JLCCustomFormTextField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['maxlength'] ) ? $args['maxlength'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_password_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormPasswordField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'password.php' ) ) );

		return new JLCCustomFormPasswordField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['maxlength'] ) ? $args['maxlength'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_number_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormNumberField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'number.php' ) ) );

		return new JLCCustomFormNumberField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['max'] ) ? $args['max'] : false,
			isset( $args['min'] ) ? $args['min'] : false,
			isset( $args['step'] ) ? $args['step'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_stars_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormStarsField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'stars.php' ) ) );

		return new JLCCustomFormStarsField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['stars'] ) ? $args['stars'] : 5,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_color_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormColorField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'color.php' ) ) );

		return new JLCCustomFormColorField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	/**
	 * The method assumes address max length in 254 by default,
	 * but class constructor assumes 100 (wordpress user email lenght).
	 * This fact implies that the wordpress limit must be specified
	 * if it is requried.
	 */
	public static function get_email_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormEmailField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'email.php' ) ) );

		return new JLCCustomFormEmailField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['separator'] ) ? $args['separator'] : null,
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['maxlength'] ) ? $args['maxlength'] : 254,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_date_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormDateField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'date.php' ) ) );

		return new JLCCustomFormDateField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['max'] ) ? $args['max'] : false,
			isset( $args['min'] ) ? $args['min'] : false,
			isset( $args['step'] ) ? $args['step'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_time_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTimeField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'time.php' ) ) );

		return new JLCCustomFormTimeField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['max'] ) ? $args['max'] : false,
			isset( $args['min'] ) ? $args['min'] : false,
			isset( $args['step'] ) ? $args['step'] : false,
			isset( $args['compatible'] ) ? $args['compatible'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_calendar_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormCalendarField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'calendar.php' ) ) );

		return new JLCCustomFormCalendarField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['calendar_args'] ) ? $args['calendar_args'] : array(),
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_textarea_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTextareaField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'textarea.php' ) ) );

		return new JLCCustomFormTextareaField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['rows'] ) ? $args['rows'] : null,
			isset( $args['cols'] ) ? $args['cols'] : null,
			isset( $args['wrap'] ) ? $args['wrap'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['maxlength'] ) ? $args['maxlength'] : false,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_wp_editor_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormWPEditorField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'wp-editor.php' ) ) );

		return new JLCCustomFormWPEditorField(
			$name,
			isset( $args['editor_args'] ) ? $args['editor_args'] : array(),
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_tinymce_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTinymceField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'tinymce.php' ) ) );

		return new JLCCustomFormTinymceField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_checkbox_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormCheckboxField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'checkbox.php' ) ) );

		return new JLCCustomFormCheckboxField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['checked'] ) ? $args['checked'] : false,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_checkbox_group( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormCheckboxGroup' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'checkbox-group.php' ) ) );

		return new JLCCustomFormCheckboxGroup(
			$name,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['options'] ) ? $args['options'] : array(),
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null
		);
	}

	public static function get_radio_group( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormRadiobuttonsGroup' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'radiobutton-group.php' ) ) );

		return new JLCCustomFormRadiobuttonsGroup(
			$name,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['options'] ) ? $args['options'] : array(),
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null
		);
	}

	public static function get_yes_no_radio_group( $name, $args = array() )
	{
		$field = self::get_radio_group( $name, $args );

		if( isset( $args['value'] ) )
			$is_yes = $args['value'] == 'yes' || $args['value'] == true;
		else
			$is_yes = null;

		$field->add_radiobutton( array(
			'value' => 'yes',
			'label' => __( 'Yes', JLCCustomForm::TEXT_DOMAIN ),
			'required' => !empty( $args['required'] ),
			'checked' => $is_yes !== null && $is_yes
		) );
		$field->add_radiobutton( array(
			'value' => 'no',
			'label' => __( 'No', JLCCustomForm::TEXT_DOMAIN ),
			'required' => !empty( $args['required'] ),
			'checked' => $is_yes !== null && !$is_yes
		) );

		return $field;
	}

	

	public static function get_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'select.php' ) ) );

		return new JLCCustomFormSelectField(
			$name,
			isset( $args['options'] ) ? $args['options'] : array(),
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['allows_new_options'] ) ? $args['allows_new_options'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_user_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormUserSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'user-select.php' ) ) );

		return new JLCCustomFormUserSelectField(
			$name,
			isset( $args['preselected'] ) ? $args['preselected'] : array(),
			isset( $args['query_args'] ) ? $args['query_args'] : array(),
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_post_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormPostSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'post-select.php' ) ) );

		return new JLCCustomFormPostSelectField(
			$name,
			isset( $args['preselected'] ) ? $args['preselected'] : array(),
			isset( $args['query_args'] ) ? $args['query_args'] : array(),
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_term_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTermSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'term-select.php' ) ) );

		return new JLCCustomFormTermSelectField(
			$name,
			isset( $args['preselected'] ) ? $args['preselected'] : array(),
			isset( $args['query_args'] ) ? $args['query_args'] : array(),
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_font_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormFontSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'font-select.php' ) ) );

		return new JLCCustomFormFontSelectField(
			$name,
			isset( $args['options'] ) ? $args['options'] : array(),
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}
	
	public static function get_multi_contact_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormMultiContactField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'multi-contact.php' ) ) );

		return new JLCCustomFormMultiContactField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_submit_button( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSubmitButton' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'submit_button.php' ) ) );

		return new JLCCustomFormSubmitButton(
			$name,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false
		);
	}

	public static function get_save_and_add_buttons( $name = 'save', $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSaveAndAddButtons' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'save-and-add-buttons.php' ) ) );

		return new JLCCustomFormSaveAndAddButtons(
			$name,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false
		);
	}

	public static function get_ajax_upload_image_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormUploadAjaxImageField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'upload-ajax-image.php' ) ) );

		return new JLCCustomFormUploadAjaxImageField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_ajax_upload_image_position_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormUploadAjaxImagePositionField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'upload-ajax-image-position.php' ) ) );

		return new JLCCustomFormUploadAjaxImagePositionField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_ajax_upload_image_multiple_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormUploadAjaxImageMultipleField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'upload-ajax-image-multiple.php' ) ) );

		return new JLCCustomFormUploadAjaxImageMultipleField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['total_max_size'] ) ? $args['total_max_size'] : null,
			isset( $args['max_images_number'] ) ? $args['max_images_number'] : null,
			isset( $args['min_images_number'] ) ? $args['min_images_number'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_ajax_upload_image_cropper_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormUploadAjaxImageCropperField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'upload-ajax-image-cropper.php' ) ) );

		return new JLCCustomFormUploadAjaxImageCropperField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	// TODO: Revisa este método al completo
	public static function get_upload_image_field( $name, $value, $label = "", $placeholder = "",  $required = false, $disabled = false, $readonly = false )
	{
		return new JLCCustomFormField( $value, 'upload_image', $label, $placeholder, $required, $disabled, $readonly );
	}

	public static function get_upload_field( $name, $args )
	{
		if( !class_exists( 'JLCCustomFormFileField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'file.php' ) ) );

		return new JLCCustomFormFileField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
		
	}

	public static function get_upload_private_image_field( $name, $args )
	{
		if( !class_exists( 'JLCCustomFormUploadPrivateImageField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'upload-private-image.php' ) ) );

		return new JLCCustomFormUploadPrivateImageField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['max_size'] ) ? $args['max_size'] : null,
			isset( $args['allowed_extensions'] ) ? $args['allowed_extensions'] : null,
			isset( $args['allowed_mime_types'] ) ? $args['allowed_mime_types'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
		
	}

	public static function get_audio_recorder_field( $name, $args )
	{
		if( !class_exists( 'JLCCustomFormAudioRecorderField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'audio-recorder.php' ) ) );

		return new JLCCustomFormAudioRecorderField(
			$name,
			isset( $args['value'] ) ? $args['value'] : "",
			isset( $args['label'] ) ? $args['label'] : "",
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_google_captcha()
	{
		if( !class_exists( 'JLCCustomFormGoogleCaptchaField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'google-captcha.php' ) ) );

		return new JLCCustomFormGoogleCaptchaField();
	}

	public static function get_honeypot( $name = 'wp_source_info' )
	{
		if( !class_exists( 'JLCCustomFormHoneypotField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'honeypot.php' ) ) );

		return new JLCCustomFormHoneypotField( $name );
	}

	public static function get_jquery_slider( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormJquerySliderField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'jquery-slider.php' ) ) );

		return new JLCCustomFormJquerySliderField(
			$name,
			isset( $args['value'] ) ? $args['value'] : 0,
			isset( $args['min'] ) ? $args['min'] : 0,
			isset( $args['max'] ) ? $args['max'] : 100,
			isset( $args['step'] ) ? $args['step'] : 1,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_jquery_range_slider( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormJqueryRangeSliderField', false ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'jquery-range-slider.php' ) ) );

		return new JLCCustomFormJqueryRangeSliderField(
			$name,
			isset( $args['min_value'] ) ? $args['min_value'] : 0,
			isset( $args['max_value'] ) ? $args['max_value'] : 0,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['max'] ) ? $args['max'] : 100,
			isset( $args['min'] ) ? $args['min'] : 0,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_country_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormCountrySelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'country-select.php' ) ) );

		return new JLCCustomFormCountrySelectField(
			$name,
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_dni_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormDNIField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'dni.php' ) ) );

		return new JLCCustomFormDNIField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_nif_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormNIFField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'nif.php' ) ) );

		return new JLCCustomFormNIFField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['placeholder'] ) ? $args['placeholder'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_spanish_province_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSpanishProvinceSelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'spanish-province-select.php' ) ) );

		return new JLCCustomFormSpanishProvinceSelectField(
			$name,
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_spanish_city_select( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSpanishCitySelectField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'spanish-city-select.php' ) ) );

		return new JLCCustomFormSpanishCitySelectField(
			$name,
			isset( $args['multiple'] ) ? $args['multiple'] : false,
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_iban_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormIBANField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'iban.php' ) ) );

		return new JLCCustomFormIBANField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['country'] ) ? $args['country'] : null,
			isset( $args['single_field'] ) ? $args['single_field'] : false,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_background_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormBackgroundField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'background.php' ) ) );

		return new JLCCustomFormBackgroundField(
			$name,
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['opacity_field_type'] ) ? $args['opacity_field_type'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		);
	}

	public static function get_fields_array( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormFieldsArray' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'array.php' ) ) );

		return new JLCCustomFormFieldsArray(
			$name,
			isset( $args['printable'] ) ? $args['printable'] : true
		);
	}

	public static function get_table_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTableField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'table.php' ) ) );

		return new JLCCustomFormTableField(
			$name,
			isset( $args['cols'] ) ? $args['cols'] : array(),
			isset( $args['rows'] ) ? $args['rows'] : array(),
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['col_labels'] ) ? $args['col_labels'] : array(),
			isset( $args['format'] ) ? $args['format'] : 'sheet',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['disabled'] ) ? $args['disabled'] : null,
			isset( $args['readonly'] ) ? $args['readonly'] : null,
			isset( $args['attributes'] ) ? $args['attributes'] : array()
		);
	}

	public static function get_table_variable_field( $name, $args = array() )
	{
		if( !class_exists( 'JLCCustomFormTableVariableField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'table-variable.php' ) ) );

		return new JLCCustomFormTableVariableField(
			$name,
			isset( $args['cols'] ) ? $args['cols'] : array(),
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['col_labels'] ) ? $args['col_labels'] : array(),
			isset( $args['format'] ) ? $args['format'] : 'sheet',
			isset( $args['help'] ) ? $args['help'] : null,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['disabled'] ) ? $args['disabled'] : null,
			isset( $args['readonly'] ) ? $args['readonly'] : null,
			isset( $args['attributes'] ) ? $args['attributes'] : array()
		);
	}

	public static function get_separator( $args = array() )
	{
		if( !class_exists( 'JLCCustomFormSeparatorField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'separator.php' ) ) );

		return new JLCCustomFormSeparatorField(
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null
		);
	}

	public static function get_heading( $args = array() )
	{
		if( !class_exists( 'JLCCustomFormHeadingField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'heading.php' ) ) );

		return new JLCCustomFormHeadingField(
			isset( $args['content'] ) ? $args['content'] : '',
			isset( $args['size'] ) ? (int)$args['size'] : 2,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null
		);
	}

	public static function get_html( $args = array() )
	{
		if( !class_exists( 'JLCCustomFormHTMLField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'html.php' ) ) );

		return new JLCCustomFormHTMLField(
			isset( $args['content'] ) ? $args['content'] : '',
			isset( $args['html_wrapped'] ) ? $args['html_wrapped'] : true,
			isset( $args['kses'] ) ? $args['kses'] : true,
			isset( $args['id'] ) ? $args['id'] : null,
			isset( $args['class'] ) ? $args['class'] : null
		);
	}
}

} // class_exists
