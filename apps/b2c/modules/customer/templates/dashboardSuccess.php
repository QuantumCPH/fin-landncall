<?php 
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
?>
<?php use_helper('I18N') ?>
<?php use_helper('Number') ?>
<?php include_partial('dashboard_header', array('customer'=> $customer, 'section'=>__('Dashboard')) ) ?>
  <div class="left-col">
    <?php include_partial('navigation', array('selected'=>'dashboard', 'customer_id'=>$customer->getId())) ?>
    <div class="dashboard-info">
        <div class="fl cb dashboard-info-text"><span><?php echo __('Customer Number') ?>:</span><span><?php echo $customer->getUniqueid(); ?></span></div>
	<div class="fl cb dashboard-info-text"><span><?php echo __('Your account balance is') ?>:</span><span>
	<?php

            $cuid=$customer->getId();
           $cp = new Criteria();
                                  $cp->add(CustomerProductPeer::CUSTOMER_ID, $cuid);
                                  $custmpr = CustomerProductPeer::doSelectOne($cp);
                                   $p = new Criteria();
                                   $p->add(ProductPeer::ID, $custmpr->getProductId());
                                   $products=ProductPeer::doSelectOne($p);


        echo $customer_balance==-1?'&oslash;':number_format($customer_balance,2);

        //This Section For Get the Language Symbol For Set Currency -
        $getvoipInfo = new Criteria();
        $getvoipInfo->add(SeVoipNumberPeer::CUSTOMER_ID, $customer->getId());
        $getvoipInfo->add(SeVoipNumberPeer::IS_ASSIGNED, 1);
        $getvoipInfos = SeVoipNumberPeer::doSelectOne($getvoipInfo);//->getId();
        if(isset($getvoipInfos)){
            $voipnumbers = $getvoipInfos->getNumber() ;
            $voip_customer = $getvoipInfos->getCustomerId() ;
        }else{
           $voipnumbers =  '';
           $voip_customer = '';
        }
        
        
echo '&nbsp;';

?> EUR <input type="button" class="butonsigninsmall" style="<?php if($voip_customer!=''){?> margin-left:63px;<?php }else{ ?>margin-left:43px;<?php }?>" name="button" onclick="window.location.href='<?php echo sfConfig::get('app_epay_relay_script_url').url_for('customer/refill?customer_id='.$customer->getId(), true) ?>'" style="cursor: pointer"  value="<?php echo __('Buy credit') ?>" ></span></div>

        <div class="fl cb dashboard-info-text"  ><span   style="padding-right:-10px"><?php echo __('Active mobile number') ?>:</span><span><?php
        
        $unid   =  $customer->getUniqueid();
        if(isset($unid) && $unid!=""){
            $un = new Criteria();
            $un->add(CallbackLogPeer::UNIQUEID, $unid);
            $un -> addDescendingOrderByColumn(CallbackLogPeer::CREATED);
            $unumber = CallbackLogPeer::doSelectOne($un);
            // This Condition For - It register Via Web
            if($unumber->getCheckStatus()=='2'){
                $getFirstnumberofMobile = substr($unumber->getMobileNumber(), 0,1);     // bcdef
                if($getFirstnumberofMobile==0){
                  $TelintaMobile = substr($unumber->getMobileNumber(), 1);
                  $TelintaMobile =  '49'.$TelintaMobile ;
                }else{
                  $TelintaMobile = ''.$unumber->getMobileNumber();
                }
              $TelintaMobile="00".$TelintaMobile;

                 $Telintambs=$TelintaMobile;

 echo substr($Telintambs, 0,4); echo " "; echo substr($Telintambs, 4,3);
echo "    ";   echo substr($Telintambs, 7,2);
echo " ";   echo substr($Telintambs, 9,2);
echo " ";   echo substr($Telintambs, 11,2);
echo " ";   echo substr($Telintambs, 13,2);
echo " ";   echo substr($Telintambs, 15,2);
            }else{
               $TelintaMobile="00".$unumber->getMobileNumber();



                 $Telintambs=$TelintaMobile;

 echo substr($Telintambs, 0,4); echo " ";   echo substr($Telintambs, 4,3);
echo " ";   echo substr($Telintambs, 7,2);
echo " ";   echo substr($Telintambs, 9,2);
echo " ";   echo substr($Telintambs, 11,2);
echo " ";   echo substr($Telintambs, 13,2);
echo " ";   echo substr($Telintambs, 15,2);
            }
         }else{
                $getFirstnumberofMobile = substr($customer->getMobileNumber(), 0,1);     // bcdef
                if($getFirstnumberofMobile==0){
                    $TelintaMobile = substr($customer->getMobileNumber(), 1);
                   $TelintaMobile =  '0049'.$TelintaMobile ;
  $Telintambs=$TelintaMobile;

 echo substr($Telintambs, 0,4); echo " ";   echo substr($Telintambs, 4,3);
echo " ";   echo substr($Telintambs, 7,2);
echo " ";   echo substr($Telintambs, 9,2);
echo " ";   echo substr($Telintambs, 11,2);
echo " ";   echo substr($Telintambs, 13,2);
echo " ";   echo substr($Telintambs, 15,2);
                }else{
                  $TelintaMobile = '0049'.$customer->getMobileNumber();

                    $Telintambs=$TelintaMobile;
 echo substr($Telintambs, 0,4); echo " ";   echo substr($Telintambs, 4,3);
echo " ";   echo substr($Telintambs, 7,2);
echo " ";   echo substr($Telintambs, 9,2);
echo " ";   echo substr($Telintambs, 11,2);
echo " ";   echo substr($Telintambs, 13,2);
echo " ";   echo substr($Telintambs, 15,2);
                }
     
          
          ?></span></div>

<?php } ?>

	 <div class="fl cb dashboard-info-text"  ><span   style="padding-right:-10px"><?php echo __('Your status:') ?>:</span><span><?php echo __('active') ?>
        </span></div>
        <p>&nbsp;</p>
        <br/><br/>
	<table cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 30px; margin-bottom: 10px;display:none; ">	
		<tr>
			<td colspan="1" width="45%" style=" padding-left: 8px;
    padding-right: 8px;"><b><?php echo __('Services')?></b></td><td align="right" width="20%" style=" padding-left: 8px;
    padding-right: 8px;"><b><?php echo __('Välj')?></b></td>
			<td></td><td colspan="1">&nbsp;&nbsp;&nbsp;</td>
			<td align="right">&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr class="services" style="line-height: 25px;">
			<td style="background: none repeat scroll 0% 0% rgb(225, 225, 224); padding-left: 8px;
    padding-right: 8px;">
				<span title="Automatisk abonnementsbetaling." class="help">
					<?php echo __('Resenumber') ?>
				</span>
			</td>
			<td align="right" style="background: none repeat scroll 0% 0% rgb(225, 225, 224); padding-left: 8px;
    padding-right: 8px;">
				<b><a href="
            	<?php if($voip_customer!=''){  ?>
                <?php echo url_for('customer/unsubscribevoip?cid='.$customer->getId(), true) ?>
                    <?php }else{ ?>
                        <?php echo url_for('customer/subscribevoip?cid='.$customer->getId(), true) ?>
                    <?php }?>" class="blackcolor submittexts" style="color: #333333; font-family: Trebuchet MS,Helvetica,sans-serif;   font-weight: bold;
    text-decoration: none;"><?php
        
    if($voip_customer!=''){ echo 'Avaktivera'; }else{echo 'Aktivera';
                    
    } ?></a></b>
			</td>
		<td></td></tr>
	</table>
    </div>
  </div>
</div>
  <?php include_partial('sidebar') ?>
