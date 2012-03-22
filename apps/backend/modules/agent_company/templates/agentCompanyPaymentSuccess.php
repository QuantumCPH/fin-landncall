



<div id="sf_admin_container"><h1><?php echo __('Payment History') ?>  (<?php if($agentidd>0){ echo  $agent_company->getName(); }else{ echo  "All Agent Companies"; }   ?>) </h1></div>
    <div id="sf_admin_container">
        <br/>
    <form method="get" action="agentCompanyPayment">


 <label for="agent_commission_agent_company_id">Agent Company</label>
    <select id="agent_commission_agent_company_id" name="agent_company_id">
           <option value="0" selected="selected">All Agnet Componies</option>
     <?php    foreach($Lcompanies as $Lcompany){?>


           <option value="<?php echo $Lcompany->getId();     ?>" <?php if($Lcompany->getId()==$agentidd){ ?> selected="selected" <?php } ?> ><?php echo $Lcompany->getName();   ?></option>


    <?php } ?></select><br/>
 <label for="agent_commission_agent_company_id">Refill By Admin</label><input type="checkbox" value="1" name="expense">
    <input type="submit" name="Agent Company" value="Agent Company Payment History">



</form>
            <br/>
    </div>
 <div class="borderDiv">     
    <table cellspacing="0" width="75%" class="tblAlign">
   
  <tr class="headings">
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
     ?></td>
  <td><?php  echo $agent->getAmount();   ?></td>
    <td><?php  echo $agent->getRemainingBalance();  ?></td>
      <td><?php  echo $agent->getCreatedAt();  ?></td>
      
  </tr>
  <?php  } ?>
  </table>



  </div>
 



