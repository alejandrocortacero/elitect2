<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

//require_once(  __DIR__ . '/mapper.php' );

class EpointPersonalTrainerImportJoomlaObject
{
	protected static $instance;

	protected $db;
	protected $prefix;
	protected $image_base_url;

	public static function get_instance()
	{
		if( empty( self::$instance ) )
			self::$instance = new EpointPersonalTrainerImportJoomlaObject();

		return self::$instance;
	}

	protected function __construct()
	{
		try
		{
            $this->db = new wpdb(
				'usrtraining',
				'iDkolePd18dE3D',
				'training_web',
				'vl20216.dinaserver.com'
			);
            //$this->db->show_errors(); // Debug

			$this->prefix = 'jlmep_';

			$this->image_base_url = 'https://www.eliteclubtraining.com/';
        }
		catch (Exception $e)
		{
            $this->db = null;
        }
	}

	public function is_working()
	{
		return $this->db !== null;
	}

	public function get_food()
	{
		$table_name = $this->prefix . 'personaltrainer_alimentos';
		$cat_table = $this->prefix . 'categories';
		return $this->db->get_results( "SELECT al.*, ca.title AS cat_title FROM $table_name al INNER JOIN $cat_table ca ON al.catid = ca.id" );
	}

	public function get_food_categories()
	{
		$table_name = $this->prefix . 'categories';
		return $this->db->get_results( "SELECT * FROM $table_name" );
	}

	public function get_exercises()
	{
		$table_name = $this->prefix . 'personaltrainer_ejercicios';
		$cat_table = $this->prefix . 'categories';
		return $this->db->get_results( "SELECT ej.*, ca.title AS cat_title FROM $table_name ej INNER JOIN $cat_table ca ON ej.catid = ca.id" );
	}

	public function get_diets()
	{
		$table_name = $this->prefix . 'personaltrainer_dietas';
		return $this->db->get_results( "SELECT * FROM $table_name" );
	}

	public function get_user_habits()
	{
		$table_name = $this->prefix . 'personaltrainer_habitos_socio';
		return $this->db->get_results( "SELECT * FROM $table_name" );
	}

	public function get_user_food()
	{
		$table_name = $this->prefix . 'personaltrainer_alimentos_socio';
		return $this->db->get_results( "SELECT * FROM $table_name" );
	}

	public function print_admin_page()
	{
		if( isset( $_GET['action'] ) )
		{
			if( 'food' === $_GET['action'] )
			{
				$this->print_food_page();
				return;
			}
			elseif( 'import-food' == $_GET['action'] )
			{
				$this->print_import_food_page();
				return;
			}
			elseif( 'diets' === $_GET['action'] )
			{
				$this->print_diets_page();
				return;
			}
			elseif( 'import-diets' == $_GET['action'] )
			{
				$this->print_import_diets_page();
				return;
			}
			elseif( 'exercises' === $_GET['action'] )
			{
				$this->print_exercises_page();
				return;
			}
			elseif( 'import-exercises' == $_GET['action'] )
			{
				$this->print_import_exercises_page();
				return;
			}
		}

		$file = realpath( __DIR__ . '/../templates/import-joomla/main.php' );
		$page_slug = admin_url( 'admin.php?page=' . EpointPersonalTrainerAdmin::ADMIN_IMPORT_PAGE_SLUG );

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		include( $file );
	}

	protected function print_food_page()
	{
		$page_slug = admin_url( 'admin.php?page=' . EpointPersonalTrainerAdmin::ADMIN_IMPORT_PAGE_SLUG );
		$file = realpath( __DIR__ . '/../templates/import-joomla/food.php' );

		$food = $this->get_food();
/*
		foreach( $food as $food_item )
		{
			echo '<hr />';
			echo var_export( $food_item, true );
//			echo var_export( unserialize( base64_decode( $diet->indicaciones ) ), true );
			//echo '<hr />';
		}
*/

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		include( $file );
	}

	protected function print_import_food_page()
	{
		ini_set('max_execution_time', 0);

		$file = realpath( __DIR__ . '/../templates/import-joomla/import-food.php' );

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		$food = $this->get_food();
		$results = array();
		$last_position = null;
		$last_cat_position = null;

		$created_categories = array();
		$failed_categories = array();
		$omitted_categories = array();

		foreach( $food as $food_item )
		{
			$category = EpointPersonalTrainerMapper::get_food_category_by_name( $food_item->cat_title );
			$cat_id = null;
			if( empty( $category ) )
			{
				if( $last_cat_position )
				{
					$last_category = EpointPersonalTrainerMapper::get_last_food_category();
					$last_cat_position = $last_category ? $last_category->position : 1;
				}

				$cat_id = EpointPersonalTrainerMapper::create_food_category( $food_item->cat_title, $last_cat_position++, true );
				if( $cat_id )
					$created_categories[$cat_id] = $food_item->cat_title;
				else
					$failed_categories[] = $food_item->cat_title;	
			}
			else
			{
				if( !in_array( $food_item->cat_title, $omitted_categories ) )
					$omitted_categories[] = $food_item->cat_title;	

				$cat_id = $category->ID;
			}

			if( $last_position === null )
			{
				$last_food = EpointPersonalTrainerMapper::get_last_food();
				$last_position = $last_food ? $last_food->position : 1;
			}



			$results[(int)$food_item->id] = EpointPersonalTrainerMapper::create_food(
				$food_item->nombre,
				$last_position++,
				$food_item->activo,
				$cat_id ? array( $cat_id ) : array()
			);

		}

		include( $file );
	}

