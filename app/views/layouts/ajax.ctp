<?php
echo $javascript->link( array(
                    'jquery/jquery.mobile-1.0b2',
                    'jquery/jquery.easing.1.3',
                    'jquery/jquery.mobile.actionsheet',
//                    'jquery/jquery.mobile.scrollview.js',
                   
                    ));
                ?>


?>
<div data-role="page">
    <?php echo $content_for_layout; ?>
</div>