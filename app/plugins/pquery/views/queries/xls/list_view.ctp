<table cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="<?php echo count($cols)?>"></td>
    </tr>
    <tr>
        <td colspan="<?php echo count($cols)?>">
            <?php echo $descripcion?>
        </td>
    </tr>
    <tr>
        <td colspan="<?php echo count($cols)?>"></td>
    </tr>
</table>


<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <?php foreach ($cols as $col): ?>
            <th><?php echo $col;?></th>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 0;
        foreach ($queries as $query):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
        <tr<?php echo $class;?>>
                <?php foreach($query as $line):?>
            <td>
                        <?php echo $line; ?>
            </td>
                <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

