<?php
/**
 * Helper to export records to Excel and generate Excel spreadsheet
 * excel.php Version 1.0
 *
 * PHP version 5
 * CakePHP 1.2
 *
 * Copyright (c) 2008, Christopher M. Natan developer@rainhand.com
 * How to use visit http://cakephp.rainhand.com/excel-helper
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 */ 
class ExcelComponent extends Component {
  
	var $path      =  TMP;
  	var $filename  =  "auto";
	var $xls       =  null;
  	var $style     =  null;
	var $title     =  null; 
	var $prefix    =  "arch";
	
	var $ready     =  false;
	var $column    = '';
	
	
	
	/** 
	 * 
	 *@access public
	 */
	function createConfig($path = null, $filename = "auto",$prefix = null) {
		if ($prefix != null):
			$this->prefix = $prefix;
		endif;
		if ($path != null){
			$this->path = $path;
		}
		
		$file = $this->_getFilename($filename);
		
	  	$ready = $this->_openFile($file);
		if(!$ready) {
			$this->_error($ready);
		}
	  	$this->_htmlHeader();	
		return $ready;	
	}
	
	
	/** 
	 * 
	 *@access private
	 */	
	function _getFilename($filename) {
		if($filename == 'auto') {
			$filename  = $this->prefix."_".strtolower(date("jYgis_") . ".xls");
	 		$this->filename = $filename;
		}
	  return $this->path . $filename;
	}
	
	
	/** 
	 * 
	 *@access private
	 */	 	
	function _openFile($file) { 
 		if(!empty($file)) { 
			return $this->xls = @fopen($file, "w+");
		}
		return false;  
 	} 
	
 	
	/** 
	 *
	 *@access public 
	 */	 
	function createTitle($title, $style=array(), $option=null) { 
		$class = $this->_createStyle($style);
		$this->title = $this->title . $this->_store($title,	$class,	$type = 1, $option);
		return true;
	}
	
	/** 
	 *
	 *@access public  
	 */	 
	function createSubTitle($title, $style = array(), $option = null)	{ 
		$this->createTitle($title, $style = array(), $option);
		return true;
	}
	
	/** 
	 *
	 *@access public  
	 */	 
	function createHeaders($headers ,$style = array(), $option = null) {  
		$explode = explode(",", $headers);
	  $class   = $this->_createStyle($style);
		$this->headers = $this->_store($explode, $class, $type = 2, $option);
		return true;
	}
	
	/** 
	 *
	 *@access public  
	 */	
	function createList($arrRecord, $style = array(), $logical = array()) {  
		$class = $this->_createStyle($style);
		$lists = $this->_store($arrRecord, $class, $type = 3, $logical);
		$this->_write($lists);
		return true;
	}
	
	/** 
	 *
	 *@access private 
	 */	 
	function _store($record, $class, $type, $option) {  
		$open_tr   = "<tr>";
		$close_tr  = "</tr>";
		$html = "";
		$tag  = "";
		$newline_after  = ""; 
		$newline_before = ""; 
		
		switch($option) {
			case 'newline-before': {  
				$newline_before = $open_tr . "<td>&nbsp;</td>" . $close_tr;
				break;
			}
			case 'newline-after': {  
			  $newline_after = $open_tr ."<td>&nbsp;</td>" . $close_tr;
				break;
			}
		}
		  
		switch($type) { 
			case 1: {
				$html = "<td class=$class>$record</td>";
			 	$tag  = $newline_before . $open_tr . $html . $close_tr . $newline_after; 
				break;
			}
			case 2: { 
				foreach($record as $column) { 
					$explode = explode(":", trim($column));
					$width   = "";
					$col     = $explode[0];
					if(!isset($explode[1])) {
						$explode[1] = "70";
					}
					$this->column = $this->column . $explode[1] . "px" . "|"; 
					$html .= "<td class=$class $width >$col</td>"; 
				}
				$tag = $newline_before . $open_tr . $html . $close_tr . $newline_after;  
				break;
			}
			case 3: { 
				foreach($record as $column) {  
					$html  = ""; 
					$style = "";
					if(is_array($option) && count($option >= 1)) { 
						$style = $this->_logical($option, $column); 
						$style = "style='$style'";
					}
					foreach($column as $col) { 
						$n   = "";
					 	if(is_numeric($col)) {
					 		$n = "align=right x:num";
						}	
					 	$html .= "<td class=$class $n $style>$col</td>"; }
						$tag  .= $newline_before . $open_tr . $html . $close_tr . $newline_after;
				}
				break; 
			}
		}
		return $tag; 
	}
	
