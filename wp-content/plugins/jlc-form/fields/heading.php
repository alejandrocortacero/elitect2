<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormHeadingField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormDecorationField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'decoration-field.php' );

class JLCCustomFormHeadingField extends AbstractJLCCustomFormDecorationField
{
	protected $content;
	protected $size;

	public function __construct(
		$content,
		$size = 2,
		$id = null,
		$class = null
	) {
		parent::__construct(
			'heading',
			$id,
			$class
		);

		$this->content = $content;
		$this->size = (int)$size;
	}

	public function get_content()
	{
		return $this->content;
	}

	public function get_size()
	{
		return $this->size;
	}
}

} //class_exists


