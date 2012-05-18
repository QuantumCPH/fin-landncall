<div id="sf_admin_container">
    <h1><?php echo __('Select Company') ?></h1><br />
    <form method="get" action="agentCompanyPayment">

 
 <label for="agent_commission_agent_company_id">Agent Company</label>
    <select id="agent_commission_agent_company_id" name="agent_company_id">
           <option value="0" selected="selected">All Agent Componies</option>
     <?php    foreach($Lcompanies as $Lcompany){?>
     

<option value="<?php echo $Lcompany->getId();   ?>"><?php echo $Lcompany->getName();   ?></option>


    <?php } ?></select><br/>
 <label for="agent_commission_agent_company_id">Refill By Admin</label><input type="checkbox" value="1" name="expense"><br/><br/>
    <input type="submit" name="Agent Company" value="Agent Company Payment History" />



</form>
    </div>