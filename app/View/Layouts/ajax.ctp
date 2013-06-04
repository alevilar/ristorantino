<div data-role="page" data-add-back-btn="true"> 

    <div data-role="header">
        <h1><?php echo $title_for_layout; ?></h1>
    </div> 
    <div data-role="content">
        <nav>
            <?php echo $this->element('admin_menu'); ?>
        </nav>

        <div id="maincontent">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('Auth'); ?>

            <?php echo $this->fetch('content'); ?>

        </div>

        <?php echo $this->element('sql_dump'); ?>
    </div>
</div> 

