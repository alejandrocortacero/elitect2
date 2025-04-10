<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<h1>Añadir miembro <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Volver a la lista</a></h1>

<?php echo EpointPersonalTrainerPublic::get_edit_member_form( $member_id ); ?>
