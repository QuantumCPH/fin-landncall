<?php use_helper('I18N') ?>
<?php use_helper('Number') ?>
<style type="text/css">
	table {
		margin-bottom: 10px;
	}
	
	table.summary td {
		font-size: 1.2em;
		font-weight: normal;
	}
</style>
<?php echo link_to(__('Company Info'), 'agentcompany/view',array('class'=>'external_link')) ?>

<?php if($sf_user->isAuthenticated()): ?>
     <?php if($agent_company->getIsPrepaid()): ?>

        <?php echo link_to(__('Account Recharge'), 'affiliate/accountRefill',array('class'=>'external_link')) ?>



        <?php echo link_to(__('Recharge Receipts'), 'affiliate/agentOrder',array('class'=>'external_link')) ?>



    <?php endif; ?>
<?php endif; ?>
 <?php if($agent_company->getIsPrepaid()): ?>
 <?php echo link_to(__('Payment History'), 'affiliate/paymentHistory',array('class'=>'external_link')) ?>
<?php endif; ?>
<br/>
<div class="report_container">
<div id="sf_admin_container"><h1><?php echo __('Payment History') ?></h1></div>
        
 <div class="borderDiv">     
    <table cellspacing="0" width="100%" class="summary">
   
  <tr>
    <th width="25%"><?php echo __('Transaction Type') ?></th>
    <th width="25%"><?php echo __('Amount') ?> </th>
    <th width="25%"><?php echo __('Remaining Balance') ?> </th>
    <th width="25%"><?php echo __('Date') ?> </th>
      
  </tr>
 <?php
    $i = 0;
    foreach($agents as $agent) {
        $i++;
        ?>

  
  <tr <?php echo 'class="'.($i%2 == 0?'odd':'even').'"' ?>>
  <td><?php  $expensetype=$agent->getExpeneseType(); 
    if($expensetype==1){  echo __("Customer Registration");  }
    if($expensetype==2 || $expensetype==4){  echo __("Customer Refill");  }
    if($expensetype==3){  echo __("Agent Account Refill");  }
      if($expensetype==8){  echo __("Agent Account Refill By Admin");  }
      if($expensetype==9){
        $ctd = new Criteria();
        $ctd->add(TransactionDescriptionPeer::ID,$agent->getOrderDescription());        
        $tdd = TransactionDescriptionPeer::doSelectOne($ctd);
        echo $tdd->getTitle();        
      }
     ?></td>
  <td><?php  echo $agent->getAmount();   ?></td>
    <td><?php  echo $agent->getRemainingBalance();  ?></td>
      <td><?php  echo $agent->getCreatedAt();  ?></td>
      
  </tr>
  <?php  } ?>
  </table>



  </div>
</div>