	protected function print_diets_page()
	{
		$page_slug = admin_url( 'admin.php?page=' . EpointPersonalTrainerAdmin::ADMIN_IMPORT_PAGE_SLUG );
		$file = realpath( __DIR__ . '/../templates/import-joomla/diets.php' );

		$diets = $this->get_diets();
/*
		foreach( $diets as $diet )
		{
			echo var_export( $diet, true );
			echo '<hr />';
			echo var_export( unserialize( base64_decode( $diet->indicaciones ) ), true );
			echo '<hr />';
		}
*/
		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		include( $file );
	}

	protected function print_import_diets_page()
	{
		ini_set('max_execution_time', 0);

		$file = realpath( __DIR__ . '/../templates/import-joomla/import-diets.php' );

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		$diets = $this->get_diets();
		$results = array();
		$last_position = null;
		foreach( $diets as $diet )
		{
//echo '<hr />Diet: ' . $diet->id . '</hr>';
			if( $last_position === null )
			{
				$last_diet = EpointPersonalTrainerMapper::get_last_diet();
				$last_position = $last_diet ? $last_diet->position : 1;
			}

			$interval_data = unserialize( base64_decode( $diet->indicaciones ) );
			$intervals = array();
			if( is_array( $interval_data ) )
			{
				foreach( $interval_data as $key => $val )
				{
					if( !empty( $val ) )
					{
						$matches = array();
		//echo '<br />'. var_export( $key );		
						if( preg_match( '/^(\d\d)-00$/', $key, $matches ) )
						{
							$interval_id = (int)$matches[1];
							$interval = array(
								'description' => $val,
								'food' => array()
							);
							$intervals[$interval_id] = $interval;
						}
					}
				}
			}
//echo '<hr />';
//var_dump( $intervals );


			$results[(int)$diet->id] = EpointPersonalTrainerMapper::create_diet(
				$diet->nombre,
				$last_position++,
				$diet->activo,
				null,
				null,
				null,
				null,
				$intervals
			);

		}

		include( $file );
	}

	protected function print_exercises_page()
	{
		$page_slug = admin_url( 'admin.php?page=' . EpointPersonalTrainerAdmin::ADMIN_IMPORT_PAGE_SLUG );
		$file = realpath( __DIR__ . '/../templates/import-joomla/exercises.php' );

		$exercises = $this->get_exercises();
/*
		foreach( $exercises as $exercise )
		{
			echo '<hr />';
			echo var_export( $exercise, true );
			//echo var_export( unserialize( base64_decode( $exercise->correcciones ) ), true );
			//echo '<hr />';
		}
*/
		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		include( $file );
	}

	protected function print_import_exercises_page()
	{
		ini_set('max_execution_time', 0);

		$file = realpath( __DIR__ . '/../templates/import-joomla/import-exercises.php' );

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
			return;
		}

		$exercises = $this->get_exercises();
		$results = array();
		$last_position = null;
		$last_cat_position = null;

		$created_categories = array();
		$failed_categories = array();
		$omitted_categories = array();

		foreach( $exercises as $exercise )
		{
			if( !EpointPersonalTrainerMapper::get_exercise_by_name( trim( $exercise->nombre ) ) )
			{
				$category = EpointPersonalTrainerMapper::get_exercise_category_by_name( $exercise->cat_title );
				$cat_id = null;
				if( empty( $category ) )
				{
					if( $last_cat_position )
					{
						$last_category = EpointPersonalTrainerMapper::get_last_exercise_category();
						$last_cat_position = $last_category ? $last_category->position : 1;
					}

					$cat_id = EpointPersonalTrainerMapper::create_exercise_category( $exercise->cat_title, $last_cat_position++, true );
					if( $cat_id )
						$created_categories[$cat_id] = $exercise->cat_title;
					else
						$failed_categories[] = $exercise->cat_title;	
				}
				else
				{
					if( !in_array( $exercise->cat_title, $omitted_categories ) )
						$omitted_categories[] = $exercise->cat_title;	

					$cat_id = $category->ID;
				}

				if( $last_position === null )
				{
					$last_exercise = EpointPersonalTrainerMapper::get_last_exercise();
					$last_position = $last_exercise ? $last_exercise->position : 1;
				}

				$image_start = null;
				$image_end = null;
				if( !empty( $exercise->imagen1 ) )
				{
					$download = $this->download_image( $this->image_base_url . $exercise->imagen1 );
					if( $download )
					{
						$image_start = $this->create_attachment( $download );//, 0, false );
					}
				}
				if( !empty( $exercise->imagen2 ) )
				{
					$download = $this->download_image( $this->image_base_url . $exercise->imagen2 );
					if( $download )
					{
						$image_end = $this->create_attachment( $download );//, 0, false );
					}
				}

				$corrections = array();
				$pos = 1;
				$image1 = null;
				$image2 = null;
				$corr_data = unserialize( base64_decode( $exercise->correcciones ) );
				if( is_array( $corr_data ) )
				{
					foreach( $corr_data as $correction )
					{
						if( !empty( $correction['imagen1'] ) )
						{
							$download = $this->download_image( $this->image_base_url . $correction['imagen1'] );
							if( $download )
							{
								$image1 = $this->create_attachment( $download );//, 0, false );
							}
						}

						if( !empty( $correction['imagen2'] ) )
						{
							$download = $this->download_image( $this->image_base_url . $correction['imagen2'] );
							if( $download )
							{
								$image2 = $this->create_attachment( $download );//, 0, false );
							}
						}

						$corrections[] = array(
							'description' => isset( $correction['desc'] ) && is_string( $correction['desc'] ) ? $correction['desc'] : '',
							'position' => $pos++,
							'active' => 1,
							'image_well' => $image1,
							'image_bad' => $image2
						);
					}
				}

				$results[(int)$exercise->id] = EpointPersonalTrainerMapper::create_exercise(
					trim( $exercise->nombre ),
					$last_position++,
					$exercise->activo,
					$exercise->descripcion,
					$exercise->video,
					$image_start,
					$image_end,
					$cat_id ? array( $cat_id ) : array(),
					$corrections
					//trainer = null
				);

			}

		}

