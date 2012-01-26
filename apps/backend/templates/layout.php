<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da" lang="da">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <script type="text/javascript">
    <!--
        // Copyright 2006-2007 javascript-array.com

        var timeout	= 500;
        var closetimer	= 0;
        var ddmenuitem	= 0;

        // open hidden layer
        function mopen(id)
        {
                // cancel close timer
                mcancelclosetime();

                // close old layer
                if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

                // get new layer and show it
                ddmenuitem = document.getElementById(id);
                ddmenuitem.style.visibility = 'visible';

        }
        // close showed layer
        function mclose()
        {
                if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
        }

        // go close timer
        function mclosetime()
        {
                closetimer = window.setTimeout(mclose, timeout);
        }

        // cancel close timer
        function mcancelclosetime()
        {
                if(closetimer)
                {
                        window.clearTimeout(closetimer);
                        closetimer = null;
                }
        }

        // close layer when click-out
        document.onclick = mclose;
    -->
    </script>
  </head>
  <body>
  	<div id="wrapper">
  	<div id="header">
  		<p style="float: right">
  		<?php echo image_tag('/images/zapna_logo_small.png') ?>
  		</p>
  	</div>
    <?php if($sf_user->isAuthenticated()): ?>
      <ul class="admin-navigation">
  		
      </ul>
      <ul id="sddm">
             <li><a href="#"
                onmouseover="mopen('m2')"
                onmouseout="mclosetime()"><?php echo __('B2B') ?></a>
                <div id="m2"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">

                    <?php echo link_to(__('Companies list'), 'company/index') ?>
                    <?php echo link_to(__('Employee lists'), 'employee/index') ?>
                    <?php  echo link_to(__('Payment History'), 'company/paymenthistory') ?>
                    <?php echo link_to(__('Refill'), 'company/refill'); ?>
                
                </div>
            </li>
            <li>
                <a href="#"
                onmouseover="mopen('m5')"
                onmouseout="mclosetime()"><?php echo __('Wls2') ?></a>
                <div id="m5"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">
                    <?php echo link_to(__('All Registered Customer'), 'customer/allRegisteredCustomer'); ?>

                </div>
            </li>

          <li>
                <a href="#"
                onmouseover="mopen('m3')"
                onmouseout="mclosetime()"><?php echo __('Agents') ?></a>
                <div id="m3"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">

                    <?php echo link_to(__('company list'), 'agent_company/index') ?>
                    <?php echo link_to(__('user lists'), 'agent_user/index') ?>

                    <?php echo link_to(__('Agent Per Product'), 'agent_commission/selectCompany') ?>

                    <?php echo link_to(__('agent commission package'), 'agent_commission_package/index') ?>
                </div>
            </li>
<li>
                <a href="#"
                onmouseover="mopen('m7')"
                onmouseout="mclosetime()"><?php echo __('Updates') ?></a>
                <div id="m7"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">

                    <?php echo link_to(__('New Updates'), 'newupdate/index') ?>
                      <?php echo link_to(__('FAQ'), 'faqs/index') ?>
                    <?php echo link_to(__('User Guide'), 'userguide/index') ?>

                </div>
            </li>



          
            <li style="display:none"><a href="#"
                onmouseover="mopen('m2')"
                onmouseout="mclosetime()"><?php echo __('Company') ?></a>
                <div id="m2"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">

                    <?php echo link_to(__('companies list'), 'company/index') ?>
                    <?php echo link_to(__('employee lists'), 'employee/index') ?>
                    <?php echo link_to(__('sale activity'), 'sale_activity/index'); ?>
                    <?php echo link_to(__('support activity'), 'support_activity/index'); ?>
                    <?php echo link_to(__('usage'), 'cdr/index'); ?>
                    <?php echo link_to(__('invoices'), 'invoice/index'); ?>
                    <?php echo link_to(__('product orders'), 'product_order/index') ?>
                </div>
            </li>
            
            <li>
                <a href="#"
                onmouseover="mopen('m4')"
                onmouseout="mclosetime()"><?php echo __('Security') ?></a>
                <div id="m4"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">
                    <?php echo link_to(__('user'), 'user/index'); ?>

                </div>
            </li>
            
            
			
			
          
