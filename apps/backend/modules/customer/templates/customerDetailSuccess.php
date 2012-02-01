<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<ul class="customerMenu">
    <li><a style="background-color: #838483;color:#FFFFFF;text-decoration: none;" href="allRegisteredCustomer"><?php echo  __('View All Customer') ?></a></li>
    <li><a style="background-color: #838483;color:#FFFFFF;text-decoration: none;" href="paymenthistory?id=<?php echo $_REQUEST['id'];  ?>"><?php echo  __('Payment History') ?></a></li>
    <li><a style="background-color: #838483;color:#FFFFFF;text-decoration: none;" href="callhistory?id=<?php echo $_REQUEST['id'];  ?>"><?php echo  __('Call History') ?></a></li>
</ul>
    <table width="75%" cellspacing="0" cellpadding="2" class="tblAlign">
                       <tr  style="background-color: #CCCCFF;color: #000000;">
                          <th  width="50%"   style="text-align:left;" ><?php echo  __('Customer Detail') ?></th>
							<td  width="50%" ></td>
                      </tr>
                      
                       <tr   style="background-color: #CCCCFF;color: #000000;">
                          <th  id="sf_admin_list_th_id"  style="float:left;" ><?php echo  __('Description') ?></th>
							<td   >Value</td>
                      </tr>
                          <tr  style="background-color:#FFFFFF">
                    <th    style="float:left;"  ><?php echo  __('Customer Balance') ?></th>
                     <td  ><?php
                           $uniqueId=$customer->getUniqueid();
                         $cuid=$customer->getId();

                          

                                  $cp = new Criteria();
                                  $cp->add(CustomerProductPeer::CUSTOMER_ID, $cuid);
                                  $custmpr = CustomerProductPeer::doSelectOne($cp);
                                   $p = new Criteria();
                                   $p->add(ProductPeer::ID, $custmpr->getProductId());
                                   $products=ProductPeer::doSelectOne($p);
                                   $pus = 0;
                                 

                        $telintaGetBalance=Telienta::getBalance($uniqueId);

        echo  $telintaGetBalance;
          echo "&euro;";
                         
                          
                     ?> </td>
                      </tr>

                     
                   <tr  style="background-color:#EEEEFF">
                    <th    style="float:left;"  ><?php echo  __('Id') ?></th>
                     <td  ><?php  echo $customer->getId() ?></td>
                      </tr>
                     
                      <tr>
                    <th id="sf_admin_list_th_first_name" style="float:left;" ><?php echo  __('First Name') ?></th>
                      <td><?php echo  $customer->getFirstName() ?></td>
                        </tr>
                      <tr   style="background-color:#EEEEFF">
                    <th id="sf_admin_list_th_last_name"  style="float:left;" ><?php echo  __('Last Name') ?></th>
                       <td><?php echo  $customer->getLastName() ?></td>
                          </tr>
                      <tr>
		    <th id="sf_admin_list_th_mobile_number" style="float:left;"  ><?php echo  __('Mobile Number') ?></th>
                      <td><?php echo  $customer->getMobileNumber() ?></td>
                         </tr>
                         <tr  style="background-color:#EEEEFF">

		     <th id="sf_admin_list_th_mobile_number" style="float:left;"  ><?php echo  __('Password') ?></th>
                         <td><?php echo  $customer->getPlainText() ?></td>
                       </tr>
                       
                       
