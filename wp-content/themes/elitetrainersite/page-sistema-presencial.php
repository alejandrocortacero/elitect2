<?php defined('ABSPATH') or die('Wrong Access!'); ?><?php
get_header('noopen');
?>

<?php EliteTrainerSiteThemeCustomizer::print_page_header_video(
    'presencialplanpagetitle',
    'Seguimientos presenciales',
    'presencialheadervideo',
    'presencialplanpagesubtitle',
    'Complementa tu entrenamiento presencialmente'
); ?>

<?php $plans = class_exists('EpointPresencialPlans', false) ? EpointPresencialPlans::get_plans() : array(); ?>

<?php if (!empty($plans)) : ?>
    <div class="container-fluid presencial-plans-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table presencial-table">
                            <thead class="presencial-table-head">
                            <tr>
                                <th>Tipo</th>
                                <th class="text-center">Incluye</th>
                                <th>Seguimiento</th>
                                <th>Precios (IVA
                                    incluido) <?php EliteTrainerSiteThemeCustomizer::print_edit_button('presencialtablehead'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($plans as $plan) : ?>
                                <tr class="plan-row" data-plan="<?php echo esc_attr($plan->ID); ?>">
                                    <td>
                                        <div class="title"><?php echo wp_kses_post(EpointPresencialPlans::get_type($plan->ID)); ?></div>
                                        <div class="valoration"
                                             data-valoration="<?php echo esc_attr(EpointPresencialPlans::get_valoration($plan->ID)); ?>"></div>

                                        <?php if (EliteTrainerSiteThemeCustomizer::can_edit()) : ?>
                                            <div class="edit">
                                                <button style="margin-top: 10px;" type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#edit-presencial-plan-modal"
                                                        data-plan="<?php echo esc_attr($plan->ID); ?>">Editar plan
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="desc"><?php echo wp_kses_post($plan->post_content); ?></td>
                                    <td class="times"><?php echo wp_kses_post(EpointPresencialPlans::get_times($plan->ID)); ?></td>
                                    <td class="prices"><?php echo wp_kses_post(EpointPresencialPlans::get_prices($plan->ID)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (EliteTrainerSiteThemeCustomizer::can_edit()) : ?>
    <div class="container-fluid add-plan-container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <hr/>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#edit-presencial-plan-modal" data-plan="">Añadir plan
                </button>
                <hr/>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if (class_exists('JLCContact')) : ?>
    <?php $phone = esc_attr(EliteTrainerSiteThemeCustomizer::get_contact_phone()); ?>
    <div class="container-fluid contact-container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="link-layer">
                    <p class="link"><a href="#"><span
                                    class="text-inner"><?php echo esc_html(EliteTrainerSiteThemeCustomizer::get_button_text('contact')); ?></span>
                            <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                    <?php EliteTrainerSiteThemeCustomizer::print_edit_button('contactlink'); ?>
                </div>
                <p class="tel">¡También puedes contactar por teléfono!</p>
                <p class="tel">
                    <a class="tel-link" href="tel:<?php echo preg_replace('/\D/', '', esc_attr($phone)); ?>"
                       rel="nofollow">Llámanos</a> o
                    <?php if (false) : ?><a class="whatsapp-link"
                                            href="whatsapp://send/?phone=<?php echo preg_replace('/\D/', '', esc_attr($phone)); ?>&text&source&data&app_absent"
                                            rel="nofollow" >envía un Whatsapp</a><?php endif; ?>
                    <a class="whatsapp-link"
                       href="https://api.whatsapp.com/send?phone=+34<?php echo preg_replace('/\D/', '', $phone); ?>"
                       rel="nofollow">envía un Whatsapp</a>
                </p>
                <p class="tel">O si lo prefieres <a href="#" rel="nofollow" data-toggle="modal"
                                                    data-target="#we-call-you-modal"> te llamamos</a></p>
                <div class="contact-form-layer">
                    <?php echo JLCContact::get_contact_form(); ?>
                    <?php EliteTrainerSiteThemeCustomizer::print_edit_button('footercontactform'); ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/wp-includes/js/tinymce/wp-tinymce.js"></script>

<?php endif; ?>

<?php get_template_part('templates/editpresencialplan', 'modal'); ?>

<?php get_footer('noclose'); ?>

