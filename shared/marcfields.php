
<br />
<table class="primary">
  <tr>
    <th align="left" colspan="2" nowrap="yes">
      <?php echo $loc->getText("biblioViewTble3Hdr"); ?>:
    </th>
  </tr>
  <?php
	$displayCount = 0;
    foreach ($biblioFlds as $key => $field) 
    {
    	if (($field->getFieldData() != "") 
      	&& ($key != "245a")
        && ($key != "245b")
        && ($key != "245c")
        && ($key != "100a")) 
        {
        	$dummy = array();
    	    $marcDesc = '';
          	$idx = sprintf("%03d%s",$field->getTag(),$field->getSubfieldCd());
        	
        	// decide what additional tag to show 
        	if (($tab=='opac'))  
            {	
            	if (isset($customFieldDesc[$idx]))
            		$marcDesc = marcTagDesc($field->getTag(),$field->getSubfieldCd(), $dummy, $customFieldDesc, FALSE);	
          	}
          	elseif ($tab=='cataloging' && (!isset($marcTags[$field->getTag()])))
          	   	$marcDesc = marcTagDesc($field->getTag(),$field->getSubfieldCd(), $dummy, $customFieldDesc, FALSE);
          	else
          		$marcDesc = marcTagDesc($field->getTag(),$field->getSubfieldCd(), $marcTags, $marcSubflds, FALSE);
          
          	if ((count($field->getFieldData())!=0) && ($marcDesc != ''))
          	{ 
          		$displayCount++;
          		echo '<tr><td valign="top" class="primary">&nbsp;'.$marcDesc.'&nbsp;:&nbsp;</td>';
   				echo '<td valign="top" class="primary">';
          		if (preg_match('$^http://.*$',$field->getFieldData())) 
          			echo '<a href="'.H($field->getFieldData()).'">'.H($field->getFieldData()).'</a>';
          		else
          			echo '&nbsp;'.H($field->getFieldData());
          		echo '</td></tr>';  	
       		}
		}
	}
    if ($displayCount == 0) 
    {	
    	echo '<tr><td valign="top" class="primary" colspan="2">'.$loc->getText("biblioViewNoAddInfo").'</td></tr>';      
    }
  ?>
</table>

