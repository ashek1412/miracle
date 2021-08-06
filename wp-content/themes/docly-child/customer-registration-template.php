<style>
     

.customer-registration .form-group1.planInterval input[type=radio] {
    width: auto !important;
}
#newCustomerForm .cotrol1 {
    width: 250px;
}
#PlanCheckoutModal .form-block .row {
  border: 1px solid #e8e8e8;
  border-radius: 5px;
  margin: 0;
  padding: 15px 0;
  margin-bottom: 15px;
}
#PlanCheckoutModal .form-block .row.paymentButton {
  border: none;
}
#PlanCheckoutModal .form-block .form-group1 .form-control1 {
  height: 32px;
  border-radius: 4px;
  border: 1px solid #e1e8ea;
  font-size: 14px;
  line-height: 1.4;
  padding-left: 15px;
  width: 100%;
}
#PlanCheckoutModal .form-block .form-group1 select.form-control1 {
  width: 49%;
}
#PlanCheckoutModal .form-block .form-group1 label {
  display: block;
  font-weight: 400;
  font-size: 14px;
}
#PlanCheckoutModal .form-block .submit-btn {
  font-size: 14px;
  font-weight: 500;
  padding: 10px 25px;
  text-align: center;
  border-radius: 4px;
  border: 2px solid #007bff;
  transition: all 0.3s linear;
  background: #fff;
  color: #007bff;
  width: 200px;
}

.blog_comment_box .get_quote_form .form-group1 .form-control1.denger {
    border-color: red!important;
}
.ui-widget.ui-widget-content{
    min-height: 50px;
    overflow: scroll;
    max-height: 250px;
}
.form_step_2 {
    opacity: 0.2;
    pointer-events: none;
}

.form_step_3 {
    opacity: 0.2;
    pointer-events: none;
}

.planList label,
.planList input[type=checkbox], 
.planList input[type=radio] {
    cursor: pointer;
}
.customer-registration .comment-respond .get_quote_form .form-block .row .child_block1 .row,
.customer-registration .comment-respond .get_quote_form .form-block .row .child_block2 .row {
    border: none;
    padding:0;
    margin-bottom: 0px;
}
.customer-registration .comment-respond .get_quote_form .form-block .row .child_block1 {
    border-right: 1px solid #e8e8e8;
    border-radius: 0;
}


.ajax-loader {
    visibility: hidden;
    background-color: rgba(255,255,255,0.7);
    position: absolute;
    z-index: 999 !important;
    width: 100%;
    height:100%;
}

.ajax-loader img {
    position: relative;
    top:50%;
    left:50%;
}
/*#overlay {*/
/*    background: #ffffff;*/
/*    color: #666666;*/
/*    position: fixed;*/
/*    height: 100%;*/
/*    width: 100%;*/
/*    z-index: 5000;*/
/*    top: 0;*/
/*    left: 0;*/
/*    float: left;*/
/*    text-align: center;*/
/*    padding-top: 25%;*/
/*    opacity: 1;*/
/*}*/
/*.spinner {*/
/*    margin: 0 auto;*/
/*    height: 64px;*/
/*    width: 64px;*/
/*    animation: rotate 0.8s infinite linear;*/
/*    border: 5px solid firebrick;*/
/*    border-right-color: transparent;*/
/*    border-radius: 50%;*/
/*}*/
/*@keyframes rotate {*/
/*    0% {*/
/*        transform: rotate(0deg);*/
/*    }*/
/*    100% {*/
/*        transform: rotate(360deg);*/
/*    }*/
/*}*/
</style>

<?php
/**
 * Template Name: Customer Registration
 */

 

get_header();


?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  
<?php
$opt = get_option('docly_opt');
$padding = "";

$is_forum_btm_c2a = isset($opt['is_forum_btm_c2a']) ? $opt['is_forum_btm_c2a'] : '1';
$wrap_class = 'page_wrapper';
if ( class_exists('bbPress') ) {
    $wrap_class .= is_post_type_archive('forum') || is_post_type_archive('topic') || is_singular('forum') ? ' forum-page-content' : '';
}