		include( $file );
	}

    protected function curl_get_headers($url)
	{
	  $ch = curl_init($url);
	  curl_setopt( $ch, CURLOPT_NOBODY, true );
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	  curl_setopt( $ch, CURLOPT_HEADER, false );
	  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	  curl_setopt( $ch, CURLOPT_MAXREDIRS, 3 );
	  curl_exec( $ch );
	  $headers = curl_getinfo( $ch );
	  curl_close( $ch );

	  return $headers;
	}

	protected function curl_download($url, $path)
	{
	  # open file to write
	  $fp = fopen ($path, 'w+');
	  # start curl
	  $ch = curl_init();
	  curl_setopt( $ch, CURLOPT_URL, $url );
	  # set return transfer to false
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	  curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
	  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	  # increase timeout to download big file
	  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
	  # write data to local file
	  curl_setopt( $ch, CURLOPT_FILE, $fp );
	  # execute curl
	  curl_exec( $ch );
	  # close curl
	  curl_close( $ch );
	  # close local file
	  fclose( $fp );

	  if (filesize($path) > 0) return true;
	}

	public function download_image( $url )
	{
		// TODO: hacer que primero intente utilizar el método de cURL y si no el otro
		// TODO: poner advertencias sobre que métodos de descarga están disponibles
        /*
		$upload = wp_upload_dir();
		$file = basename( $url );
		$path = $upload['path'] . DIRECTORY_SEPARATOR . $file;
		if( file_exists( $path ) )
			return $path;

		$content = file_get_contents( $url );
		if( $content )
		{
			
			if( file_put_contents( $path, $content ) )
				return $path;
		}

		return false;
        */
        
        $upload = wp_upload_dir();
        $file = basename( $url );
        $path = $upload['path'] . DIRECTORY_SEPARATOR . $file;
        if( file_exists( $path ) )
            return $path;

		$headers = $this->curl_get_headers($url);

		// TODO: decidir si seria conveniente comprobar algún header más
		if ($headers['http_code'] === 200) {
			
		  if( $this->curl_download($url, $path) )
				return $path;
		}

		return false;
	}

	public function create_attachment( $path, $author = 0 )//, $attachment, $author = 0 )
	{
		if( !is_readable( $path ) )
			return false;

		$filetype = wp_check_filetype( basename( $path ), null );

		$upload_dir = wp_upload_dir();
		if( $upload_dir['error'] !== false )
			return false;

		$attachment_arr = array(
			'guid' => $upload_dir['url'] . '/' . basename( $path ),
			'post_mime_type' => $filetype['type'],
			'post_type' => 'attachment',
			'post_author' => $author ? $author : get_current_user_id(),
			'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $path ) ),
			'post_content' => '',
			'post_status' => 'inherit',
			'file' => $path
		);

		//if( $attachment->get_alternative() )
			//$attachment_arr['ID'] = $attachment->get_alternative()->ID;

		$attach_id = wp_insert_post( $attachment_arr, true );
		if( is_wp_error( $attach_id ) )
			return false;
		
		if( !function_exists( 'wp_generate_attachment_metadata' ) ||
			!function_exists( 'wp_update_attachment_metadata' ) )
			require_once( ABSPATH . 'wp-admin/includes/image.php' );

		$attach_data = wp_generate_attachment_metadata( $attach_id, $path );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		
		return $attach_id;
	}

	public function is_upload_dir_writable()
	{
		return
			( $upload_dir = wp_upload_dir() ) &&
			$upload_dir['error'] === false &&
			is_writable( $upload_dir['basedir'] );
	}
}
