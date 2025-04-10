<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = get_user_by( 'ID', $member_id );

$trainer_id = get_current_user_id();
$trainer_restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( $trainer_id );
$trainer_objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( $trainer_id );

setCookie( EliteTrainerSiteTheme::LAST_PAGE_COOKIE, 'view-member-diets', time() + 24*60*60*1000, '/' );

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-view-member-diets'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12 user-diets-col">
				<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member_id ); ?>">Volver al perfil</a></p>
				<h1 class="text-center" style="position:relative;">
					<span>Dietas de <?php echo esc_html( $member->display_name ); ?></span>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'userdietsstyle' ); ?>
				</h1>

				<?php $msg_transient = get_transient( 'assign_diet_msg_' . get_current_user_id() ); ?>
				<?php if( !empty( $msg_transient ) ) : ?>
					<div class="alert alert-success">
						<p><?php echo esc_html( $msg_transient ); ?></p>
						<?php delete_transient( 'assign_diet_msg_' . get_current_user_id() ); ?>
					</div>
				<?php endif; ?>

				<?php $create_form = EpointPersonalTrainerPublic::get_create_user_diet_form( $member_id, false ); ?>
				<?php if( $create_form ) : ?>
					<?php $create_form->print_public_notices(); ?>
				<?php endif; ?>

				<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

					<?php $diet_items = EpointPersonalTrainerMapper::get_user_diets( $member_id, null, null, 'start', 'desc' ); ?>
					<?php if( !empty( $diet_items ) ) : ?>
						<?php foreach( $diet_items as $tt ) : ?>
							<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-diet-row.php' ) ) ); ?>
						<?php endforeach; ?>

					<?php else : ?>
						<p>No hay dietas asignadas.</p>
					<?php endif; ?>

				<?php endif; ?>
			</div>
			<div class="col-xxs-12 col-xs-12 col-sm-6">
				<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

					<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-assign-diet.php' ) ) ); ?>

					
				<?php endif; ?>
			</div>
			<div class="col-xxs-12 col-xs-12 col-sm-6">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#personal-questionnaire" aria-controls="personal-questionnaire" role="tab" data-toggle="tab">Cuestionario personal</a></li>
					<li role="presentation"><a href="#food-like" aria-controls="food-like" role="tab" data-toggle="tab">Gustos alimentarios</a></li>
					<li role="presentation"><a href="#habits" aria-controls="habits" role="tab" data-toggle="tab">Hábitos dietéticos</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="personal-questionnaire">
						<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-edit-personal-questionnaire.php' ) ) ); ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="food-like">
						<?php $food_cats = EpointPersonalTrainerMapper::get_food_items_grouped_by_category( null, $member->ID, get_current_blog_id() ); ?>
						<?php $user_food_info = get_user_meta( $member->ID, 'personal_trainer_food_questionnaire', true ); ?>
						<?php foreach( $food_cats as $food_cat ) : ?>
							<h3><?php echo esc_html( $food_cat->name ); ?></h3>
							<?php foreach( $food_cat->food as $food ) : ?>
								<?php if( isset( $user_food_info[$food->ID]['frequent'] ) && $user_food_info[$food->ID]['frequent'] == 'yes' ) : ?>
									<p><b><?php echo esc_html( $food->name ); ?></b> <span style="color:#0f0;">S</span> - <?php echo isset( $user_food_info[$food->ID]['valuation'] ) ? '<span style="color:' . ( $user_food_info[$food->ID]['valuation'] < 5 ? '#a00' : ( $user_food_info[$food->ID]['valuation'] < 7 ? 'orange' : '#0a0' ) ) . ';">' . $user_food_info[$food->ID]['valuation'] . '</span>' : '?'; ?></p>
								<?php else : ?>
									<p><b><?php echo esc_html( $food->name ); ?></b> <span style="color:#f00;">N</span> - <?php echo isset( $user_food_info[$food->ID]['valuation'] ) ? '<span style="color:' . ( $user_food_info[$food->ID]['valuation'] < 5 ? '#a00' : ( $user_food_info[$food->ID]['valuation'] < 7 ? 'orange' : '#0a0' ) ) . ';">' . $user_food_info[$food->ID]['valuation'] . '</span>' : '?'; ?></p>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="habits">
						<?php $habits = get_user_meta( $member->ID, 'personal_trainer_user_habits', true ); ?>
						<?php $habits_observations = get_user_meta( $member->ID, 'personal_trainer_user_habits_observations', true ); ?>
						<?php $ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3); ?>
						<?php foreach( $ii as $i ) : ?>
							<p><b><?php printf( '%02d:00', $i ); ?></b> <?php echo !empty( $habits[$i]['text'] ) ? $habits[$i]['text'] : ''; ?></p>
						<?php endforeach; ?>
						<h3>Observaciones</h3>
						<?php if( !empty( $habits_observations ) ) : ?>
							<div class="observations">
								<?php echo wp_kses_post( $habits_observations ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<div class="modal fade" id="preview-diet-modal" tabindex="-1" role="dialog" aria-labelledby="preview-diet-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="preview-diet-modal-label">Previsualizar dieta</h4>
      </div>
      <div class="modal-body">
			<p class="diet"></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){
	$('#preview-diet-modal').on('show.bs.modal', function (event) {
	  var modal = $(this);
	  var button = $(event.relatedTarget);
	  //var dietId = button.data('diet');
	  var dietId = button.siblings('.select-diet-input').val();
	  if(dietId == '')
	  {
		modal.modal('hide');
		return;
	  }


		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::GET_DIET_PREVIEW_ACTION; ?>',
				'diet' : dietId
			},
			beforeSend:function(){
				modal.find('.modal-body').html('<p>Cargando...</p>');
			},
			success:function(a,b,c){
				modal.find('.modal-body').html(a);
			},
			error:function(a,b,c){
				modal.find('.modal-body').html('<p>Hubo un error. Inténtelo de nuevo más tarde.</p>');
			}
		});
	});
})(jQuery);
</script>