	/** 
	 *
	 *@access private  
	 */	 
	function _logical($logic, $record) { 
		foreach($logic as $logic) {  
			$explode = explode(",", $logic);
			$value   = $explode[0];
			$style   = $explode[1];
			if(in_array($value, $record, true)) {  
				$style_ = explode('=', $style); 
			 	return $style_[1];
			}
		 }
		 return false; 
	}
	
	/** 
	 *
	 *@access private  
	 */	 
	function _write($lists) {  
		$headers = $this->headers;
		$title   = $this->title;
		$html    = $title . $headers . $lists;
		$this->_htmlStyle();
		$this->_htmlXml();
		$this->_htmlTable($html);
		$this->_close();
		return true;
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _close() {  
		fclose($this->xls);
		return true;
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _error($ready) { 
		$err  = "Error occured - Possible error: <br>"; 
	 	$err .= "1.) Excel file is currently open or file is currently in used.<br>";
	 	$err .= "2.) Unable to create File.You may not have permission to write the file.<br>";
	 	$err .= "3.) Directory path doesn't exist.<br>";
	 	echo $err;
	 	return false;
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _createStyle($style) { 
		$rnd   = mt_rand(100,1000);
	 	$class = "dev" . $rnd;
	 	$html  = "." . $class . "{mso-style-parent:style0;$style;mso-pattern:auto none;} ";
	 	$this->style = $this->style . $html;
	 	return $class;
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _htmlHeader() {
		$html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
						 xmlns:x="urn:schemas-microsoft-com:office:excel"
						 xmlns="http://www.w3.org/TR/REC-html40">
						 <head>
						 <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
						 <meta name=ProgId content=Excel.Sheet>
						 <meta name=Generator content="Microsoft Excel 11">
						 <link rel=File-List href="filelist.xml">
						 <link rel=Edit-Time-Data href="editdata.mso">
						 <link rel=OLE-Object-Data href="oledata.mso">
						 <!--[if gte mso 9]><xml>
						 <o:DocumentProperties>
						 <o:Author>...</o:Author>
						 <o:LastAuthor>...</o:LastAuthor>
						 <o:Created>2020-11-08T11:03:49Z</o:Created>
						 <o:LastSaved>2020-11-08T12:01:18Z</o:LastSaved>
						 <o:Company>devstring</o:Company>
						 <o:Version>11.5606</o:Version>
						 </o:DocumentProperties>
						 </xml><![endif]-->';
		 fwrite($this->xls, trim($html));
		 return true;
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _htmlStyle() { 
		$style = $this->style;
	 	$html  = '<style>
							<!--table
							{mso-displayed-decimal-separator:"\.";
							mso-displayed-thousand-separator:"\,";}
							@page
							{margin:1.0in .75in 1.0in .75in;
							mso-header-margin:.5in;
							mso-footer-margin:.5in;}
							tr
							{mso-height-source:auto;}
							col
							{mso-width-source:auto;}
							br
							{mso-data-placement:same-cell;}
							.style0
							{mso-number-format:General;
							text-align:general;
							vertical-align:bottom;
							white-space:nowrap;
							mso-rotate:0;
							mso-background-source:auto;
							mso-pattern:auto;
							color:windowtext;
							font-size:10.0pt;
							font-weight:400;
							font-style:normal;
							text-decoration:none;
							font-family:Arial;
							mso-generic-font-family:auto;
							mso-font-charset:0;
							border:none;
							mso-protection:locked visible;
							mso-style-name:Normal;
							mso-style-id:0;}
							td
							{mso-style-parent:style0;
							padding-top:1px;
							padding-right:1px;
							padding-left:1px;
							mso-ignore:padding;
							color:windowtext;
							font-size:10.0pt;
							font-weight:400;
							font-style:normal;
							text-decoration:none;
							font-family:Arial;
							mso-generic-font-family:auto;
							mso-font-charset:0;
							mso-number-format:General;
							text-align:general;
							vertical-align:bottom;
							border:none;
							mso-background-source:auto;
							mso-pattern:auto;
							mso-protection:locked visible;
							white-space:nowrap;
							mso-rotate:0;}
							.xl24
							{mso-style-parent:style0;
							font-size:16.0pt;
							background:yellow;
							mso-pattern:auto none;}'.
							$style .'--> </style> ';
		 fwrite($this->xls, trim($html));
		 return true;	
	}
	
	/** 
	 * 
	 *@access private 
	 */		
	function _htmlXml() {
		$html = '<!--[if gte mso 9]><xml>
						<x:ExcelWorkbook>
						<x:ExcelWorksheets>
						<x:ExcelWorksheet>
						<x:Name>Sheet1</x:Name>
						<x:WorksheetOptions>
						<x:Print>
						<x:ValidPrinterInfo/>
						<x:HorizontalResolution>-3</x:HorizontalResolution>
						<x:VerticalResolution>0</x:VerticalResolution>
						</x:Print>
						<x:Selected/>
						<x:Panes>
						<x:Pane>
						<x:Number>3</x:Number>
						<x:ActiveRow>7</x:ActiveRow>
						<x:ActiveCol>3</x:ActiveCol>
						</x:Pane>
						</x:Panes>
						<x:ProtectContents>False</x:ProtectContents>
						<x:ProtectObjects>False</x:ProtectObjects>
						<x:ProtectScenarios>False</x:ProtectScenarios>
						</x:WorksheetOptions>
						</x:ExcelWorksheet>
						<x:ExcelWorksheet>
						<x:Name>Sheet2</x:Name>
						<x:WorksheetOptions>
						<x:ProtectContents>False</x:ProtectContents>
						<x:ProtectObjects>False</x:ProtectObjects>
						<x:ProtectScenarios>False</x:ProtectScenarios>
						</x:WorksheetOptions>
						</x:ExcelWorksheet>
						<x:ExcelWorksheet>
						<x:Name>Sheet3</x:Name>
						<x:WorksheetOptions>
						<x:ProtectContents>False</x:ProtectContents>
						<x:ProtectObjects>False</x:ProtectObjects>
						<x:ProtectScenarios>False</x:ProtectScenarios>
						</x:WorksheetOptions>
						</x:ExcelWorksheet>
						</x:ExcelWorksheets>
						<x:WindowHeight>10740</x:WindowHeight>
						<x:WindowWidth>18075</x:WindowWidth>
						<x:WindowTopX>240</x:WindowTopX>
						<x:WindowTopY>90</x:WindowTopY>
						<x:ProtectStructure>False</x:ProtectStructure>
						<x:ProtectWindows>False</x:ProtectWindows>
						</x:ExcelWorkbook>
						</xml><![endif]--></head>';
		fwrite($this->xls, trim($html));
		return true;	
	}
	
	/** 
	 *
	 *@access private  
	 */	
	function _htmlColumn() {  
		$column  = $this->column;
		$explode = explode("|", $column);
		$col     = "";
		foreach($explode as $var_col) {	
			$width = $var_col; 
			$col  .= "<col style='mso-width-source:userset;width:$width'>";
		}
		return $col;
	}
	
	/** 
	 *
	 *@access private  
	 */		
	function _htmlTable($html_var) { 
		$col  = $this->_htmlColumn();
	 	$html = "<body link=blue vlink=purple>
						<table x:str border=0 cellpadding=0 cellspacing=0 width=292 style='border-collapse:
						collapse;table-layout:fixed;width:500px'>
						$col
						$html_var
						<![if supportMisalignedColumns]>
						<tr height=0 style='display:none'>
						<td width=100 style='width:75pt'></td>
						<td width=64 style='width:48pt'></td>
						<td width=64 style='width:48pt'></td>
						<td width=64 style='width:48pt'></td>
						</tr>
						<![endif]>
						</table>
						</body>
						</html>";
		fwrite($this->xls, trim($html));	
		return true;	
	}
 
	 
}
	
?>