while ( have_posts() ) : the_post();
    ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">



    <div class="sec_pad <?php echo esc_attr($wrap_class) ?>" style="padding:50px 0px;">
        <div class="container">

            
            <div class="blog_comment_box no_comments customer-registration">
                <div id="respond" class="comment-respond ">

                     <form action="#" method="POST" id="newCustomerForm" class="get_quote_form row" novalidate="">
                        <div class="row ">
                            <div class="col-md-6 form-block">
                                <label>Contact Information</label>

                                <div class="row">
                                    <div class="col-md-6 form-group1">  
                                        <label>Customer ID *</label>
                                        <input type="text" class="form-control1" name="referenceCustomerId" id="referenceCustomerId" value="" placeholder="Customer ID " aria-required="true" required>

                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>First Name *</label>
                                        <input type="text" class="form-control1" name="firstName" id="firstName" value="" placeholder="First Name" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Last Name *</label>
                                        <input type="text" class="form-control1" name="lastName" id="lastName" value="" placeholder="Last Name" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Email</label>
                                        <input type="email" class="form-control1" name="primaryEmail" id="primaryEmail" value="" placeholder="Email" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control1" name="primaryPhone" id="primaryPhone" value="" placeholder="Phone" aria-required="true" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-block dropdown">
                                <label>Plan Location and Duration Information</label>
                                <div class="row">
                                  <div class="col-md-6 form-group1">
                                    <label for="cars">Select a Location *</label>

                                    <select id="cars" class="form-control1 cotrol1" name="location_fusebill" id="location_fusebill"   aria-required="true" required>
                                      <option value="">All Locations</option>
                                      <option value="Aberdeen">Aberdeen</option>
                                      <option value="Administrative Office">Administrative Office</option>
                                      <option value="Albany">Albany</option>
                                      <option value="Auburn">Auburn</option>
                                      <option value="Baker City">Baker City</option>
                                      <option value="Beaverton">Beaverton</option>
                                      <option value="Bellevue">Bellevue</option>
                                      <option value="Billings">Billings</option>
                                      <option value="Boise">Boise</option>
                                      <option value="Boise Park Center">Boise Park Center</option>
                                      <option value="Bozeman">Bozeman</option>
                                      <option value="Butte">Butte</option>
                                      <option value="Butte">Butte</option>
                                      <option value="Casper">Casper</option>
                                      <option value="Chehalis">Chehalis</option>
                                      <option value="Cheyenne">Cheyenne</option>
                                      <option value="Coeur D'Alene">Coeur D'Alene</option>
                                      <option value="Colville">Colville</option>
                                      <option value="Eagle">Eagle</option>
                                      <option value="East Vancouver">East Vancouver</option>
                                      <option value="East Wenatchee">East Wenatchee</option>
                                      <option value="Ellensburg">Ellensburg</option>
                                      <option value="Emmett">Emmett</option>
                                      <option value="Enterprise">Enterprise</option>
                                      <option value="Enumclaw">Enumclaw</option>
                                      <option value="Eugene">Eugene</option>
                                      <option value="Everett">Everett</option>
                                      <option value="Fairbanks">Fairbanks</option>
                                      <option value="Federal Way">Federal Way</option>
                                      <option value="Florence">Florence</option>
                                      <option value="Gig Harbor">Gig Harbor</option>
                                      <option value="Glendive">Glendive</option>
                                      <option value="Grants Pass">Grants Pass</option>
                                      <option value="Great Falls">Great Falls</option>
                                      <option value="Gresham">Gresham</option>
                                      <option value="Havre">Havre</option>
                                      <option value="Helena">Helena</option>
                                      <option value="Hermiston SC">Hermiston SC</option>
                                      <option value="Hilo">Hilo</option>
                                      <option value="Honolulu">Honolulu</option>
                                      <option value="Hood River">Hood River</option>
                                      <option value="Kennewick">Kennewick</option>
                                      <option value="Klamath Falls">Klamath Falls</option>
                                      <option value="Kona">Kona</option>
                                      <option value="Kona">Kona</option>
                                      <option value="La Grande">La Grande</option>
                                      <option value="Lewiston">Lewiston</option>
                                      <option value="Lincoln City SC">Lincoln City SC</option>
                                      <option value="Lynnwood">Lynnwood</option>
                                      <option value="Maui">Maui</option>
                                      <option value="McCall">McCall</option>
                                      <option value="McMinnville">McMinnville</option>
                                      <option value="Medford">Medford</option>
                                      <option value="Meridian">Meridian</option>
                                      <option value="Miles City">Miles City</option>
                                      <option value="Moses Lake">Moses Lake</option>
                                      <option value="Nampa">Nampa</option>
                                      <option value="Newport">Newport</option>
                                      <option value="North Bend">North Bend</option>
                                      <option value="Omak">Omak</option>
                                      <option value="Ontario">Ontario</option>
                                      <option value="Oregon City">Oregon City</option>
                                      <option value="Pendleton">Pendleton</option>
                                      <option value="Port Angeles">Port Angeles</option>
                                      <option value="Port Hadlock">Port Hadlock</option>
                                      <option value="Portland">Portland</option>
                                      <option value="Puyallup">Puyallup</option>
                                      <option value="Roseburg">Roseburg</option>
                                      <option value="SC - Gillette">SC - Gillette</option>
                                      <option value="SC - Rawlins">SC - Rawlins</option>
                                      <option value="SC - Sheridan">SC - Sheridan</option>
                                      <option value="SC - Torrington">SC - Torrington</option>
                                      <option value="Salem">Salem</option>
                                      <option value="Sandpoint">Sandpoint</option>
                                      <option value="Sequim">Sequim</option>
                                      <option value="Shelton">Shelton</option>
                                      <option value="Shoreline">Shoreline</option>
                                      <option value="Silverdale">Silverdale</option>
                                      <option value="Soldotna">Soldotna</option>
                                      <option value="Spokane Northtown">Spokane Northtown</option>
                                      <option value="Spokane Valley">Spokane Valley</option>
                                      <option value="Tacoma">Tacoma</option>
                                      <option value="Tillamook">Tillamook</option>
                                      <option value="Tukwila">Tukwila</option>
                                      <option value="Vancouver">Vancouver</option>
                                      <option value="Village Park">Village Park</option>
                                      <option value="Walla Walla">Walla Walla</option>
                                      <option value="Warrenton">Warrenton</option>
                                      <option value="Windward">Windward</option>
                                      <option value="Yakima">Yakima</option>
                                  </select>

                                     <div class="row1">
                                      <div class="ol-md-121 form-group1">

                                          <label></br>Payment Date *</label>
                                          <input type="date" class="form-control1 cotrol1" name="payment_date" id="payment_date" value=""   required>
                                      </div>
                                      </div>

                                </div>
                                    <div class="col-md-6 form-group1">
                                        <div class="row1">
                                            <div class="col-md-121 form-group1">
                                                <label>L Warranty Expiry *</label>
                                                <input type="date" class="form-control1 cotrol1"  name="adContent" id="l_warranty_expiry" value="" placeholder="L Warranty Expiry" required>
                                            </div>
                                            <div class="col-md-121 form-group1 checkbox samedate">
                                                <div class="samedate">
                                                    <input type="checkbox" name="sameAsLwarrentyData" id="sameAsLwarrentyData" value="" placeholder="Same as L Warranty Expiry Date" aria-required="true" >
                                                    <label for="sameAsLwarrentyData">Same as L Warranty Expiry Date</label>
                                                </div>
                                                            </div>
                                            <div class="col-md-121 form-group1">
                                                <label>R Warranty Expiry *</label>
                                                <input type="date" class="form-control1 cotrol1" name="campaign" id="r_warranty_expiry"  value="" placeholder="R Warranty Expiry" aria-required="true" required>
                                                    <input type="hidden" class="form-control1" name="date_diffrent" id="date_diffrent"  value="">
                                            </div>
                                            <div class="col-md-121 form-group1">
                                                <label><?php esc_html_e( '&nbsp;', 'docly' ); ?></label>
                                                 <input type="text" class="form-control1" name="planMonths" id="planMonths" value="" placeholder="" aria-required="true" required style="width: 150px;"> Months
                                                <input type="hidden" class="form-control1" name="planCode" id="date_diffrent"  value="">
                                            </div>
                                            <div class="col-md-121 form-group1 planInterval">
                                                <label>Select a plan Interval</label>
                                                <input type="radio" name="earningInterval" value="Monthly" checked> Monthly
                                                <input type="radio" name="earningInterval" value="Yearly"> Annual
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="ajax-loader">
                                <img src="<?php echo get_template_directory_uri().'/assets/img/ajax-loader.gif'; ?>" class="img-responsive" />
                            </div>
                            <div id="overlay" style="display:none;">
                                <div class="spinner"></div>
                                <br/>
                                Loading...
                            </div>
                            
                            <div class="col-md-12 form-block form_1_button" >
                                <div class="planperiode nice-select custom-select open text-center">
                                    <input type="hidden" name="action" value="addCustomer"/>
                                    <button type="submit" id="button" class="submit-btn">Next</button>

                                </div>
                            </div>
                        </div>
                    </form>
                     
                    <form action="#" name="customerInformationForm2" method="POST" id="customerInformationForm2" class="get_quote_form available_plan_list form_step_2" >
                        <div class="row form-block">
                            <div class="col-md-12 dropdown">
                                <div class="plan-list">
                                  <p>Health Services Protection Plan</p>
                                  <table class="planList">
                                    <thead>
                                      <tr>
                                        <th>Select Plan</th> 
                                        <th>Plan Name</th> 
                                        <th>Quantity</th>
                                        <th> Price</th>
                                        <th>Totals</th> 
                                      </tr>
                                    </thead>
                                  <tbody class="planListHtml">
        <tr>
          <td class="text-center">
            <input type="radio" name="planFrequencyID" id="54057" value="54057" ></td>
          <td><label >Secure+ Plan Supplemental Repair Warranty</label>
            <input type="hidden" name="planName" value="Secure+ Plan Supplemental Repair Warranty" class="planName" style="width: 75px;" >
            <input type="hidden" name="planCode" id="planCode" value="secureplusplansupplementalrepairwarranty" class="planCode" style="width: 75px;" >
              <input type="hidden" name="productId" id="secureplusplansupplementalrepairwarranty" value="" class="productId" style="width: 75px;" >
           </td>
          <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" ></td>
          <td>
            <span>$49.95</span>
            <input type="hidden" name="planPrice" value="49.95" class="planPrice">
            <input type="hidden" name="mplanPrice" value="49.95" class="mplanPrice">
          </td>
          <td><input type="text" name="planTotalPrice" value="49.95" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
        </tr>
          <tr>
            <td class="text-center">
            <input type="radio" name="planFrequencyID" id="54058" value="54058"></td>
            <td><label >Secure Plan Supplemental Repair Warranty (Single Aid)
                <input type="hidden" name="planName" value="Secure Plan Supplemental Repair Warranty (Single Aid)" class="planName" style="width: 75px;" >
                    <input type="hidden" name="planCode" id="planCode" value="secureplansupplementalrepairwarrantysingleaid" class="planCode" style="width: 75px;" >
                    <input type="hidden" name="productId" id="secureplansupplementalrepairwarrantysingleaid" value="" class="productId" style="width: 75px;" >
                </label></td>
            <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled">
            </td>
            <td>
            <span>$21.45</span>
            <input type="hidden" name="planPrice" value="21.45" class="planPrice">
            <input type="hidden" name="mplanPrice" value="21.45" class="mplanPrice">
            </td>
            <td><input type="text" name="planTotalPrice" value="21.45" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
          </tr>
              <tr>
                <td class="text-center">
                <input type="radio" name="planFrequencyID" id="54059" value="54059"></td>
                <td><label >Protection+ Supplemental Loss & Damage (Single Aid)</label>
                <input type="hidden" name="planName" value="Protection+ Supplemental Loss and Damage (Single Aid)" class="planName" style="width: 75px;" >
                <input type="hidden" name="planCode"   id="planCode"  value="protectionsupplementallossdamagesingleaid" class="planCode" style="width: 75px;" >
                    <input type="hidden" name="productId" id="protectionsupplementallossdamagesingleaid" value="" class="productId" style="width: 75px;" >
              </td>
                <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled">
                </td>
                <td>
                <span>$14.45</span>
                <input type="hidden" name="planPrice" value="14.45" class="planPrice">
                <input type="hidden" name="mplanPrice" value="14.45" class="mplanPrice">
                </td>
                <td><input type="text" name="planTotalPrice" value="14.45" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
              </tr>
                  <tr>
                    <td class="text-center">
                    <input type="radio" name="planFrequencyID" id="54060" value="54060"></td>
                    <td><label >Secure Plan Supplemental Repair Warranty</label>
                      <input type="hidden" name="planName" value="Secure Plan Supplemental Repair Warranty" class="planName" style="width: 75px;" >
                        <input type="hidden" name="planCode"   id="planCode"  value="secureplansupplementalrepairwarranty" class="planCode" style="width: 75px;" >
                        <input type="hidden" name="productId" id="secureplansupplementalrepairwarranty" value="" class="productId" style="width: 75px;" >


                    </td>
                    <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled"></td>
                    <td>
                    <span>$21.95</span>
                    <input type="hidden" name="planPrice" value="21.95" class="planPrice">
                    <input type="hidden" name="mplanPrice" value="21.95" class="mplanPrice">
                    </td>
                    <td><input type="text" name="planTotalPrice" value="21.95" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
                  </tr>
                    <tr>
                      <td class="text-center">
                      <input type="radio" name="planFrequencyID" id="54058" value="54058"></td>
                      <td><label >Protection + Supplemental Loss & Damage</label>
                      <input type="hidden" name="planName" value="Protection + Supplemental Loss and Damage" class="planName" style="width: 75px;" >
                      <input type="hidden" name="planCode" value="protectionsupplementallossdamage" class="planCode" style="width: 75px;" >
                          <input type="hidden" name="productId" id="protectionsupplementallossdamage" value="" class="productId" style="width: 75px;" >


                      </td>
                      <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled"></td>
                      <td>
                      <span>$14.95</span>
                      <input type="hidden" name="planPrice" value="14.95" class="planPrice">
                      <input type="hidden" name="mplanPrice" value="14.95" class="mplanPrice">
                      </td>
                      <td><input type="text" name="planTotalPrice" value="14.95" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <input type="radio" name="planFrequencyID" id="61933" value="61933"></td>
                          <td><label >Monthly Battery Service </label>
                            <input type="hidden" name="planName" value="Monthly Battery Service" class="planName" style="width: 75px;" >
                            <input type="hidden" name="planCode" value="batteryplan" class="planCode" style="width: 75px;" >
                            <input type="hidden" name="productId" id="batteryplan" value="" class="productId" style="width: 75px;" >


                        </td>
                        <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled"></td>
                        <td>
                            <span>$8.95</span>
                            <input type="hidden" name="planPrice" value="8.95" class="planPrice">
                            <input type="hidden" name="mplanPrice" value="8.95" class="mplanPrice">
                        </td>
                        <td><input type="text" name="planTotalPrice" value="8.95" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
                    </tr>


                                    </tbody>
                                    <tfoot>
                                      <tr>
                                          <td colspan="3"></td>
                                          <td>Initial Charge:</td>
                                          <td class="totalAmount"><input type="text" name="totalPrice" class="totalPrice" value="0" disabled="" style="width: 100px; text-align: right;"></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12 form-block">
                                <label>Product Information</label>
                                <div class="row">
                                    <div class="col-md-6 form-group1 child_block1">
                                        <div class="row">
                                            <div class="col-md-6 form-group1">
                                                <label>Chargeable *</label>
                                                <select required="" id="reference3" name="reference3" class="form-control1" required>
                                                   <option value="" selected="" disabled="" hidden="">Yes or No</option>
                                                   <option>Yes</option>
                                                   <option>No</option>
                                                </select>
                                            </div>

