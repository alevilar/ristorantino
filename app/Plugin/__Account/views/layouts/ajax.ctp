<div data-role="page" data-dom-cache="false">

    <?php echo $this->element('jqm_header', array('titulo' => $title_for_layout)); ?>

    <div data-role="content">

        <div id="mesajes">
            <?php
            $session->flash();
            $session->flash('auth');
            ?>
        </div>

        <?php echo $content_for_layout; ?>


        <?php echo $cakeDebug; ?>


    </div>
</div>