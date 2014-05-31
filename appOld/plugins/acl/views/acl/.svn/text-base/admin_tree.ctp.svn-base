<?php print $javascript->link(array('/acl/js/jquery.cookie.js', '/acl/js/jquery-treeview/jquery.treeview.js')) ?>
<?php echo $html->css(array('/acl/css/acl', '/acl/js/jquery-treeview/jquery.treeview.css')); ?>
<?php print $this->renderElement('acl_menu') ?>
<script>
  jQuery(document).ready(function(){
	// fourth example
	jQuery("#black, #gray").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});

  });
</script>
<div>
  <?php print $html->image('/acl/img/tree.png', array('align' => 'absmiddle')) ?>
  <b>Arbol de Permisos</b>
  <span id="indicator" style="display:none; padding-left:50px;"><?php print $html->image('indicator.gif', array('align'=>'absmiddle')) ?> Loading...</span>
</div>

<div id="treecontrol">
        <a title="Collapse the entire tree below" href="#"><?php print $html->image('/acl/js/jquery-treeview/images/minus.gif', array('align' => 'absmiddle')) ?> Collapse All</a>
        <a title="Expand the entire tree below" href="#"><?php print $html->image('/acl/js/jquery-treeview/images/plus.gif', array('align' => 'absmiddle')) ?> Expand All</a>
</div>

<ul class="treeview-black treeview" id="black">
<?php
$aco = $acos[0];
// AROS que tienen permiso
$aros_permiso = getAros($aco['AclAco']['id'], $acostree);

if ($aco['AclAco']['lft']+1 != $aco['AclAco']['rght']) {
    // tiene hijos
    ?>
    <li>
        <span style="float:none; width:100%;"><?=$aco['AclAco']['alias']?>
        <? if (strlen($aros_permiso)) { ?> <?php print $html->image('/acl/img/key.png', array('width'=>'25', 'height'=>'25','align' => 'absmiddle')) ?> <b> <?=$aros_permiso?></b><? }?>
        </span>
        <ul>
    <?
    printChildren($aco['AclAco']['id'], $acos, $acostree, $html);
    ?>
        </ul>
    </li>
    <?
}
else {
?>
    <li><?=$aco['AclAco']['alias']?>
    <?
    if (strlen($aros_permiso)) { ?><b> <?php print $html->image('/acl/img/key.png', array('width'=>'25', 'height'=>'25','align' => 'absmiddle')) ?> <?=$aros_permiso?></b><? }?>
    </li>
    <?
}
?>
</ul>

<?
function printChildren($aco_id, $acos, $acostree, $html) {
    foreach ($acos as $aco) {
        if ($aco['AclAco']['parent_id'] == $aco_id) {
            // AROS que tienen permiso
            $aros_permiso = getAros($aco['AclAco']['id'], $acostree);

            if ($aco['AclAco']['lft']+1 != $aco['AclAco']['rght']) {
                // tiene hijos
                ?>
                
                <li>
                    <span style="float:none; width:100%;"><?=$aco['AclAco']['alias']?>
                    <? if (strlen($aros_permiso)) { ?><b> <?php print $html->image('/acl/img/key.png', array('width'=>'25', 'height'=>'25','align' => 'absmiddle')) ?> <?=$aros_permiso?></b><? }?>
                    </span>
                    <ul>
                <?
                    printChildren($aco['AclAco']['id'], $acos, $acostree, $html);
                ?>
                    </ul>
                </li>
                <?
            }
            else {
            ?>
                <li><?=$aco['AclAco']['alias']?>
                <? if (strlen($aros_permiso)) { ?><b> <?php print $html->image('/acl/img/key.png', array('width'=>'25', 'height'=>'25','align' => 'absmiddle')) ?> <?=$aros_permiso?></b><? }?>
                </li>
                <?
            }
        }
    }
}

function getAros($aco_id, $acostree) {
    $aros_permitidos = '';
    if (!empty($acostree[$aco_id]['Aros'])) {
        foreach($acostree[$aco_id]['Aros'] as $aro) {
            $aros_permitidos .= $aro['alias'].", ";
        }

        return substr($aros_permitidos, 0, strlen($aros_permitidos)-2);
    }
    else {
        return '';
    }
}
?>

<?php
/*
foreach ($acostree as $key=>$aco) {
    echo $aco['Aco'];
    if (!empty($aco['Aros'])) {
        echo "<b> (";
        $aros_permitidos = '';
        foreach($aco['Aros'] as $aro) {
            $aros_permitidos .= $aro['alias'].", ";
        }
        echo substr($aros_permitidos, 0, strlen($aros_permitidos)-2);
        echo ")</b>";
    }
    echo "<br />";
}*/
?>
<br />
<br />
<h3>Usuarios</h3>
<br />
<?php
foreach ($arostree as $key=>$aro) {
    echo $aro."<br />";
}
?>
<br />