<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="member-photos-first-modal" tabindex="-1" role="dialog" aria-labelledby="member-photos-first-modal-label">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="member-photos-first-modal-label">Primeros pasos</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Por último, tómate unas fotos de cuerpo entero y súbelas.</p>
                <p class="text-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Adelante">Subir fotos</button>
<!--                    <a href="--><?php //echo admin_url( 'admin-post.php?action=' . EliteTrainerSiteTheme::SKIP_EVOLUTION_PHOTOS_FORM_ACTION ); ?><!--" class="btn btn-secondary">Saltar</a>-->
                </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#member-photos-first-modal').modal('show');
        });
    })(jQuery);
</script>
