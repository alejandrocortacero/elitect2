<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSearchForm' ) )
{

if( !class_exists( 'JLCCustomForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'form.php' ) ) ) );

abstract class JLCSearchForm extends JLCCustomForm
{
	// use id selector. Eg: #my-selector
	protected $css_selector;

	public function __construct(
		$base_dir,
		$internal_id,
		$action,
		$private,
		$css_selector,
		$label = null,
		$placeholder = null,
		$text_domain = null,
		$id = null,
		$class = null
	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$action,
			true,//$ajax,
			true,//$wordpress_method,
			null,//$return_url,
			$private,
			null,//$enctype,
			null,//$method,
			$id,
			$class,
			null//$transient_time
		);

		$this->add_class( 'jlc-search-form' );
		$this->add_attribute( 'data-css-selector', $css_selector );

		$this->css_selector = $css_selector;

		$this->add_text_field(
			'jlcsearchfield',
			array(
				'required' => false,
				'label' => $label !== null ? $label : __( 'Search', $this->get_text_domain() ),
				'placeholder' => $placeholder
			)
		);
	}

	protected abstract function search_results( $s );
	protected abstract function results_to_html( $results );

	protected function enqueue_scripts()
	{
		$jlc_form_file = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'jlc-form.php' ) ) );
		wp_enqueue_script(
			'jlc-custom-form-search-form-script',
			plugins_url( '/templates/js/search-form.js', $jlc_form_file ),
			array( 'jquery', 'jlc-custom-form-global-ajax-js' ),
			self::VERSION,
			true
		);
/*
		wp_localize_script(
			'jlc-custom-form-search-form-script',
			'JLCSearchFormNS',
			array(
				'adminUrl' => admin_url( 'admin-ajax.php' )
			)
		);
*/
		wp_enqueue_style(
			'jlc-custom-form-search-form-style',
			plugins_url( '/templates/css/search-form.css', $jlc_form_file ),
			array(),
			self::VERSION
		);
	}

	protected function get_id_attr_from_selector( $css_selector )
	{
		$id_attr = '';
		if( ($pos = mb_strpos( $css_selector, '#' )) !== false )
			$id_attr = mb_substr( $css_selector, $pos + 1 );

		if( ($pos = mb_strpos( $id_attr, ',' )) !== false )
			$id_attr = mb_substr( $id_attr, 0, $pos );

		return $id_attr;
	}

	protected function print_public_results_container()
	{
		$id_attr = $this->get_id_attr_from_selector( $this->css_selector );
		$content = $this->get_default_results_container_content();

		include( $this->look_for_file( 'search-form-public-results-container.php' ) );
	}

	protected function print_admin_results_container()
	{
		$id_attr = $this->get_id_attr_from_selector( $this->css_selector );
		$content = $this->get_default_results_container_content();

		include( $this->look_for_file( 'search-form-admin-results-container.php' ) );
	}

	protected function get_default_results_container_content()
	{
		$results = $this->search_results( '' );

		return $this->results_to_html( $results );
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );

		$this->enqueue_scripts();
	}

	public function print_public_form_closing()
	{
		$this->print_public_results_container();
		parent::print_public_form_closing();
	}

	public function print_admin_form( $readonly_form = false )
	{
		parent::print_admin_form( $readonly_form );

		$this->enqueue_scripts();
	}

	public function print_admin_form_closing()
	{
		$this->print_admin_results_container();
		parent::print_admin_form_closing();
	}

	public function process_form()
	{
		$s = $this->get_field_by_name( 'jlcsearchfield' )->get_value();

		$results = $this->search_results( $s );

		$response_html = $this->results_to_html( $results );

		$response = new WP_Ajax_Response( array(
			'what' => 'html',
			'action' => 'refreshSearchResults',
			'id' => 1,
			'data' => $response_html
		) );
		$response->send();
	}
}

} // class_exists


