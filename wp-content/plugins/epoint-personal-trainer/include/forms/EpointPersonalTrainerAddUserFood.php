<?php defined('ABSPATH') or die('Wrong Access');

if (!class_exists('JLCEpointPersonalTrainerAddUserFoodForm')) {

    class JLCEpointPersonalTrainerAddUserFoodForm extends JLCCustomForm
    {
        public function __construct($internal_id, $args)
        {
            $text_domain = isset($args['text_domain']) ? $args['text_domain'] : null;
            $member_id = isset($args['member']) ? (int)$args['member'] : get_current_user_id();

            parent::__construct(
                __DIR__,
                $internal_id,
                $text_domain,
                'epoint_personal_trainer_add_user_food',
                false,//true,//ajax
                true,//wordpress_method
                self::get_current_url(),
                false
            );

            $this->class = 'add-user-food-form';

            //$this->add_honeypot();

            $this->add_hidden_field(
                'member',
                array(
                    'value' => $member_id,
                    'required' => true
                )
            );

            $this->add_text_field(
                'name',
                array(
                    'value' => '',
                    'label' => __('Name', $this->get_text_domain()),
                    'maxlength' => 100,
                    'required' => true
                )
            );


            $categories_field = $this->add_select(
                'category',
                array(
                    'label' => __('Category', $this->get_text_domain()),
                    'required' => true
                )
            );
            $blog_categories = EpointPersonalTrainerMapper::get_blog_food_categories(get_current_blog_id());
            foreach ($blog_categories as $cat) {
                $categories_field->add_option(
                    $cat->ID,
                    $cat->name
                );
            }

            $this->add_submit_button(
                'send',
                array(
                    'label' => __('Save', $this->get_text_domain())
                )
            );
        }
        protected function process_form()
        {
            $member_id = (int)($this->get_field_by_name('member')->get_value());

      
            $name = $this->get_field_by_name('name')->get_value();
            $category = $this->get_field_by_name('category')->get_value();

            $food_id = EpointPersonalTrainerMapper::create_food(
                $name,
                1, // Default position
                1, // Active status
                array((int)$category),
                $member_id,
                null
            );


            if (!$food_id) {
                return array(
                    array(
                        'code' => self::FATAL_ERROR,
                        'text' => __('El alimento no se ha podido añadir correctamente.', $this->get_text_domain())
                    )
                );
            }


            $questionnaire_data = get_user_meta($member_id, 'personal_trainer_food_questionnaire', true);
            if (!is_array($questionnaire_data)) {
                $questionnaire_data = array();
            }

            foreach ($_POST as $key => $value) {
                if (preg_match('/^food_(\d+)_frequent$/', $key, $matches)) {
                    $food_id = $matches[1];
                    $frequent = $value;
                    $valuation_key = 'food_' . $food_id . '_valuation';
                    $valuation = isset($_POST[$valuation_key]) ? $_POST[$valuation_key] : null;

                    $questionnaire_data[$food_id] = array(
                        'frequent' => sanitize_text_field($frequent),
                        'valuation' => is_numeric($valuation) ? (int)$valuation : null,
                    );
                }
            }

            update_user_meta($member_id, 'personal_trainer_food_questionnaire', $questionnaire_data);
            update_user_meta($member_id, 'personal_trainer_food_questionnaire_date', date('Y-m-d H:i:s'));

            return __('Alimento creado satisfactoriamente.');
        }




    }

} // class_exists



