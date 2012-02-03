<div id="sf_admin_container">
	<div id="sf_admin_content">
	<!-- employee/list?filters[company_id]=1 -->
	<a href="<?php echo url_for('employee/index').'?company_id='.$company->getId()."&filter=filter" ?>" class="external_link" target="_self"><?php echo __('Employees') ?> (<?php echo count($company->getEmployees()) ?>)</a>
	<a href="<?php echo url_for('company/usage').'?company_id='.$company->getId(); ?>" class="external_link" target="_self"><?php echo __('Usage') ?></a>
        <a href="<?php echo url_for('company/paymenthistory').'?company_id='.$company->getId().'&filter=filter' ?>" class="external_link" target="_self"><?php echo __('Payment History') ?></a>
        </div>
<h1><?php echo __('Call History'); ?></h1>
	 <table width="100%" cellspacing="0" cellpadding="2" class="tblAlign" border='0'>
                    
                    <tr>
                    <th width="20%"   align="left"><?php echo __('Date &amp; time') ?></th>
                    <th  width="20%"  align="left"><?php echo __('Phone Number') ?></th>
                    <th width="10%"   align="left"><?php echo __('Duration') ?></th>
                    <th  width="10%"  align="left"><?php echo __('VAT') ?></th>
                    <th width="20%"   align="left"><?php echo __('Cost <small>(Incl. VAT)</small>') ?></th>
                    <th  width="20%"   align="left"><?php echo __('Samtalstyp') ?></th>
                  </tr>
   <?php
   $callRecords=0;

   $amount_total = 0;




$tomorrow1 = mktime(0,0,0,date("m"),date("d")-15,date("Y"));
$fromdate=date("Y-m-d", $tomorrow1);
$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
 $todate=date("Y-m-d", $tomorrow);






 $numbername=$company->getVatNo();



  $urlval = "https://mybilling.telinta.com/htdocs/zapna/zapna.pl?type=customer&action=get_xdrs&name=".$numbername."&tz=Europe/Stockholm&from_date=".$fromdate."&to_date=".$todate;




$res = file_get_contents($urlval);
$csv = new parseCSV();

$csvFileName = $res;
# Parse '_books.csv' using automatic delimiter detection...
$csv->auto($csvFileName);


foreach ($csv->data as $key => $row) {

    $timstampscsv = date('Y-m-d h:i:S');
    $counters = 0;
    foreach ($row as $value) {
?>



<?php

        //echo $value;
        //$sqlInserts .= "'$value'".', ';
//echo $csv->titles[$counters];
        if ($csv->titles[$counters] == 'class') {
            $csv->titles[$counters] = 'lstclasses';
        }
        ${$csv->titles[$counters]} = $value;
        $counters++;
    } ?>


    <tr>
        <td><?php echo $connect_time; ?></td>
        <td><?php echo  $CLD; ?></td>
        <td><?php echo number_format($charged_quantity/60 ,2);  ?></td>
         <td><?php echo  number_format($charged_amount/4,2); ?></td>
        <td><?php echo number_format($charged_amount,2);      $amount_total+= number_format($charged_amount,2); ?> SEK</td>
           <td><?php $account_id;    $typecall=substr($account_id,0,1);
           if($typecall=='a'){ echo "Int.";  }
           if($typecall=='4'){ echo "R";  }
           if($typecall=='c'){ if($CLI=='**24'){  echo "Cb M"; }else{ echo "Cb S"; }      }  ?> </td>
            </tr>

<?php
$callRecords=1;
}
?>        <?php if($callRecords==0){ ?>
                <tr>
                	<td colspan="6"><p><?php echo __('There are currently no call records to show.') ?></p></td>
                </tr>
                <?php }else{ ?>
                <tr>
                	<td colspan="4" align="right"><strong><?php echo __('Subtotal') ?></strong></td>

                	<td><?php echo number_format($amount_total, 2, ',', '') ?> EURO</td>
                        <td>&nbsp;</td>
                </tr>
                <?php } ?>

                <tr><td colspan="6" align="left"><?php echo __('Samtalstyp  type detail') ?> <br/> <?php echo __('Int. = Internationella samtal') ?><br/>
<?php echo __('Cb M = Callback mottaga') ?><br/>
	<?php echo __('Cb S = Callback samtal') ?><br/>
	<?php echo __('R = resenummer samtal') ?><br/>
</td></tr>
              </table></div>