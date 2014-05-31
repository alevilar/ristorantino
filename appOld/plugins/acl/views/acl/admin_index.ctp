<?php echo $html->css('/acl/css/acl'); ?>
<h2>Access Control List Management</h2>
<ul class="aclc" style="display: block;">
  <li><?php print $html->image('/acl/img/tango/32x32/apps/system-users.png') ?><?php print $html->link('Manage Usuarios', '/admin/acl/aros') ?></li>
  <li><?php print $html->image('/acl/img/tango/32x32/apps/preferences-system-windows.png') ?><?php print $html->link('Manage Controladores', '/admin/acl/acos') ?></li>
  <li><?php print $html->image('/acl/img/tango/32x32/emblems/emblem-readonly.png') ?><?php print $html->link('Manage Permisos', '/admin/acl/permissions') ?></li>
  <li><?php print $html->image('/acl/img/tree.png') ?><?php print $html->link('Arbol de Permisos', '/admin/acl/tree') ?></li>
  <li><?php print $html->image('/acl/img/tango/32x32/apps/preferences-system-windows.png') ?><?php print $html->link('Actualizar Controladores', '/aclprep/buildAcos',array('target'=>'_blank')) ?></li>
</ul>
<br />

<h2>Quick Start</h2><br />

<div>
<b>ARO - Access Request Object</b><br />
Things (most often users) that want to use stuff are called access request objects
</div><br />

<div>
<b>ACO - Access Control Object</b><br />
Things in the system that are wanted (most often actions or data) are called access control objects
</div>

<br />
<h2>Scripts de permisos</h2><br />

<div><?php print $html->link('Version 1.6.4', '/aclprep/assignPermissions1Dot6Dot4',array('target'=>'_blank')) ?></div>
<div><?php print $html->link('Version 1.6.3', '/aclprep/assignPermissions1Dot6Dot3',array('target'=>'_blank')) ?></div>
<div><?php print $html->link('Version 1.6.2', '/aclprep/assignPermissions1Dot6Dot2',array('target'=>'_blank')) ?></div>
<div><?php print $html->link('Version 1.6', '/aclprep/assignPermissions1Dot6',array('target'=>'_blank')) ?></div>
<div><?php print $html->link('Version inicial', '/aclprep/assignPermissions',array('target'=>'_blank')) ?></div>

<br />
<br />
<h2>Known Bugs</h2>
<ul>
 <li>does not show inherited permissions</li>
 <li>does not show full path in finder</li>
 <li>does not have crud fields</li>
</ul>