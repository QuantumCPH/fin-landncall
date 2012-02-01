<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
                <div class="tableHeading">
                   <span><?php echo  __('All Registered Customer') ?></span>
                </div>
		<table width="75%" cellspacing="0" cellpadding="2" class="tblAlign">
                    <thead>
                        <tr class="headings">
                     <th width="10%" style="text-align: left" ><?php echo  __('Id') ?></th>
                  <th  width="20%" style="text-align: left"  ><?php echo  __('Customer Number') ?></th>
                      <th  width="20%" style="text-align: left" ><?php echo  __('Mobile Number') ?></th>
                       <th width="20%" style="text-align: left" ><?php echo  __('First Name') ?></th>
                    <th  width="20%"  style="text-align: left" ><?php echo  __('Last Name') ?></th>
                       <th  width="20%"  style="text-align: left" ><?php echo  __('Unique ID') ?></th>


                    <th width="10%" style="text-align: left" class='last'> <?php echo  __('Action') ?></th>
                        </tr>
		                  </thead>
                  <tfoot>
                    <tr><th colspan="7">
                    <div class="float:right">
                    </div>
                    <?php echo count($customers)." - Results" ?></th></tr>
                  </tfoot>
                  <tbody>
                         <?php   $incrment=1;    ?>
                <?php foreach($customers as $customer): ?>

                 <?php
//                  if($incrment%2==0){
//                  $colorvalue="#FFFFFF";
//                  }else{
//
//                      $colorvalue="#EEEEFF";
//                      }
//                  
                  ?>

                      <tr style="background-color:#EFEDED<?php //echo $colorvalue;   ?>">
                      <td><?php echo $incrment;  ?></td>
                  <td><?php  echo $customer->getId() ?></td>
                   <td><?php echo  $customer->getMobileNumber() ?></td>
                  <td><?php echo  $customer->getFirstName() ?></td>
                    <td><?php echo  $customer->getLastName() ?></td>
                       <td><?php echo  $customer->getUniqueid() ?></td>
                 <td class='last'><a href="customerDetail?id=<?php  echo $customer->getId() ?>"><img alt="view Detail" title="view Detail" src="http://admin.zerocall.com/sf/sf_admin/images/default_icon.png" ></a>
                      </td>
             
                </tr>
<?php   $incrment++;    ?>
                <?php endforeach; ?>
                  </tbody>
              </table>
                </div>
            </li>

          </ul>




