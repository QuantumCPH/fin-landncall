<?php
use_helper('I18N');
use_helper('Number');
?>
<style>
	p {
		margin: 8px auto;       
	}
	
	table.receipt {
		width: 600px;

		
		border: 2px solid #ccc;
	}
	
	table.receipt td, table.receipt th {
		padding:5px;
	}
	
	table.receipt th {
		text-align: left;
	}
	
	table.receipt .payer_details {
		padding: 10px 0;
	}
	
	table.receipt .receipt_header, table.receipt .order_summary_header {
		font-weight: bold;
		text-transform: uppercase;
	}
	
	table.receipt .footer
	{
		font-weight: bold;
	}
	
	
</style>

<?php
$wrap_content  = isset($wrap)?$wrap:false;

//wrap_content also tells  wheather its a refill or 
//a product order. we wrap the receipt with extra
// text only if its a product order.

 ?>
 
<?php if($wrap_content): ?>
	<p><?php echo __('Hi') ?>&nbsp;<?php echo $customer->getFirstName();?></p>
	

	
	
	<p>
	<?php echo __('We hereby confirm that you have received commissions deposited into your account that you have referred a friend about Smartsim from wls.Gå in to "My Pages" and go to "Other History" under the "Call History" to see what you have earned.') ?>
	</p>
        <p>
            <a href="mailto:Support@wls.com">Support@wls.com</a>
	</p>
        <p>
	<?php echo __('Yours sincerely,') ?>
	</p>
        <p>
	<?php echo __('www.WLS2.zerocall.com') ?>
	</p>
	<br />
<?php endif; ?>
<table width="600px">
	<tr style="border:0px solid #fff">
		<td colspan="4" align="right" style="text-align:right; border:0px solid #fff"><?php echo image_tag('http://wls2.zerocall.com/images/logo.gif');?></td>
	</tr>
</table>

<table class="receipt" cellspacing="0" width="600px">
  <tr bgcolor="#CCCCCC" class="receipt_header">
    <th ><?php echo __('Order Receipt') ?></th>
  
  </tr>
 <tr>
  <th><?php echo __('Bonus Receiver') ?> <?php echo $recepient_name; ?></th>
    </tr>
   <tr>
  <th><?php echo __('Registered Friend') ?> <?php echo sprintf("%s %s", $customer->getFirstName(), $customer->getLastName())?></th>
   </tr>
</table>
</table>
        