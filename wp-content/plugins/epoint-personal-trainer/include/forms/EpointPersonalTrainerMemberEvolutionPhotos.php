<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerMemberEvolutionPhotosForm' ) )
{

class JLCEpointPersonalTrainerMemberEvolutionPhotosForm extends JLCCustomForm
{
	public $skip_button;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$member_id = isset( $args['member'] ) ? (int)$args['member'] : get_current_user_id();

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_member_ev_photos',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'member-evolution_photos-form';

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id,
				'required' => true
			)
		);


		$this->add_date_field(
			'when',
			array(
				'label' => 'Fecha',
				'value' => date( 'Y-m-d' ),
				'help' => 'Si deseas sustituir un grupo de fotos, selecciona aquí la fecha del grupo',
				'required' => true
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'front_photo',
			array(
				'value' => '',
				'label' => __( 'Front photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'profile_photo',
			array(
				'value' => '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'back_photo',
			array(
				'value' => '',
				'label' => __( 'Back photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

		if( get_user_meta( $member_id, 'personal_trainer_evolution_photos_set', true ) !== 'yes' && class_exists( 'EliteTrainerSiteTheme', false ) )
		{
			$this->skip_button = $this->add_html(
				array(
					'html_wrapped' => false,
					'content' => '<a class="btn btn-primary" href="' . admin_url( 'admin-post.php?action=' . EliteTrainerSiteTheme::SKIP_EVOLUTION_PHOTOS_FORM_ACTION ) . '">' . __( 'Skip', $this->get_text_domain() ) . '</a>'
				)
			);
		}
		else
		{
			$this->skip_button = null;
		}
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();

	}

    protected function process_form()
    {
        $member_id = (int)($this->get_field_by_name( 'member' )->get_value());
        $date = $this->get_field_by_name( 'when' )->get_value();

        $front = $this->get_field_by_name( 'front_photo' )->get_value();
        $profile = $this->get_field_by_name( 'profile_photo' )->get_value();
        $back = $this->get_field_by_name( 'back_photo' )->get_value();

        // Save the photos
        $ret = EpointPersonalTrainerMapper::insert_user_evolution_photos($member_id, $date, $front, $profile, $back);
        if ($ret === false) {
            return array(
                array(
                    'code' => self::FATAL_ERROR,
                    'text' => 'Hubo un error al subir las fotos'
                )
            );
        }

        // Mark the form as completed
        update_user_meta($member_id, 'personal_trainer_evolution_photos_set', 'yes');

        // Redirect to the account page or any other desired page
        wp_redirect(site_url('trainersite-my-account/'));
        exit;
    }



}

} // class_exists





