<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="trainer-edit-menu-modal" tabindex="-1" role="dialog" aria-labelledby="trainer-edit-menu-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trainer-edit-menu-modal-label">Zona de creación</h4>
      </div>
      <div class="modal-body">
		<ul class="list-unstyled">
			<?php if( false ) : ?><li class="text-center"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Lista de socios</a></li><?php endif; ?>
			<?php if( false ) : ?><li class="text-center"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url(); ?>">Añadir nuevo socio</a></li><?php endif; ?></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_objectives_list_url(); ?>">Objetivos y entornos</a></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_exercises_list_url(); ?>">Galería de ejercicios y categorías</a></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_training_list_url(); ?>">Galería de entrenamientos</a></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_food_list_url(); ?>">Galería de alimentos</a></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_diet_objectives_list_url(); ?>">Objetivos y restricciones para dietas</a></li>
			<li class="text-center" style="margin-bottom:20px;"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_diets_list_url(); ?>">Galería de dietas</a></li>
		</ul>
      </div>
    </div>
  </div>
</div>