<script type="text/javascript">
(function($){
	function filterPresetTrainingItems()
	{
		var o = $('.select-objective-input').val();
		var e = $('.select-restriction-input').val();


		$.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST',
			data: {'objective':o,'restriction':e,'action':'<?php echo EliteTrainerSiteTheme::GET_AVAILABLE_DIET_ITEMS_ACTION; ?>'},
			complete:function(){
			},
			success: function(a,b,c){
				var t = $('.select-diet-input');
				var a = JSON.parse(a);
				t.children('option[value!=""]').remove();
				for( var i in a )
					t.append('<option value="' + a[i].ID + '">' + a[i].name + '</option>');
			}
		});
	}

	$(document).ready(function(){

		$('.select-objective-input').change(filterPresetTrainingItems);
		$('.select-restriction-input').change(filterPresetTrainingItems);

		$('.new-diet-from').val('');

		$('.new-diet-from').change(function(evt){
			var a = $(evt.currentTarget);
			var b = a.val();
			if( b == 'yes' )
			{
				$('.col-new-diet').hide();
				$('.col-existing-diet').show();
			}
			else
			{
				$('.col-new-diet').show();
				$('.col-existing-diet').hide();
			}
		});

		$('.new-diet-start-date').change(function(evt){
			var inp = $(evt.currentTarget);
			$('form input[name="start"]').val(inp.val());
		});

		$('.new-diet-end-date').change(function(evt){
			var inp = $(evt.currentTarget);
			$('form input[name="end"]').val(inp.val());
		});

		//$('.select-objective-input').change(filterPresetDietItems);
		//$('.select-restriction-input').change(filterPresetDietItems);

		$('.assing-new-selected-diet').click(function(evt){

			evt.preventDefault();
			var t = $(evt.currentTarget);
			var dietInput = $('.select-diet-input');
			var diet = dietInput.val();
			if( diet == '' )
			{
				dietInput.focus();
				dietInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: dietInput.offset().top - 200 }, 800 );
				return;
			}
			var member = t.data('member');

			var observations = $('.new-selected-diet-observations').val();

			var startInput = $('.new-diet-start-date');
			var endInput = $('.new-diet-end-date');

			if( startInput.val() == '' )
			{
				startInput.focus();
				startInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: startInput.offset().top - 200 }, 800 );
				return;
			}
			if( endInput.val() == '' )
			{
				endInput.focus();
				endInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: endInput.offset().top - 200 }, 800 );
				return;
			}

			var postData = {
				'action':'<?php echo EliteTrainerSiteTheme::ASSIGN_DIET_ACTION; ?>',
				'diet': diet,
				'member': member,
				'observations': observations,
				'start': startInput.val(),
				'end': endInput.val()
			};

			$.ajax({
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				type: 'POST',
				data: postData,
				//contentType: false,
				//processData: false,
				complete:function(){
					//cc.removeClass('loading');
				},
				success: function(a,b,c){

					//var r = JLCCustomForm.parseWPAjax(a);
					//$('.assigned-training-table tbody').append(r[0].data);
					window.location.reload(true);
				},
				error: function(a,b,c)
				{
					alert('Hubo un error');
				}
			});


		});
	});
})(jQuery);
</script>

<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
