<TABLE FRAME=VOID CELLSPACING=0 COLS=3 RULES=NONE BORDER=0>
		<TR>
			<?php
				foreach ($columnas as $c):
					echo "<TD BGCOLOR='#FFFF99'><b>$c</b></TD>";
				endforeach;
			?>
		</TR>

		<?php
		foreach ($filas as $f):
		?>
		<TR>
			<?php
			foreach($f[0] as $d):
				echo "<TD>$d</TD>";
			endforeach;?>
		</TR>
		<?php
		endforeach;
		?>

</TABLE>