<?php
$val="";
$val=$customer->getReferrerId();
if(isset($val) && $val!=""){  ?>
                      <tr  style="background-color:#EEEEFF">
		    <th id="sf_admin_list_th_agent" style="float:left;" ><?php echo  __('Agent') ?></th>
                    <?php $agent = AgentCompanyPeer::retrieveByPK( $customer->getReferrerId()) ?>
                  <td><?php echo  $agent->getName() ?></td>
                      </tr>
                         <tr>
                      <th id="sf_admin_list_th_agent" style="float:left;" ><?php echo  __('Agent CVR') ?></th>
                      <td><?php echo  $agent->getCvrNumber() ?></td>
		      </tr>

                      <?php } ?>
                         <tr  style="background-color:#EEEEFF">
                      <th id="sf_admin_list_th_address"  style="float:left;" ><?php echo  __('Address') ?></th>
                        <td><?php echo  $customer->getAddress() ?></td>
                      </tr>
                         <tr>
                      <th id="sf_admin_list_th_city"  style="float:left;" ><?php echo  __('City') ?></th>
                        <td><?php echo  $customer->getCity() ?></td>
                      </tr>
                         <tr  style="background-color:#EEEEFF">
                      <th id="sf_admin_list_th_po_box_number"  style="float:left;" ><?php echo  __('PO-BOX Number') ?></th>
                      <td><?php echo  $customer->getPoBoxNumber() ?></td>

                      </tr>
                         <tr>
                      <th id="sf_admin_list_th_email"  style="float:left;" ><?php echo  __('Email') ?></th>
                         <td><?php echo  $customer->getEmail() ?></td>
                      </tr>
                         <tr  style="background-color:#EEEEFF">
                      <th id="sf_admin_list_th_created_at"  style="float:left;" ><?php echo  __('Created At') ?></th>
                            <td><?php echo  $customer->getCreatedAt() ?></td>

  </tr>
                         <tr>

                    <th id="sf_admin_list_th_date_of_birth" style="float:left;" ><?php echo  __('Date Of Birth') ?></th>
                      <td><?php echo  $customer->getDateOfBirth() ?></td>
                      </tr>
                         <tr  style="background-color:#EEEEFF">
                      <th id="sf_admin_list_th_auto_refill" style="float:left;" ><?php echo  __('Auto Refill') ?></th>
                        <?php if ($customer->getAutoRefillAmount()!=NULL && $customer->getAutoRefillAmount()>1){ ?>
                  <td>Yes</td>
                  <?php } else
                      { ?>
                  <td>No</td>
                  <?php } ?>
                        </tr>
                         <tr>
                        <th id="sf_admin_list_th_auto_refill" style="float:left;" ><?php echo  __('Unique ID') ?></th>
                         <td>  <?php  echo $customer->getUniqueid();     ?>   </td>
                        </tr  >
                         <tr style="background-color:#EEEEFF">
                       <th id="sf_admin_list_th_auto_refill" style="float:left;" ><?php echo  __('Active No') ?></th>
                        <td>  <?php  $unid   =  $customer->getUniqueid();
        if(isset($unid) && $unid!=""){
            $un = new Criteria();
            $un->add(CallbackLogPeer::UNIQUEID, $unid);

            $un -> addDescendingOrderByColumn(CallbackLogPeer::CREATED);
            $unumber = CallbackLogPeer::doSelectOne($un);
            echo $unumber->getMobileNumber();            
         }else{  }  ?> </td>
                         </tr>
                         <?php  $uid=0;
                      $uid=$customer->getUniqueid();
                      if(isset($uid) && $uid>0){
                      ?>

<!--                       <tr  style="background-color:#FFFFFF">
                    <th    style="float:left;"  >IMSI number</th>
                     <td  ><?php  //echo $unumber->getImsi();  ?></td>
                      </tr>
                        <tr  style="background-color:#EEEEFF">
                    <th    style="float:left;"  >IMSI Registration Date</th>
                     <td  ><?php // echo $unumber->getCreated();  ?></td>
                      </tr>-->

                      <?php } ?>
<!--                  <tr style="background-color:#EEEEFF">
                       <th id="sf_admin_list_th_auto_refill" style="float:left;" >Resenummer </th>
                        <td>  <?php  $cuid   =  $customer->getId();
        if(isset($cuid) && $cuid!=""){
            $un = new Criteria();
            $un->add(SeVoipNumberPeer::CUSTOMER_ID, $cuid);
            $un->add(SeVoipNumberPeer::IS_ASSIGNED, 1);
             $vounumber = SeVoipNumberPeer::doSelectOne($un);
             if(isset($vounumber)&& $vounumber!="" ){
            echo $vounumber->getNumber();
             }
         }else{  }  ?> </td>
                         </tr>-->

                      

                  
              </table>
              
        




