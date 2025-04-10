<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerSettingsForm' ) )
{

if( !class_exists( 'JLCAdminSettingsForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'abstract', 'admin-settings-form.php' ) ) ) );

class JLCEpointPersonalTrainerSettingsForm extends JLCAdminSettingsForm
{
	public function __construct( $internal_id, $args )
	{
		$admin_page_slug = isset( $args['admin_page_slug'] ) ? $args['admin_page_slug'] : '';
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$admin_page_slug,
			$text_domain
		);

		$this->add_heading( array( 'content' => __( 'Main options', $this->get_text_domain() ) ) );
/*
		$product_post_type = get_option( BubbleFishScoringFirm::PRODUCT_POST_TYPE_KEY );
		$product_post_field = $this->add_select(
			BubbleFishScoringFirm::PRODUCT_POST_TYPE_KEY,
			array(
				'multiple' => false,
				'label' => __( 'Product post type', $this->get_text_domain() ),
				'help' => __( 'Elements of this type will be considered as products for renting.', $this->get_text_domain() )
			)
		);
		foreach( get_post_types( array(), 'objects' ) as $type )
			$product_post_field->add_option(
				$type->name,
				$type->label,
				array(
					'selected' => ( $product_post_type == $type->name )
				)
			);

		$this->add_number_field(
			BubbleFishScoringFirm::TAX_PERCENTAGE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::TAX_PERCENTAGE_KEY ),
				'label' => __( 'Tax percentage', $this->get_text_domain() ),
				'help' => __( 'Remember to set a percentage but not include percentage sign.', $this->get_text_domain() ),
				'min' => 0,
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Deposit options', $this->get_text_domain() ) ) );

		$this->add_number_field(
			BubbleFishScoringFirm::DEPOSIT_AMOUNT_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::DEPOSIT_AMOUNT_KEY ),
				'label' => __( 'Deposit amount', $this->get_text_domain() ),
				'min' => 0,
				'step' => 0.01,
				'required' => false
			)
		);

		$this->add_number_field(
			BubbleFishScoringFirm::DEPOSIT_MINUTES_LIMIT_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::DEPOSIT_MINUTES_LIMIT_KEY ),
				'label' => __( 'Deposit time limit', $this->get_text_domain() ),
				'help' => sprintf( __( 'Set in minutes. %d by default (%d days).', $this->get_text_domain() ), BubbleFishScoringFirm::DEPOSIT_MINUTES_LIMIT_DEFAULT, BubbleFishScoringFirm::DEPOSIT_MINUTES_LIMIT_DEFAULT / 1440 ),
				'min' => 0,
				'step' => 1,
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Email addresses', $this->get_text_domain() ) ) );

		$this->add_email_field(
			BubbleFishScoringFirm::NOTIFICATION_ADDR_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::NOTIFICATION_ADDR_KEY ),
				'label' => __( 'Notification addresses', $this->get_text_domain() ),
				'separator' => ',',
				'required' => true
			)
		);

		$this->add_email_field(
			BubbleFishScoringFirm::CONTACT_EMAIL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::CONTACT_EMAIL_KEY ),
				'label' => __( 'Contact address', $this->get_text_domain() ),
				'help' => __( 'This address will be used as sender in emails for clients.', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_email_field(
			BubbleFishScoringFirm::CONTRACT_REGISTER_ADDR_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::CONTRACT_REGISTER_ADDR_KEY ),
				'label' => __( 'Contract register address', $this->get_text_domain() ),
				'help' => __( 'After sign a contract, this will be sent to this address.', $this->get_text_domain() ),
				'required' => false
			)
		);


		$this->add_heading( array( 'content' => __( 'Internal pages', $this->get_text_domain() ) ) );

		$this->add_post_select(
			BubbleFishScoringFirm::SOLICITUDE_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::SOLICITUDE_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Solicitude form page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::SCORING_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::SCORING_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Scoring form page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::FIRM_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::FIRM_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Firm form page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::DEPOSIT_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::DEPOSIT_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Deposit form page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::PERSONAL_DATA_INFO_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::PERSONAL_DATA_INFO_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Personal data info page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Equifax options', $this->get_text_domain() ) ) );

		$equifax_mode = get_option( BubbleFishScoringFirm::EQUIFAX_MODE_KEY );
		$equifax_mode_field = $this->add_select(
			BubbleFishScoringFirm::EQUIFAX_MODE_KEY,
			array(
				'multiple' => false,
				'label' => __( 'Equifax Mode', $this->get_text_domain() )
			)
		);
		$equifax_mode_field->add_option(
			'test',
			__( 'UAT (User acceptance test)', $this->get_text_domain() ),
			array(
				'selected' => ( $equifax_mode == 'test' )
			)
		);
		$equifax_mode_field->add_option(
			'production',
			__( 'Production', $this->get_text_domain() ),
			array(
				'selected' => ( $equifax_mode == 'production' )
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_USER_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_USER_KEY ),
				'label' => __( 'InterConnect user', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_PASSWORD_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_PASSWORD_KEY ),
				'label' => __( 'InterConnect password', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_ORGANIZATION_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_ORGANIZATION_KEY ),
				'label' => __( 'InterConnect organization code', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_ORCHESTRATION_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_ORCHESTRATION_KEY ),
				'label' => __( 'InterConnect orchestration code', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_CHANNEL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_CHANNEL_KEY ),
				'label' => __( 'InterConnect channel', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::EQUIFAX_FORCE_SCORING_RESULT_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::EQUIFAX_FORCE_SCORING_RESULT_KEY ),
				'label' => __( 'Force scoring result', $this->get_text_domain() ),
				'help' => __( 'Leave blank for real result, else the result will be the given character.', $this->get_text_domain() ),
				'maxlength' => 1,
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Instantor options', $this->get_text_domain() ) ) );

		$this->add_text_field(
			BubbleFishScoringFirm::INSTANTOR_SCRIPT_URL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::INSTANTOR_SCRIPT_URL_KEY ),
				'label' => __( 'Instantor script URL', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::INSTANTOR_CLIENT_ID_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::INSTANTOR_CLIENT_ID_KEY ),
				'label' => __( 'Instantor client ID', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::INSTANTOR_SYSTEM_ID_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::INSTANTOR_SYSTEM_ID_KEY ),
				'label' => __( 'Instantor system ID', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Signaturit options', $this->get_text_domain() ) ) );

		$this->add_text_field(
			BubbleFishScoringFirm::SIGNATURIT_TOKEN_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::SIGNATURIT_TOKEN_KEY ),
				'label' => __( 'Signaturit token', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_checkbox_field(
			BubbleFishScoringFirm::SIGNATURIT_PRODUCTION_KEY,
			array(
				'value' => 'yes',
				'label' => __( 'Use Signaturit in production mode', $this->get_text_domain() ),
				'checked' => get_option( BubbleFishScoringFirm::SIGNATURIT_PRODUCTION_KEY ) === 'yes'
			)
		);

		$delivery_type = get_option( BubbleFishScoringFirm::SIGNATURIT_DELIVERY_TYPE_KEY );
		$delivery_type_field = $this->add_select(
			BubbleFishScoringFirm::SIGNATURIT_DELIVERY_TYPE_KEY,
			array(
				'multiple' => false,
				'label' => __( 'Signature delivery type', $this->get_text_domain() )
			)
		);

		foreach( BubbleFishScoringFirm::get_signature_delivery_types_array() as $value => $label )
			$delivery_type_field->add_option(
				$value,
				$label,
				array(
					'selected' => ( $delivery_type == $value )
				)
			);

		$this->add_post_select(
			BubbleFishScoringFirm::SIGNATURIT_CALLBACK_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::SIGNATURIT_CALLBACK_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Signaturit callback page', $this->get_text_domain() ),
				'help' => __( 'Signaturit will redirect the client to this page after sign the contract. None to no redirect.' ),
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::SIGNATURIT_EVENTS_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::SIGNATURIT_EVENTS_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Signaturit events page', $this->get_text_domain() ),
				'help' => __( 'Signaturit will send events to this page.' ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::SIGNATURIT_TEMPLATE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::SIGNATURIT_TEMPLATE_KEY ),
				'label' => __( 'Signaturit document template', $this->get_text_domain() ),
				'required' => false
			)
		);
		
		$this->add_text_field(
			BubbleFishScoringFirm::SIGNATURIT_SUBJECT_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::SIGNATURIT_SUBJECT_KEY ),
				'label' => __( 'Signaturit mail subject', $this->get_text_domain() ),
				'required' => false
			)
		);
		
		$this->add_textarea_field(
			BubbleFishScoringFirm::SIGNATURIT_BODY_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::SIGNATURIT_BODY_KEY ),
				'label' => __( 'Signaturit mail body', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_checkbox_field(
			BubbleFishScoringFirm::SIGNATURIT_REQUIRE_SMS_VALIDATION_KEY,
			array(
				'value' => 'yes',
				'label' => __( 'Enable a password in the document that will be sent as an SMS.', $this->get_text_domain() ),
				'checked' => get_option( BubbleFishScoringFirm::SIGNATURIT_REQUIRE_SMS_VALIDATION_KEY ) === 'yes'
			)
		);

		$this->add_checkbox_field(
			BubbleFishScoringFirm::SIGNATURIT_SMS_CODE_KEY,
			array(
				'value' => 'yes',
				'label' => __( 'Enable a code acceptance that will be sent as an SMS.', $this->get_text_domain() ),
				'checked' => get_option( BubbleFishScoringFirm::SIGNATURIT_SMS_CODE_KEY ) === 'yes'
			)
		);


		$this->add_text_field(
			BubbleFishScoringFirm::UPLOADED_DOCUMENTS_PATH_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::UPLOADED_DOCUMENTS_PATH_KEY ),
				'label' => __( 'Uploaded documents path', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Commercializer data', $this->get_text_domain() ) ) );

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_NAME_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_NAME_KEY ),
				'label' => __( 'Company name', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_CIF_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_CIF_KEY ),
				'label' => __( 'CIF', $this->get_text_domain() ),
				'maxlength' => 9,
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_PHONE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_PHONE_KEY ),
				'label' => __( 'Phone', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_email_field(
			BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_MAIL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_MAIL_KEY ),
				'label' => __( 'Mail', $this->get_text_domain() ),
				'multiple' => false,
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_WEB_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_COMPANY_WEB_KEY ),
				'label' => __( 'Web', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_STREET_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_STREET_KEY ),
				'label' => __( 'Address', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_NUMBER_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_NUMBER_KEY ),
				'label' => __( 'Number', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_FLOOR_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_FLOOR_KEY ),
				'label' => __( 'Floor', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_DOOR_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_DOOR_KEY ),
				'label' => __( 'Door', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_POSTCODE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_POSTCODE_KEY ),
				'label' => __( 'Postcode', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_CITY_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_CITY_KEY ),
				'label' => __( 'City', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COMMERCIALIZER_ADDR_STATE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COMMERCIALIZER_ADDR_STATE_KEY ),
				'label' => __( 'State / Province', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Contract code', $this->get_text_domain() ) ) );

		$this->add_text_field(
			BubbleFishScoringFirm::CONTRACT_COMPANY_ID_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::CONTRACT_COMPANY_ID_KEY ),
				'label' => __( 'Company ID', $this->get_text_domain() ),
				'maxlength' => 1,
				'help' => __( 'A single digit', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_number_field(
			BubbleFishScoringFirm::CONTRACT_START_FROM_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::CONTRACT_START_FROM_KEY ),
				'label' => __( 'Contract number start from:', $this->get_text_domain() ),
				'min' => 0,
				'max' => 999998,
				'step' => 1,
				'help' => __( 'Useful if the database has been reset. In this case set the last contract number plus 1, else set 0.', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Redsys', $this->get_text_domain() ) ) );

		$redsys_api_ver = get_option( BubbleFishScoringFirm::REDSYS_API_VERSION_KEY );
		$redsys_api_field = $this->add_select(
			BubbleFishScoringFirm::REDSYS_API_VERSION_KEY,
			array(
				'multiple' => false,
				'label' => __( 'API Version', $this->get_text_domain() )
			)
		);
		foreach( array( '4.0.2', '5.2.0', '7.0.0' ) as $version )
			$redsys_api_field->add_option(
				$version,
				$version,
				array(
					'selected' => ( $redsys_api_ver == $version )
				)
			);

		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_TEST_URL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_TEST_URL_KEY, BubbleFishScoringFirm::REDSYS_TEST_URL_DEFAULT ),
				'label' => __( 'Test URL', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_PRODUCTION_URL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_PRODUCTION_URL_KEY, BubbleFishScoringFirm::REDSYS_PRODUCTION_URL_DEFAULT ),
				'label' => __( 'Production URL', $this->get_text_domain() ),
				'required' => false
			)
		);

		$redsys_mode = get_option( BubbleFishScoringFirm::REDSYS_MODE_KEY );
		$redsys_mode_field = $this->add_select(
			BubbleFishScoringFirm::REDSYS_MODE_KEY,
			array(
				'multiple' => false,
				'label' => __( 'Mode', $this->get_text_domain() )
			)
		);
		$redsys_mode_field->add_option(
			'test',
			__( 'Test', $this->get_text_domain() ),
			array(
				'selected' => ( $redsys_mode == 'test' )
			)
		);
		$redsys_mode_field->add_option(
			'production',
			__( 'Production', $this->get_text_domain() ),
			array(
				'selected' => ( $redsys_mode == 'production' )
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_MERCHANT_CODE_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_MERCHANT_CODE_KEY ),
				'label' => __( 'Merchant identifier (FUC code)', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_MerchantCode',
				'maxlength' => 9,
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_TERMINAL_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_TERMINAL_KEY ),
				'label' => __( 'Terminal number', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_Terminal',
				'maxlenght' => 3,
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_CURRENCY_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_CURRENCY_KEY ),
				'label' => __( 'Currency', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_Currency (' . __( '978 for euros.', $this->get_text_domain() ) . ')',
				'maxlength' => 4,
				'required' => false
			)
		);
		
		$this->add_post_select(
			BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Online notification page', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_MerchantURL',
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_OK_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_OK_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Callbak OK page', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_MerchantUrlOK',
				'required' => false
			)
		);

		$this->add_post_select(
			BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_KO_KEY,
			array(
				'preselected' => get_option( BubbleFishScoringFirm::REDSYS_MERCHANT_PAGE_KO_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'help' => 'Ds_Merchant_MerchantUrlKO',
				'label' => __( 'Callbak KO page', $this->get_text_domain() ),
				'required' => false
			)
		);
		
		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_MERCHANT_NAME_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_MERCHANT_NAME_KEY ),
				'label' => __( 'Merchant name', $this->get_text_domain() ),
				'help' => 'Ds_Merchant_MerchantName',
				'required' => false
			)
		);
		
		$this->add_text_field(
			BubbleFishScoringFirm::REDSYS_SECRET_ENCRIPTION_KEY_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::REDSYS_SECRET_ENCRIPTION_KEY_KEY ),
				'label' => __( 'Secret encription key', $this->get_text_domain() ),
				'required' => false
			)
		);


		$this->add_heading( array( 'content' => __( 'Other options', $this->get_text_domain() ) ) );

		$this->add_text_field(
			BubbleFishScoringFirm::COUNTRY_NAME_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COUNTRY_NAME_KEY ),
				'label' => __( 'Country name', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			BubbleFishScoringFirm::COUNTRY_PHONE_PREFIX_KEY,
			array(
				'value' => get_option( BubbleFishScoringFirm::COUNTRY_PHONE_PREFIX_KEY ),
				'label' => __( 'Country phone prefix', $this->get_text_domain() ),
				'help' => __( 'Only numbers. Do not include plus symbol (+).', $this->get_text_domain() ),
				'required' => false
			)
		);
*/
		$this->add_submit_button(
			'save',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function process_form()
	{
		$ret = parent::process_form();
		flush_rewrite_rules();

		return $ret;
	}
}

} //class_exists

