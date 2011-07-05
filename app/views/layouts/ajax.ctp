
<div  data-role="page"  data-add-back-btn="true" id="<?= !empty($this->pageId) ? $this->pageId : $this->here?>">
    <div  data-role="header"  data-position="inline">
        
        <h1><?php echo $title_for_layout; ?></h1>
        <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
    </div>
    
    <div  data-role="content" class="container_12"><?php echo $content_for_layout; ?></div>
    <div  data-role="footer">Ristorantino Mágico</div>
</div>