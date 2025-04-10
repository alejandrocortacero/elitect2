<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

.user-fixed-layer .user-menu-button
{
    color: <?php echo $text_color; ?>;
    background-color: <?php echo $main_color; ?>;
}

.main-options-layer .main-options-button {
    color: <?php echo $text_color; ?>;
    background-color: <?php echo $main_color; ?>;
    border: 3px solid #eee;
    -webkit-box-shadow: 1px 1px 3px 0 #666;
    box-shadow: 1px 1px 3px 0 #666;
}

@keyframes edit-section-button-lighting {
     from {background-color: <?php echo $main_color; ?>;box-shadow:1px 1px 2px 0 #666;}
     to {background-color: #aaa;box-shadow:0px 0px 2px 4px <?php echo $main_color; ?>;}
}

.edit-section-button {
    color: <?php echo $text_color; ?>;
    background-color: <?php echo $main_color; ?>;
}