<!--                                            <div class="col-md-6 form-group1">-->
<!--                                                <label>Referrer *</label>-->
<!--                                                <input type="text" class="form-control1" name="reference1" id="reference1" value="" placeholder="Referrer" aria-required="true" required>-->
<!--                                            </div>-->
                                            <div class="col-md-6 form-group1">
                                                <label>Serial # Left *</label>
                                                <input type="text" class="form-control1" name="serial_left_medium" id="serial_left" value="" placeholder="Serial # Left" aria-required="true" required>
                                            </div>
                                            <div class="col-md-6 form-group1">
                                                <label>Serial # Right *</label>
                                                <input type="text" class="form-control1" name="serial_right_source" id="serial_right" value="" placeholder="Serial # Right" aria-required="true" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group1 child_block2">
                                        <div class="row">                                    
                                            <div class="col-md-12 form-group1">
                                                <label>L Battery Size *</label>
                                                <select required="" id="landingPage" name="landingPage" class="form-control1" required>
                                                   <option value="" selected="" disabled="" hidden="">Pick appropriate Battery.  Choose NONE of not applicable.</option>
                                                   <option>NONE</option>
                                                   <option>675</option>
                                                   <option>312</option>
                                                   <option>13</option>
                                                   <option>10</option>
                                                   <option>312-Rechargeable</option>
                                                   <option>13-Rechargeable</option>
                                                   <option>Lithium Batteries</option>
                                                </select>                       
                                            </div>
                                            <div class="col-md-12 form-group1">
                                                <label>R Battery Size *</label>
                                                <select required="" id="keyword" name="keyword" class="form-control1" required>
                                                   <option value="" selected="" disabled="" hidden="">Pick appropriate Battery.  Choose NONE of not applicable.</option>
                                                   <option>NONE</option>
                                                   <option>675</option>
                                                   <option>312</option>
                                                   <option>13</option>
                                                   <option>10</option>
                                                   <option>312-Rechargeable</option>
                                                   <option>13-Rechargeable</option>
                                                   <option>Lithium Batteries</option>
                                                </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-block">
                                <label>Shipping Address</label>
                                <div class="row">
                                    <div class="col-md-6 form-group1">
                                        <label>Shipping Contact *</label>
                                        <input type="text" class="form-control1" name="contactName" id="contactName" value="" placeholder="Shipping Contact *" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Shipping Instructions</label>
                                        <input type="text" class="form-control1" name="shippingInstructions" id="shippingInstructions" value="" placeholder="Shipping Instructions" >
                                    </div> 
                                    <div class="col-md-6 form-group1">
                                        <label>Address 1 *</label>
                                        <input type="text" class="form-control1" name="shipping_address_1" id="shipping_address_1" value="" placeholder="Address 1" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control1" name="shipping_address_2" id="shipping_address_2" value="" placeholder="Address 2" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>City *</label>
                                        <input type="text" class="form-control1" name="shipping_city" id="shipping_city" value="" placeholder="City" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label for="country">Country *</label>
                                        <select  class="form-control1" name="shipping_country" id="shipping_country" >
                                           <option value=""> - Select -</option>
                                            <option value="840">United States</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label for="cars">State *</label>
                                       <!-- <select id="shipping_state" class="form-control1" name="shipping_state">
                                          <option value=""> - Select -</option>  -->
                                           <?php                                        
                                            // $APIKEY = "MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ";
                                            // //setup the request, you can also use CURLOPT_URL
                                            // //$ch = curl_init('https://secure.fusebill.com/v1/customers?pageNumber=0&pageSize=10');
                                            // $ch = curl_init('https://secure.fusebill.com/v1/Countries');

                                            // // Returns the data/output as a string instead of raw data
                                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                            // //Set your auth headers
                                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            //    'Content-Type: application/json',
                                            //    'Authorization: Basic ' . $APIKEY
                                            //    ));

                                            // // get stringified data/output. See CURLOPT_RETURNTRANSFER
                                            // $data = json_decode(curl_exec($ch),true);

                                            // $states = $data[0]['states'];
                                            // foreach ($states as $key => $state) {
                                                ?>
                                                <!-- <option value="<?php //echo $state['id'] ?>"><?php //echo $state['name'] ?></option> -->
                                                 <?php
                                            // }
                                            ?>

                                         <!-- </select> -->
                                      <select id="shipping_state" class="form-control1" name="shipping_state">
                                        <option value=""> - Select -</option> 
                                        <option value="100">AA</option>
                                        <option value="101">AE</option>
                                        <option value="15">Alabama</option>
                                        <option value="14">Alaska</option>
                                        <option value="102">AP</option>
                                        <option value="16">Arizona</option>
                                        <option value="17">Arkansas</option>
                                        <option value="18">California</option>
                                        <option value="19">Colorado</option>
                                        <option value="20">Connecticut</option>
                                        <option value="21">Delaware</option>
                                        <option value="22">District of Columbia</option>
                                        <option value="23">Florida</option>
                                        <option value="24">Georgia</option>
                                        <option value="25">Hawaii</option>
                                        <option value="26">Idaho</option>
                                        <option value="27">Illinois</option>
                                        <option value="28">Indiana</option>
                                        <option value="29">Iowa</option>
                                        <option value="30">Kansas</option>
                                        <option value="31">Kentucky</option>
                                        <option value="32">Louisiana</option>
                                        <option value="33">Maine</option>
                                        <option value="34">Maryland</option>
                                        <option value="35">Massachusetts</option>
                                        <option value="36">Michigan</option>
                                        <option value="37">Minnesota</option>
                                        <option value="38">Mississippi</option>
                                        <option value="39">Missouri</option>
                                        <option value="40">Montana</option>
                                        <option value="41">Nebraska</option>
                                        <option value="42">Nevada</option>
                                        <option value="43">New Hampshire</option>
                                        <option value="44">New Jersey</option>
                                        <option value="45">New Mexico</option>
                                        <option value="46">New York</option>
                                        <option value="47">North Carolina</option>
                                        <option value="48">North Dakota</option>
                                        <option value="49">Ohio</option>
                                        <option value="50">Oklahoma</option>
                                        <option value="51">Oregon</option>
                                        <option value="52">Pennsylvania</option>
                                        <option value="53">Puerto Rico (see also separate entry under PR)</option>
                                        <option value="54">Rhode Island</option>
                                        <option value="55">South Carolina</option>
                                        <option value="56">South Dakota</option>
                                        <option value="57">Tennessee</option>
                                        <option value="58">Texas</option>
                                        <option value="59">Utah</option>
                                        <option value="60">Vermont</option>
                                        <option value="61">Virginia</option>
                                        <option value="62">Washington</option>
                                        <option value="63">West Virginia</option>
                                        <option value="64">Wisconsin</option>
                                        <option value="65">Wyoming</option>
                                      </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Zipcode *</label>
                                        <input type="text" class="form-control1" name="shipping_zipcode" id="shipping_zipcode" value="" placeholder="Zipcode" aria-required="true">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 form-block">
                                <label>Billing Address</label>
                                <div class="row">
                                    <div class="col-md-12 form-group1 checkbox">
                                        <label>Same as Shipping Address</label>
                                        <input type="checkbox" name="useBillingAddressAsShippingAddress" id="useBillingAddressAsShippingAddress" value="true" placeholder="Same as billing" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Address 1 *</label>
                                        <input type="text" class="form-control1" name="billing_address_1" id="billing_address_1" value="" placeholder="Address 1" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control1" name="billing_address_2" id="billing_address_2" value="" placeholder="Address 2" aria-required="true" >
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>City *</label>
                                        <input type="text" class="form-control1" name="billing_city" id="billing_city" value="" placeholder="City" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label for="country">Country *</label>
                                        <select  class="form-control1" name="billing_country" id="billing_country"  required>
                                            <option value=""> - Select -</option>
                                            <option value="840">United States</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label for="cars">State *</label>
                                       <!--  <select  class="form-control1" name="billing_state" id="billing_state" required>
                                          <option value=""> - Select -</option> -->
                                           <?php                                        
                                            // $APIKEY = "MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ";
                                            // //setup the request, you can also use CURLOPT_URL
                                            // //$ch = curl_init('https://secure.fusebill.com/v1/customers?pageNumber=0&pageSize=10');
                                            // $ch = curl_init('https://secure.fusebill.com/v1/Countries');

                                            // // Returns the data/output as a string instead of raw data
                                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                            // //Set your auth headers
                                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            //    'Content-Type: application/json',
                                            //    'Authorization: Basic ' . $APIKEY
                                            //    ));

                                            // // get stringified data/output. See CURLOPT_RETURNTRANSFER
                                            // $data = json_decode(curl_exec($ch),true);

                                            // $states = $data[0]['states'];
                                            // foreach ($states as $key => $state) {



                                            // }
                                            ?>
                                        <!-- </select> -->
                                        <select  class="form-control1" name="billing_state" id="billing_state" required>
                                            <option value=""> - Select -</option> 
                                            <option value="100">AA</option>
                                            <option value="101">AE</option>
                                            <option value="15">Alabama</option>
                                            <option value="14">Alaska</option>
                                            <option value="102">AP</option>
                                            <option value="16">Arizona</option>
                                            <option value="17">Arkansas</option>
                                            <option value="18">California</option>
                                            <option value="19">Colorado</option>
                                            <option value="20">Connecticut</option>
                                            <option value="21">Delaware</option>
                                            <option value="22">District of Columbia</option>
                                            <option value="23">Florida</option>
                                            <option value="24">Georgia</option>
                                            <option value="25">Hawaii</option>
                                            <option value="26">Idaho</option>
                                            <option value="27">Illinois</option>
                                            <option value="28">Indiana</option>
                                            <option value="29">Iowa</option>
                                            <option value="30">Kansas</option>
                                            <option value="31">Kentucky</option>
                                            <option value="32">Louisiana</option>
                                            <option value="33">Maine</option>
                                            <option value="34">Maryland</option>
                                            <option value="35">Massachusetts</option>
                                            <option value="36">Michigan</option>
                                            <option value="37">Minnesota</option>
                                            <option value="38">Mississippi</option>
                                            <option value="39">Missouri</option>
                                            <option value="40">Montana</option>
                                            <option value="41">Nebraska</option>
                                            <option value="42">Nevada</option>
                                            <option value="43">New Hampshire</option>
                                            <option value="44">New Jersey</option>
                                            <option value="45">New Mexico</option>
                                            <option value="46">New York</option>
                                            <option value="47">North Carolina</option>
                                            <option value="48">North Dakota</option>
                                            <option value="49">Ohio</option>
                                            <option value="50">Oklahoma</option>
                                            <option value="51">Oregon</option>
                                            <option value="52">Pennsylvania</option>
                                            <option value="53">Puerto Rico (see also separate entry under PR)</option>
                                            <option value="54">Rhode Island</option>
                                            <option value="55">South Carolina</option>
                                            <option value="56">South Dakota</option>
                                            <option value="57">Tennessee</option>
                                            <option value="58">Texas</option>
                                            <option value="59">Utah</option>
                                            <option value="60">Vermont</option>
                                            <option value="61">Virginia</option>
                                            <option value="62">Washington</option>
                                            <option value="63">West Virginia</option>
                                            <option value="64">Wisconsin</option>
                                            <option value="65">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Zipcode *</label>
                                        <input type="text" class="form-control1" name="billing_zipcode" id="billing_zipcode" value="" placeholder="Zipcode" aria-required="true" required>
                                    </div> 
                                </div>
                            </div>
                            <div class="ajax-loader">
                                <img src="<?php echo get_template_directory_uri().'/assets/img/ajax-loader.gif'; ?>" class="img-responsive" />
                            </div>
                            <div class="col-md-12 form-block">
                              <table class="customerDataHtml" style="display: none;"></table>
                                <input type="hidden" name="action" value="customerInformationForm2"/>
                                <button type="submit" id="button" class="submit-btn">Submit</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
            <?php
            the_content();
            wp_link_pages(array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'docly' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'docly' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ));
            ?>
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?> 
        </div>
    </div>

     <!-- Marketing Current Code Modal -->
      <div class="modal fade" id="PlanCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
                                      <div class="ajax-loader">
                                          <img src="<?php echo get_template_directory_uri().'/assets/img/ajax-loader.gif'; ?>" class="img-responsive" />
                                      </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="current-cole-list form-block">
                <form action="#" method="POST" id="planCheckoutForm" class="get_quote_form" novalidate="">
                  <h4 class="c_head">Plan Checkout</h4>
                  <div class="container form-block">
                    <label>Selected Plan</label>
                    <div class="row form-block" style="margin-bottom:15px;">
                      <div class="col-md-12">
                        <table class="table">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Amount</th>
                          </tr>
                          <tr class="selected_plan_html">
                            <td>
                              Protection + Supplemental Loss &amp; Damage
                              <input type="hidden" name="planName">
                            </td>
                            <td>
                              1
                              <input type="hidden" name="planQty">
                            </td>
                            <td>
                              $14.95
                              <input type="hidden" name="planPrice">
                            </td>
                            <td>
                              $14.95
                              <input type="hidden" name="planTotalPrice">
                            </td>
                          </tr>
                          <tr class="selected_plan_price_html">
                            <td colspan="3" style="text-align: right">Subtotal:<br>Pending Charges:</td>
                            <td>
                              $14.95<br>
                              $14.95
                              <input type="hidden" name="Subtotal" value="$14.95">
                            </td>
                          </tr>
                        </table> 
                      </div>
                    </div>
                    <label>Payment Menthod</label>
                    <div class="row" style="margin-bottom: 15px;">
                      <div class="col-md-12">
                        <label>Pay With</label>
                        <input type="radio" name="paymentMethod" value="CreditCard" checked=""> Credit Card
                        <input type="radio" name="paymentMethod" value="BankAccount"> Bank Account
                        <input type="radio" name="paymentMethod" value="ACH"> ACH
                        <input type="radio" name="paymentMethod" value="Cash"> Cash
                      </div>
                    </div>
                    <div class="row" style="border: 0;/*! border-radius: 5px; *//*! margin: 0; *//*! margin-bottom: 0px; */padding: 0;/*! margin-bottom: 15px; */">
                      <div class="col-md-6" style="padding: 0;">
                        <label class="payment_label">Card Information</label>
                        <div class="row form-block payment_method_html">
                          <div class="col-md-12 form-group1">  
                            <label>Card Number *</label>
                            <input type="text" class="form-control1 denger" name="card_number" id="card_number" value="" placeholder="Card Number" aria-required="true" required="">
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>First Name *</label>
                            <input type="text" class="form-control1 denger" name="first_name" id="first_name" value="" placeholder="First Name" aria-required="true" required="">
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>Last Name *</label>
                            <input type="text" class="form-control1 denger" name="last_name" id="last_name" value="" placeholder="Last Name" aria-required="true" required="">
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>Expiry Month/Expiry Year*</label>
                            <select required="" id="expiry_month" name="expiry_month" class="form-control1">
                               <option value="" selected="" disabled="" hidden="">--Select Month--</option>
                               <option value="1">1</option>
                               <option value="2">2</option>
                               <option value="3">3</option>
                               <option value="4">4</option>
                               <option value="5">5</option>
                               <option value="6">6</option>
                               <option value="7">7</option>
                               <option value="8">8</option>
                               <option value="9">9</option>
                               <option value="10">10</option>
                               <option value="11">11</option>
                               <option value="12">12</option>
                            </select>
                            <select required="" id="expiry_year" name="expiry_year" class="form-control1">
                               <option value="" selected="" disabled="" hidden="">--Select Year--</option>
                               <option value="21">2021</option>
                               <option value="22">2022</option>
                               <option value="23">2023</option>
                               <option value="24">2024</option>
                               <option value="25">2025</option>
                               <option value="26">2026</option>
                               <option value="27">2027</option>
                               <option value="28">2028</option>
                               <option value="29">2029</option>
                               <option value="30">2030</option>
                            </select>
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>CVV *</label>
                            <input type="text" class="form-control1 denger" name="card_cvv" id="card_cvv" value="" placeholder="Card CVV" aria-required="true" required="">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <label>Billing Address</label>
                        <div class="row form-block payment_billing_address_html">
                          <div class="col-md-12 form-group1">  
                            <label>Address 1 *</label>
                            <input type="text" class="form-control1 denger" name="billing_address_1" id="billing_address_1" value="" placeholder="Address 1" aria-required="true" required="">
                          </div>
                          <div class="col-md-12 form-group1">  
                            <label>Address 2 </label>
                            <input type="text" class="form-control1 denger" name="billing_address_2" id="billing_address_2" value="" placeholder="Address 2" >
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>City *</label>
                            <input type="text" class="form-control1 denger" name="billing_city" id="billing_city" value="" placeholder="City" aria-required="true" required="">
                          </div>
                          <div class="col-md-6 form-group1">
                            <label for="country">Country *</label>
                            <select  class="form-control1" name="billing_country" id="billing_country"  required style="width: 100%;">
                                <option value=""> - Select -</option>
                                <option value="840">United States</option>
                            </select>
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>State/Province *</label>
                            <select  class="form-control1" name="billing_state" id="billing_state" required style="width: 100%;">
                                <option value=""> - Select -</option> 
                                <option value="100">AA</option>
                                <option value="101">AE</option>
                                <option value="15">Alabama</option>
                                <option value="14">Alaska</option>
                                <option value="102">AP</option>
                                <option value="16">Arizona</option>
                                <option value="17">Arkansas</option>
                                <option value="18">California</option>
                                <option value="19">Colorado</option>
                                <option value="20">Connecticut</option>
                                <option value="21">Delaware</option>
                                <option value="22">District of Columbia</option>
                                <option value="23">Florida</option>
                                <option value="24">Georgia</option>
                                <option value="25">Hawaii</option>
                                <option value="26">Idaho</option>
                                <option value="27">Illinois</option>
                                <option value="28">Indiana</option>
                                <option value="29">Iowa</option>
                                <option value="30">Kansas</option>
                                <option value="31">Kentucky</option>
                                <option value="32">Louisiana</option>
                                <option value="33">Maine</option>
                                <option value="34">Maryland</option>
                                <option value="35">Massachusetts</option>
                                <option value="36">Michigan</option>
                                <option value="37">Minnesota</option>
                                <option value="38">Mississippi</option>
                                <option value="39">Missouri</option>
                                <option value="40">Montana</option>
                                <option value="41">Nebraska</option>
                                <option value="42">Nevada</option>
                                <option value="43">New Hampshire</option>
                                <option value="44">New Jersey</option>
                                <option value="45">New Mexico</option>
                                <option value="46">New York</option>
                                <option value="47">North Carolina</option>
                                <option value="48">North Dakota</option>
                                <option value="49">Ohio</option>
                                <option value="50">Oklahoma</option>
                                <option value="51">Oregon</option>
                                <option value="52">Pennsylvania</option>
                                <option value="53">Puerto Rico (see also separate entry under PR)</option>
                                <option value="54">Rhode Island</option>
                                <option value="55">South Carolina</option>
                                <option value="56">South Dakota</option>
                                <option value="57">Tennessee</option>
                                <option value="58">Texas</option>
                                <option value="59">Utah</option>
                                <option value="60">Vermont</option>
                                <option value="61">Virginia</option>
                                <option value="62">Washington</option>
                                <option value="63">West Virginia</option>
                                <option value="64">Wisconsin</option>
                                <option value="65">Wyoming</option>
                            </select>
                          </div>
                          <div class="col-md-6 form-group1">  
                            <label>Zip/Postal Code *</label>
                            <input type="text" class="form-control1 denger" name="billing_zipcode" id="billing_zipcode" value="" placeholder="Zip/Postal Code" aria-required="true" required="">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row paymentButton">
                      <div class="col-md-12 form-block">
                        <div class="planperiode nice-select custom-select open text-center">
                          <input type="hidden" name="action" value="planCheckoutForm"/>
                          <button type="submit" id="button" class="submit-btn">Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>

    <?php
