<div id="sf_admin_container">
    <h1><?php echo __('Select Company') ?></h1><br />
<form method="post" action="refilAgentCompany">

 
 <label for="agent_commission_agent_company_id">Agent Company</label>
    <select id="agent_commission_agent_company_id" name="agent_company_id">
           <option value="" selected="selected">Select Agnet Compoany</option>
     <?php    foreach($Lcompanies as $Lcompany){?>
     

<option value="<?php echo $Lcompany->getId();   ?>"><?php echo $Lcompany->getName();   ?></option>


    <?php } ?></select>
    <br/>
   <label for="agent_commission_agent_company_id">Refill Amount</label><input type="text" name="refill_amount" ><br/>
    <input type="submit" name="Refill Agent Company" value="Refill Agent Company">



</form>
    </div>