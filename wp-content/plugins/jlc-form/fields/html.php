<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormHTMLField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormDecorationField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'decoration-field.php' );

class JLCCustomFormHTMLField extends AbstractJLCCustomFormDecorationField
{
	protected $content;
	protected $html_wrapped;
	protected $kses;

	public function __construct(
		$content,
		$html_wrapped = true,
		$kses = true,
		$id = null,
		$class = null
	) {
		parent::__construct(
			'html',
			$id,
			$class
		);

		$this->content = $content;
		$this->html_wrapped = $html_wrapped;
		$this->kses = $kses;
	}

	public function get_content()
	{
		return $this->content;
	}

	public function set_content( $content )
	{
		$this->content = $content;
	}

	public function is_html_wrapped()
	{
		return $this->html_wrapped;
	}

	public function is_kses()
	{
		return $this->kses;
	}
}

} //class_exists