endwhile; // End of the loop.

if ( is_post_type_archive( array('forum', 'topic') ) ) {
    if ( $is_forum_btm_c2a == '1' ) {
        get_template_part('template-parts/forum/c2a-bottom');
    }
}

?>



<script src="<?php echo DOCLY_DIR_JS ?>/order.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 
<script type='text/javascript'>

jQuery(document).ready(function() {

   // $('newCustomerForm')[0].reset()
    var expDate= new Date(new Date().setFullYear(new Date().getFullYear() + 3));



    document.getElementById('payment_date').valueAsDate = new Date();
    document.getElementById('l_warranty_expiry').valueAsDate = expDate;




     jQuery(".form_1_bubmit_btn").click(function () {
        // alert('Go next Step....');
        jQuery('.form_1_bubmit_btn').hide();
        jQuery('.form_step_2').css("opacity", 1);
        jQuery('.form_step_2').css("pointer-events",'visible');
    });

    jQuery(".form_2_bubmit_btn").click(function () {
        // alert('Go next Step....');
        jQuery('.form_2_bubmit_btn').hide();
        jQuery('.form_step_3').css("opacity", 1);
        jQuery('.form_step_3').css("pointer-events",'visible');
    });
    
    jQuery('#sameAsLwarrentyData').change(function(){
        if(jQuery('#sameAsLwarrentyData').is(':checked')){
            jQuery('#r_warranty_expiry').val(jQuery('#l_warranty_expiry').val());

            var date1=new Date(jQuery('#payment_date').val());
            var date2 = new Date(jQuery('#r_warranty_expiry').val());

            if(date2>date1)
            jQuery('#planMonths').val(monthDiff(date1, date2));
            else
                jQuery('#planMonths').val(monthDiff(date2, date1));
        } else { 
            //Clear on uncheck
             jQuery('#r_warranty_expiry').val('');
        };
    });

    jQuery('#landingPage').change(function(){

        jQuery('#keyword').val(jQuery('#landingPage').val());

    });





jQuery("input[name='earningInterval']").change(function(){
        var planInterval = jQuery("input[name='earningInterval']:checked").val();
        // var planTotalPrice = $(this).closest('tr').find('.planTotalPrice').val();
        console.log('earningInterval:'+planInterval);
        // console.log(format(179.39999999999998)); // "1.35"
        if (planInterval == 'Yearly') {
            jQuery(".planList tr").each(function() {
            var planPrice = jQuery(this).find('.mplanPrice').val();
            var planPrice12 = 12*planPrice;
            var abc = parseFloat(planPrice12.toFixed(2));


            jQuery(this).closest('tr').find('span').text('$'+abc);
            jQuery(this).closest('tr').find('.planPrice').val(abc);
            jQuery(this).closest('tr').find('.planTotalPrice').val(abc);
         });
        } 

        if(planInterval == 'Monthly') {
            jQuery(".planList tr").each(function() {
            var planPrice = jQuery(this).find('.mplanPrice').val();

            jQuery(this).closest('tr').find('span').text('$'+planPrice);
            jQuery(this).closest('tr').find('.planPrice').val(planPrice);
            jQuery(this).closest('tr').find('.planTotalPrice').val(planPrice);
            });
        }
    });
    jQuery("input[type='radio']").change(function(){
        var radioValue = jQuery("input[name='planFrequencyID']:checked").val();
        var planTotalPrice = jQuery(this).closest('tr').find('.planTotalPrice').val();
        var planMonths= jQuery('#planMonths').val();
         console.log('Select Plan:'+planInterval);
        var planInterval = jQuery("input[name='earningInterval']:checked").val();

        // if (planInterval == 'Yearly') {
        //     if (planMonths != 12 && planMonths != 24 && planMonths != 36 && planMonths != 48) {
        //         alert("Yearly plan interval must have 12/24/36/48 months");
        //         jQuery("input[name=earningInterval]").val(['Monthly']);
        //
        //         return false;
        //
        //     }
        // }



        if(radioValue){
           // alert("Your are a - " + radioValue);
            jQuery(".planList tr").each(function(){
                var radioValue2 = jQuery(this).closest('tr').find("input[name='planFrequencyID']").val();
                // var radioValue = jQuery("input[name='planFrequencyID']:checked").val();
                if (radioValue == radioValue2) {
                // console.log('aaaaa:'+radioValue2);
                    jQuery(this).closest('tr').find('.planQty').attr('disabled', false);  
                } else {

                jQuery(this).closest('tr').find('.planQty').attr('disabled', true);
                }
                // alert($(this).text())
            });
            // jQuery(this).closest('tr').find('.planQty').attr('disabled', false);
            // jQuery('.planList tr td .planQty').attr('disabled', true);
            jQuery("input[type='button']").val(radioValue);
            // $(this).closest('tr').find('.planTotalPrice').val(radioValue);
            jQuery('.totalAmount').closest('tr').find('.totalPrice').val(planTotalPrice);

            jQuery('.planQty').keyup(function(){
                var planQty = jQuery(this).closest('tr').find('.planQty').val();
                var planPrice = jQuery(this).closest('tr').find('.planPrice').val();
                var totalPrice = planQty * planPrice;
                // console.log('planQty:'+planQty);
                // console.log('planPrice:'+planPrice);
                // console.log('totalPrice:'+totalPrice);
                jQuery(this).closest('tr').find('.planTotalPrice').val(totalPrice);
                jQuery('.totalAmount').closest('tr').find('.totalPrice').val(totalPrice);
         
            });
        }
    });

    
    var keyup_count = 0;
    var change_count = 0;
    jQuery('#referenceCustomerId').keyup(function(){
        var customerId = jQuery('#referenceCustomerId').val();
        keyup_count++;
        console.log(customerId.length);
        // console.log(keyup_count);
        if (keyup_count > 3) {
            // var customerId = jQuery('#referenceCustomerId').val();
            console.log('keyup:'+customerId);

            jQuery.ajax({
                type: "POST",
                url: "https://phpstack-426242-1347501.cloudwaysapps.com/fetch_suggested_patient_list.php",
                data: { 
                    customerId: customerId,
                    // access_token: jQuery("#access_token").val() 
                },
                // dataType: "json",
                success: function(response) {
                    // console.log(response);
                    var JSONObjectArraya = jQuery.parseJSON(response);
                    // console.log(JSONObjectArraya.result);
                    var availableTags2 = JSONObjectArraya.result;
                    jQuery( "#referenceCustomerId" ).autocomplete({
                        source: availableTags2
                    });
                },
                error: function(result) {
                    // alert('Please enter valid customer ID.');
                }
            });
        }
    })

   jQuery("#referenceCustomerId").focusout(function() {
        var customerId = jQuery('#referenceCustomerId').val();

       // console.log(customerId.length);
        var customerId2 = '';
        if(customerId.length == 6 ) {
            customerId = '0'+customerId;
        }
        
        event.preventDefault();
        jQuery.ajax({
            type: "POST",
            url: "https://phpstack-426242-1347501.cloudwaysapps.com/fetch_patient_information.php",
            data: { 
                customerId: customerId,
                // access_token: jQuery("#access_token").val() 
            },

            // dataType: "json",
            success: function(response) {

                var JSONObjectArraya = jQuery.parseJSON(response);

                console.log(customerId.length);
                if ( JSONObjectArraya.status == true ) {
                   // jQuery('#referenceCustomerId').removeClass('denger');
                    jQuery('#firstName').val(JSONObjectArraya.result[0].first_name);
                    jQuery('#lastName').val(JSONObjectArraya.result[0].last_name);
                    jQuery('#primaryEmail').val(JSONObjectArraya.result[0].Email);
                    jQuery('#primaryPhone').val(JSONObjectArraya.result[0].Home_Phone);

                    //jQuery('#billing_address_1').val(JSONObjectArraya.result[0].Street1);
                    jQuery('#shipping_address_1').val(JSONObjectArraya.result[0].Street1);

                    //jQuery('#billing_address_2').val(JSONObjectArraya.result[0].Street2);
                    jQuery('#shipping_address_2').val(JSONObjectArraya.result[0].Street2);

                    //jQuery('#billing_city').val(JSONObjectArraya.result[0].City);
                    jQuery('#shipping_city').val(JSONObjectArraya.result[0].City);

                    //jQuery('#billing_country').val(840);
                    jQuery('#shipping_country').val(840);

                    //jQuery('#billing_state').val(JSONObjectArraya.result[0].State);
                    jQuery('#shipping_state').val(JSONObjectArraya.result[0].State);

                    var zipcodestr = JSONObjectArraya.result[0].Zipcode; 
                    var zip5 = zipcodestr.slice(0, 5);
                    //jQuery('#billing_zipcode').val(zip5);
                    jQuery('#shipping_zipcode').val(zip5);
                } else {
                    //jQuery('#referenceCustomerId').addClass('denger');
                    jQuery('#firstName').val('');
                    jQuery('#lastName').val('');
                    jQuery('#primaryEmail').val('');
                    jQuery('#primaryPhone').val('');

                    jQuery('#billing_address_1').val('');
                    jQuery('#shipping_address_1').val('');

                    jQuery('#billing_address_2').val('');
                    jQuery('#shipping_address_2').val('');

                    jQuery('#billing_city').val('');
                    jQuery('#shipping_city').val('');

                    jQuery('#billing_country').val('');
                    jQuery('#shipping_country').val('');

                    jQuery('#billing_state').val('');
                    jQuery('#shipping_state').val('');

                    jQuery('#billing_zipcode').val('');
                    jQuery('#shipping_zipcode').val('');
                }
            },

            error: function(result) {
                alert('Please enter valid customer ID.');
            }
        });
    });



    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    //jQuery('#l_warranty_expiry').attr('min', maxDate);

    jQuery('#l_warranty_expiry').change(function(){
        var date = new Date(jQuery('#l_warranty_expiry').val());
        // alert(l_warranty_expiry);
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var year = date.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    
        var maxDate = year + '-' + month + '-' + day;

        // alert([day, month, year].join('/'));
        // var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        //jQuery('#r_warranty_expiry').attr('min', maxDate);
        //jQuery('#r_warranty_expiry').val(jQuery('#l_warranty_expiry').val());
        //var date2 = new Date(jQuery('#l_warranty_expiry').val());
        //jQuery('#planMonths').val(monthDiff(new Date(), date2));
    })

     jQuery('#r_warranty_expiry').change(function(){
     
        // To set two dates to two variables 
        var dtToday = new Date();
        // alert(dtToday);
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var date1 = new Date(year + '-' + month + '-' + day);

        var date2 = new Date(jQuery('#r_warranty_expiry').val());
        // alert(date2);
        // var m = monthDiff(date1,date2);
        // alert(m);
        // var date2 = new Date("07/30/2019"); 
          
        // To calculate the time difference of two dates 
        var diffMonth =(date2.getTime() - dtToday.getTime()) / 1000;
           diffMonth /= (60 * 60 * 24 * 7 * 4);
          // return ;
        // jQuery('#planMonths').val(Math.abs(Math.round(diffMonth)));
        jQuery('#planMonths').val(monthDiff(new Date(), date2));

        // alert(Math.abs(Math.round(diffMonth)));

        // window.onload = function() {
            // alert(monthDiff(new Date(), date2));
        // }

     }) 
    
   function monthDiff(start, end) {
      var tempDate = new Date(start);
      var monthCount = 0;
      while((tempDate.getMonth()+''+tempDate.getFullYear()) != (end.getMonth()+''+end.getFullYear())) {
          monthCount++;
          tempDate.setMonth(tempDate.getMonth()+1);
      }
      return monthCount;
    } 

 jQuery('#useBillingAddressAsShippingAddress').change(function(){
    // alert('here');
        if(jQuery('#useBillingAddressAsShippingAddress').is(':checked')){
            jQuery('#billing_address_1').val(jQuery('#shipping_address_1').val());
            jQuery('#billing_address_2').val(jQuery('#shipping_address_2').val());
            jQuery('#billing_city').val(jQuery('#shipping_city').val());
            jQuery('#billing_country').val(jQuery('#shipping_country option:selected').val());
            jQuery('#billing_state').val(jQuery('#shipping_state option:selected').val());
            jQuery('#billing_zipcode').val(jQuery('#shipping_zipcode').val());
            // var state = jQuery('#state-field option:selected').val();
            // jQuery('#state-field1 option[value=' + state + ']').attr('selected','selected');
        } else { 
            //Clear on uncheck
            // jQuery('#shipping_address_1').val('');
            // jQuery('#shipping_address_2').val('');
            // jQuery('#shipping_city').val('');
            // jQuery('#shipping_country').val('');
            // jQuery('#shipping_state').val('');
            // jQuery('#shipping_zipcode').val('');
        };

    });



 
    jQuery("#newCustomerForm").validate({
        rules: {
            phone: {
                required: true,
                number:true,
                min:10,
            }
        },
        messages: {
            customer_id: {
                required: "specify customer id"
            },
            first_name: {
                required: "specify First Name"
            }
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').removeClass('has-error');
            jQuery(element).parents('.form-group').addClass('has-success');
        },
        submitHandler: function(form,e) {
            e.preventDefault();

            var newCustomerForm = jQuery('#newCustomerForm').serialize();

            jQuery.ajax({
                type: "POST",
                beforeSend: function(){
                    jQuery('.ajax-loader').css("visibility", "visible");
                },
                dataType: 'json',
               // url: "https://miracle-earnw.com/wp-admin/admin-ajax.php",
                url: "http://localhost/miracle/wp-admin/admin-ajax.php",
                data: newCustomerForm,

                success: function(data){

                    var jres=data[0];

                    if (jres=="error") {

                        swal("Ohh", data[1], "error");

                    } else {


                        jQuery('.customerDataHtml').html(data[0]);
                        jQuery('.form_1_button').hide();
                        jQuery('#customerInformationForm2').css('opacity', 1);
                        jQuery('#customerInformationForm2').css('pointer-events', 'painted');


                        var rdata=data[1];
                        document.getElementById('subscriptionId').value=rdata[0].subscriptionId;
                        document.getElementById('protectionsupplementallossdamage').value=rdata[0].productId;
                        document.getElementById('secureplansupplementalrepairwarranty').value=rdata[1].productId;
                        document.getElementById('protectionsupplementallossdamagesingleaid').value=rdata[2].productId;
                        document.getElementById('secureplansupplementalrepairwarrantysingleaid').value=rdata[3].productId;
                        document.getElementById('secureplusplansupplementalrepairwarranty').value=rdata[4].productId;
                        document.getElementById('batteryplan').value=rdata[5].productId;

                        swal({
                            title: "Customer create successfully",
                            html: 'buttons',
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Please select plan",
                            closeOnConfirm: false
                        });
                    }
                }
                ,
                complete: function(){
                    jQuery('.ajax-loader').css("visibility", "hidden");
                }


            });

    
            return false;
        }
    });

    jQuery("#customerInformationForm2").validate({


        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').removeClass('has-error');
            jQuery(element).parents('.form-group').addClass('has-success');
        },
        submitHandler: function(form,e) {
            e.preventDefault();
            console.log('Plan Form submitted');

            var Selected_Plan =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('input[name=planFrequencyID]').val();

            if(jQuery.type(Selected_Plan) === "undefined"){
                alert("Please select a plan !")
                console.log(Selected_Plan);
                return;
            }



            var Selected_Product_Name =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planName').val();
            var Selected_Product_Code =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planCode').val();
            var Selected_Product_id =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.productId').val();
            var Selected_Product_Quntity =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planQty').val();
            var Selected_Product_Price =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planPrice').val();
            var Selected_Product_Amount =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planTotalPrice').val();
            var Selected_Product_Total_Amount =  jQuery(".totalAmount").closest('tr').find('.totalPrice').val();
            


                var customerInformationForm2 = jQuery('#customerInformationForm2').serialize()  + "&Selected_Plan=" + Selected_Plan  + "&Selected_Product_Name=" + (Selected_Product_Name) + "&Selected_Product_Code=" + Selected_Product_Code + "&Selected_Product_id="+ Selected_Product_id + "&Selected_Product_Quntity=" + Selected_Product_Quntity + "&Selected_Product_Price=" + Selected_Product_Price + "&Selected_Product_Amount=" + Selected_Product_Amount
                // alert(newCustomerForm);

            jQuery.ajax({
                type: "POST",
                beforeSend: function(){
                    jQuery('.ajax-loader').css("visibility", "visible");
                },
                dataType: 'json',
               // url: "http://staging.miracle-earnw.com/wp-admin/admin-ajax.php",
                url: "http://localhost/miracle/wp-admin/admin-ajax.php",
                // url: "http://localhost/Projects/Wordpress/live_staging_miracle_new/wp-admin/admin-ajax.php",
                data: customerInformationForm2,
                success: function(data){

                    console.log(data);

                    if (data!=="error") {

                        let arr = data.split('|');


                        jQuery('.selected_plan_html').html(arr[0]);
                        jQuery('.selected_plan_price_html').html(arr[1]);
                        // jQuery('#selected_plan_html').val(arr[2]);
                        jQuery('.payment_billing_address_html #billing_address_1').val(arr[2]);
                        jQuery('.payment_billing_address_html #billing_address_2').val(arr[3]);
                        jQuery('.payment_billing_address_html #billing_city').val(arr[4]);
                        jQuery('.payment_billing_address_html #billing_country').val(arr[5]);
                        jQuery('.payment_billing_address_html #billing_state').val(arr[6]);
                        jQuery('.payment_billing_address_html #billing_zipcode').val(arr[7]);

                        console.log('Go to Payment');
                        jQuery("#PlanCheckoutModal").modal('show');


                    } else {

                        swal("Ohh", "Somthing went wrong", "error");


                    }
                    // jQuery("#feedback").html(data);
                },
                complete: function(){
                    jQuery('.ajax-loader').css("visibility", "hidden");
                }

            });

            return false;
        }
    });


jQuery("input[name='paymentMethod']").change(function(){
        var paymentMethod = jQuery("input[name='paymentMethod']:checked").val();
        // var planTotalPrice = $(this).closest('tr').find('.planTotalPrice').val();
        console.log('paymentMethod:'+paymentMethod);
        // console.log(format(179.39999999999998)); // "1.35"
        if (paymentMethod == 'CreditCard') {
          var credit_card_html = '<div class="col-md-12 form-group1"><label>Card Number *</label><input type="text" class="form-control1 denger" name="card_number" id="card_number" value="" placeholder="Card Number" aria-required="true" required=""></div><div class="col-md-6 form-group1"><label>First Name *</label><input type="text" class="form-control1 denger" name="first_name" id="first_name" value="" placeholder="First Name" aria-required="true" required=""></div><div class="col-md-6 form-group1"><label>Last Name *</label><input type="text" class="form-control1 denger" name="last_name" id="last_name" value="" placeholder="Last Name" aria-required="true" required=""></div><div class="col-md-6 form-group1"><label>Expiry Month/Expiry Year*</label><select required="" id="expiry_month" name="expiry_month" class="form-control1"><option value="" selected="" disabled="" hidden="">--Select Month--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select required="" id="expiry_year" name="expiry_year" class="form-control1"><option value="" selected="" disabled="" hidden="">--Select Year--</option><option value="21">2021</option><option value="22">2022</option><option value="23">2023</option><option value="24">2024</option><option value="25">2025</option><option value="26">2026</option><option value="27">2027</option><option value="28">2028</option><option value="29">2029</option><option value="30">2030</option></select></div><div class="col-md-6 form-group1"><label>CVV *</label><input type="text" class="form-control1 denger" name="card_cvv" id="card_cvv" value="" placeholder="Card CVV" aria-required="true" required=""></div>';

          jQuery('.payment_label').text('Card Information');
          jQuery('.payment_method_html').html(credit_card_html);
        }
        if (paymentMethod == 'BankAccount') {
          var bank_html = '<div class="col-md-12 form-group1"><label>First Name *</label><input type="text" class="form-control1 denger" name="first_name" id="first_name" value="" placeholder="First Name" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Last Name *</label><input type="text" class="form-control1 denger" name="last_name" id="last_name" value="" placeholder="Last Name" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Account Number *</label><input type="text" class="form-control1 denger" name="account_number" id="account_number" value="" placeholder="Account Number" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Transit Number*</label><input type="text" class="form-control1 denger" name="transit_number" id="transit_number" value="" placeholder="Transit Number" aria-required="true" required=""></div>';

          jQuery('.payment_label').text('Bank Information');
          jQuery('.payment_method_html').html(bank_html);

        }
        if (paymentMethod == 'ACH') {
          var ach_payment_method_html = '<div class="col-md-6 form-group1"><label>First Name *</label><input type="text" class="form-control1 denger" name="first_name" id="first_name" value="" placeholder="First Name" aria-required="true" required=""></div><div class="col-md-6 form-group1"><label>Last Name *</label><input type="text" class="form-control1 denger" name="last_name" id="last_name" value="" placeholder="Last Name" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Account Number *</label><input type="text" class="form-control1 denger" name="account_number" id="account_number" value="" placeholder="Account Number" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Transit Number*</label><input type="text" class="form-control1 denger" name="transit_number" id="transit_number" value="" placeholder="Transit Number" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Bank Account Type *</label><input type="radio" name="bank_account_type" value="CHQ" checked=""> CHQ <input type="radio" name="bank_account_type" value="SAV"> SAV</div><div class="col-md-12 form-group1"><label>Source *</label><input type="radio" name="source" value="Manual" checked=""> Manual  <input type="radio" name="source" value="Automatic"> Automatic  <input type="radio" name="source" value="SelfServicePortal"> SelfServicePortal</div>';

          jQuery('.payment_label').text('ACH Information');
          jQuery('.payment_method_html').html(ach_payment_method_html);
        }
        if (paymentMethod == 'Cash') {
          var ach_payment_method_html = '<div class="col-md-6 form-group1"><label>First Name *</label><input type="text" class="form-control1 denger" name="first_name" id="first_name" value="" placeholder="First Name" aria-required="true" required=""></div><div class="col-md-6 form-group1"><label>Last Name *</label><input type="text" class="form-control1 denger" name="last_name" id="last_name" value="" placeholder="Last Name" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Reference *</label><input type="text" class="form-control1 denger" name="reference" id="reference" value="" placeholder="Reference" aria-required="true" required=""></div><div class="col-md-12 form-group1"><label>Source *</label><input type="radio" name="source" value="Manual" checked=""> Manual  <input type="radio" name="source" value="Automatic"> Automatic  <input type="radio" name="source" value="SelfServicePortal"> SelfServicePortal  <input type="radio" name="source" value="Import"> Import</div>';
          
          jQuery('.payment_label').text('Cash Information');
          jQuery('.payment_method_html').html(ach_payment_method_html);


        } 

    });

  // Plan Checkout Form 
jQuery("#planCheckoutForm").validate({ss: "help-inline text-danger",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            jQuery(element).parents('.form-group').removeClass('has-error');
            jQuery(element).parents('.form-group').addClass('has-success');
        },
        submitHandler: function(form,e) {
            e.preventDefault();
            console.log('Checkout Form submitted');

            var planCheckoutForm = jQuery('#planCheckoutForm').serialize();
           
            jQuery.ajax({
                type: "POST",
                beforeSend: function(){
                    jQuery('.ajax-loader').css("visibility", "visible");
                },
                dataType: 'json',
                //url: "http://staging.miracle-earnw.com/wp-admin/admin-ajax.php",
                url: "http://localhost/miracle/wp-admin/admin-ajax.php",
                data: planCheckoutForm,
                success: function(data){
                    console.log(data);
                    if (data!=="error") {
                        swal({
                            title: "Payment successful",
                            html: 'buttons',
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Thank You",
                            closeOnConfirm: false
                          });
                        // alert('Registration Successfully');
                        var url      = window.location.href;
                        window.location.href=url;
                    }
                    else
                    {
                        swal("Ohh", "Something went wrong", "error");
                    }
                },
                complete: function(){
                    jQuery('.ajax-loader').css("visibility", "hidden");
                }
            });
          return false;
        }
    });

});  
</script>

<?php
get_footer();