<li><a href="#"
                onmouseover="mopen('m1')"
                onmouseout="mclosetime()"><?php echo __('Settings') ?></a>
                <div id="m1"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">

                      <?php
                        // As per Omair Instruction - He need these changes - kmmalik - 08/17/2011
                        ?>



                        <?php
                        // As per Omair Instruction - He need these changes - kmmalik - 08/17/2011
                         //echo link_to('<b>Zerocall Setting</b>', '') ?>
                        <a href="javascript:;"><b><?php echo __('WLS2 Setting') ?></b></a>
                        <?php echo link_to(__('Mobile Models'), 'device/index'); ?>
                        <?php echo link_to(__('Mobile Brands'), 'manufacturer/index'); ?>
                        <?php echo link_to(__('Mobile Operator'), 'telecom_operator/index') ?>
                        <?php  echo link_to(__('Postal charges'), 'postal_charges/index') ?>

                        <a href="javascript:;"><b><?php echo __('General Setting') ?> </b></a>
                        <?php echo link_to(__('products'), 'product/index') ?>
                        <?php echo link_to(__('Language Type'), 'enable_country/index') ?>
                        <?php echo link_to(__('Cities'), 'city/index') ?>
                        <?php echo link_to(__('SMS TEXT'), 'sms_text/index') ?>
                        <?php echo link_to(__('Usage Alert'), 'usage_alert/index') ?>
                        <?php echo link_to(__('Usage Alert Sender'), 'usage_alert_sender/index') ?>
                        <?php echo link_to(__('Telecom Operator'), 'telecom_operator/index') ?>
                    


                
                </div>
            </li>


			<li>
                <?php echo link_to(__('Logout'), 'user/logout'); ?>
            </li>
        </ul>
      <?php endif; ?>

      <div style="clear:both"></div>
    <?php echo $sf_content ?>
    </div> <!--  end wrapper -->


    <script type="text/javascript">
jQuery(function(){

	jQuery('#sf_admin_form').validate({
	});
jQuery('#sf_admin_edit_form').validate({

     rules: {
    "company[name]": "required",
     "company[vat_no]": "required",
      "company[post_code]": "required",
       "company[address]": "required",
        "company[contact_name]": "required",
         "company[head_phone_number]": "required",
       "company[email]": "required email"
  }
	});
});
</script>

    <script type="text/javascript">
     jQuery('#company_post_code').blur(function(){
        var poid=jQuery("#company_post_code").val();
        poid = poid.replace(/\s+/g, '');
        var poidlenght=poid.length;
        //alert(poidlenght);
        var poida= poid.charAt(0);
        var poidb= poid.charAt(1);
        var poidc= poid.charAt(2);
        var poidd= poid.charAt(3);
        var poide= poid.charAt(4);
        if(poidlenght>4){
            var fulvalue=poida+poidb+poidc+" "+poidd+poide;
        }else{
           //var fulvalue=poida+poidb+poidc;
        }
       jQuery("#company_post_code").val(fulvalue);
       //  alert(fulvalue);

        });




</script>
    
    <script language="javascript" type="text/javascript">

	jQuery('#company_vat_no').blur(function(){
		//remove all the class add the messagebox classes and start fading
		jQuery("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");

                 var val=jQuery(this).val();

                if(val==''){
                    jQuery("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('Enter Vat Number').addClass('messageboxerror').fadeTo(900,1);
			});
                        jQuery('#error').val("error");
                }else{
		//check the username exists or not from ajax
		jQuery.post("https://wls2.zerocall.com/backend.php/company/vat",{ vat_no:val } ,function(data)
        {//alert(data);
		  if(data=='no') //if username not avaiable
		  {
		  	jQuery("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('This Vat No Already exists').addClass('messageboxerror').fadeTo(900,1);
			});jQuery('#error').val("error");
          }
		  else
		  {
		  	jQuery("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('Vat No is available').addClass('messageboxok').fadeTo(900,1);
			});jQuery('#error').val("");
		  }

        });
                }
	});

        	jQuery('#employee_mobile_number').blur(function(){
		//remove all the class add the messagebox classes and start fading
		jQuery("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
		//check the username exists or not from ajax
                var val=jQuery(this).val();

                if(val==''){
                    jQuery("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('Enter Mobile Number').addClass('messageboxerror').fadeTo(900,1);
			});
                        jQuery('#error').val("error");
                }else{
                    if(val.length >7){

                    if(val.substr(0, 1)==0){
                jQuery("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('Please enter a valid mobile number not starting with 0').addClass('messageboxerror').fadeTo(900,1);
			});
                        jQuery('#error').val("error");
                }else{

		jQuery.post("https://wls2.zerocall.com/backend.php/employee/mobile",{ mobile_no: val} ,function(data)
        {
		  if(data=='no') //if username not avaiable
		  {
		  	jQuery("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('This Mobile No Already exists').addClass('messageboxerror').fadeTo(900,1);
			});jQuery('#error').val("error");
          }
		  else
		  {
		  	jQuery("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{
			  //add message and change the class of the box and start fading
			  jQuery(this).html('Mobile No is available').addClass('messageboxok').fadeTo(900,1);
			});jQuery('#error').val("");
		  }

        });
                }}}
	});

    jQuery("#sf_admin_form").submit(function() {
      if (jQuery("#error").val() == "error") {

        return false;
      }else{
          return true;
      }


    });
       jQuery("#sf_admin_edit_form").submit(function() {
      if (jQuery("#error").val() == "error") {

        return false;
      }else{
          return true;
      }


    });


</script>
<style type="text/css">
.messagebox{
	position:absolute;
	width:100px;
	margin-left:30px;
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	position:absolute;
	width:auto;
	margin-left:30px;
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;

}
.messageboxerror{
	position:absolute;
	width:auto;
	margin-left:30px;
	border:1px solid #CC0000;
	background:#F7CBCA;
	padding:3px;
	font-weight:bold;
	color:#CC0000;
}

</style>
  </body>
</html>
