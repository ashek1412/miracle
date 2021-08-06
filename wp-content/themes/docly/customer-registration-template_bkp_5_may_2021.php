<style>
#newCustomerForm .cotrol1 {
    width: 250px;
}
.blog_comment_box .get_quote_form .form-group1 .form-control1.denger {
    border-color: red!important;
}
.ui-widget.ui-widget-content{
    min-height: 50px;
    overflow: scroll;
    max-height: 250px;
}

</style>
<?php
/**
 * Template Name: Customer Registration 5may2021
 */


get_header();

?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  // jQuery( function() {
  //   var availableTags = [

  //       "0000123",
  //       "0001123",
  //   ];
  //   jQuery( "#referenceCustomerId" ).autocomplete({
  //     source: availableTags
  //   });
  // } );
  </script>
  
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
                    <!-- <h2 class="c_head">Customer Registration <small><a rel="nofollow" id="cancel-comment-reply-link" href="/docly/docs/docly-documentation/layouts/sticky-header/#respond" style="display:none;">Cancel reply</a></small></h2>
                     -->
                    <form action="#" method="POST" name="CustomerFormStep1" id="newCustomerForm" class="get_quote_form form_step_1" novalidate="">
                        <div class="row ">
                            
                            <div class="col-md-2"></div>
                            <div class="col-md-8 dropdown ">
                                <div class="select-plan form-block"">
                                    <div class="nice-select custom-select open" tabindex="0">
                                        <span class="current">Select a Location</span>
                                        <select id="cars" class="form-control1 cotrol1" name="location_fusebill" id="location_fusebill"   >
                                            <option value="all">All Locations</option>
                                            <?php
                                            /*if( have_rows('locations',get_the_ID()) ):
                                            
                                                while( have_rows('locations',get_the_ID()) ): the_row();
                                                $location_id = get_sub_field('location_id', get_the_ID());
                                                $location_name = get_sub_field('location_name', get_the_ID());
                                                ?>
                                                <option value="<?php echo $location_id; ?>"><?php echo $location_name; ?></option>
                                                <?php 
                                                endwhile;
                                            endif;*/
                                           ?>
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
                                            <option value="Great Falls">Great Falls</option>
                                            <option value="Gresham">Gresham</option>
                                            <option value="Havre">Havre</option>
                                            <option value="Havre">Havre</option>
                                            <option value="Helena">Helena</option>
                                            <option value="Helena">Helena</option>
                                            <option value="Hermiston SC">Hermiston SC</option>
                                            <option value="Hilo">Hilo</option>
                                            <option value="Honolulu">Honolulu</option>
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
                                    </div>
                                    <div class="nice-select custom-select open" tabindex="0">
                                        <span>L Warranty Expiry *</span>
                                        <input type="date" class="form-control1 cotrol1" name="adContent" id="l_warranty_expiry" value="" placeholder="L Warranty Expiry" aria-required="true" required>
                                    </div>
                                    <div class="nice-select custom-select open" tabindex="0">
                                        <div class="samedate">
                                            <input type="checkbox" name="sameAsLwarrentyData" id="sameAsLwarrentyData" value="" placeholder="Same as L Warranty Expiry Date" aria-required="true" style="margin-left: 95px;">
                                            <label for="sameAsLwarrentyData">Same as L Warranty Expiry Date</label>
                                        </div>
                                        <span>R Warranty Expiry *</span>
                                        <input type="date" class="form-control1 cotrol1" name="campaign" id="r_warranty_expiry"  value="" placeholder="R Warranty Expiry" aria-required="true" required>
                                        <input type="hidden" class="form-control1" name="date_diffrent" id="date_diffrent"  value="">
                                    </div>
                                    <div class="nice-select custom-select open" tabindex="0"> 
                                         <span></span>
                                         <input type="text" class="form-control1" name="planMonths" id="planMonths" value="" placeholder="" aria-required="true" required> Months
                                        <input type="hidden" class="form-control1" name="planCode" id="date_diffrent"  value="">
                                    </div>

                                    <div class="planperiode nice-select custom-select open" tabindex="0">
                                        <span class="current">Select a plan</span>
                                        <input type="radio" name="earningInterval" value="Monthly" checked> Monthly
                                        <input type="radio" name="earningInterval" value="Yearly"> Annual
                                    </div>
                                    <div class="planperiode nice-select custom-select open text-center">
                                        <button type="submit" id="button" class="submit-btn form_1_bubmit_btn">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                    <form action="#" name="customerSelectPlan" method="POST" id="newCustomerForm" class="get_quote_form available_plan_list form_step_2" novalidate="">
                        <div class="row form-block"> 
                            <div class="col-md-12 dropdown">
                                <div class="plan-list">
                                <p>Health Services Protection Plan</p>
                               <table id="order-table">
                                    <tr>
                                         <th>Select Plan</th> 
                                         <th>Plan Name</th> 
                                         <th>Quantity</th>
                                         <th> Price</th>
                                         <th style="text-align: right; padding-right: 30px;">Totals</th> 
                                    </tr>
                                    <tr class="odd" >
                                        <td class="text-center"><input type="radio" name="planFrequencyID" value="54061" ></td>
                                        <td class="product-title" >Secure+ Plan Supplemental Repair Warranty
                                            <input type="hidden" name="productCode" class="productCode" value="secureplusplansupplementalrepairwarranty">
                                            <input type="hidden" class="productName" name="productName" value="Secure+ Plan Supplemental Repair Warranty">
                                        </td>
                                        <td class="num-pallets"><input type="text" class="num-pallets-input" name="quantity" id="sparkle-num-pallets"></td>
                                         
                                        <td class="price-per-pallet">$<span>49.95</span></td>
                                         
                                        <td class="row-total"><input type="text" class="row-total-input" name="totolPrice" id="sparkle-row-total" disabled="disabled"></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="text-center"><input type="radio" name="planFrequencyID" value="54060" ></td>
                                        <td class="product-title">Secure Plan Supplemental Repair Warranty (Single Aid)
                                            <input type="hidden" name="productCode" class="productCode" value="protectionsupplementallossdamagesingleaid">
                                            <input type="hidden" name="productName"  class="productName" value="Secure Plan Supplemental Repair Warranty (Single Aid)">
                                        </td>
                                        <td class="num-pallets"><input type="text" class="num-pallets-input" name="quantity" id="turface-mvp-num-pallets"></td>
                                         
                                        <td class="price-per-pallet">$<span>21.45</span></td>
                                         
                                        <td class="row-total"><input type="text" class="row-total-input" name="totolPrice" id="turface-mvp-row-total" disabled="disabled"></td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="text-center"><input type="radio" name="planFrequencyID" value="54059" ></td>
                                        <td class="product-title">Protection+ Supplemental Loss & Damage (Single Aid)
                                            <input type="hidden" name="productCode" class="productCode" value="protectionsupplementallossdamagesingleaid">
                                            <input type="hidden" name="productName"  class="productName" value="Protection+ Supplemental Loss & Damage (Single Aid)">
                                        </td>
                                        <td class="num-pallets"><input type="text" class="num-pallets-input" name="quantity" id="turface-pro-league-num-pallets" ></td>
                                         
                                        <td class="price-per-pallet">$<span>14.45</span></td>
                                         
                                        <td class="row-total"><input type="text" class="row-total-input" name="totolPrice" id="turface-pro-league-row-total" disabled="disabled"></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="text-center"><input type="radio" name="planFrequencyID" value="54058" ></td>
                                        <td class="product-title">Secure Plan Supplemental Repair Warranty
                                            <input type="hidden" name="productCode" class="productCode" value="secureplansupplementalrepairwarranty">
                                            <input type="hidden" name="productName"  class="productName" value="Secure Plan Supplemental Repair Warranty">
                                        </td>
                                        <td class="num-pallets"><input type="text" class="num-pallets-input" name="quantity" id="turface-pro-league-red-num-pallets"></td>
                                         
                                        <td class="price-per-pallet">$<span>21.95</span></td>
                                         
                                        <td class="row-total">
                                            <input type="text" class="row-total-input" name="totolPrice" id="turface-pro-league-red-row-total" disabled="disabled"></td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="text-center"><input type="radio" name="planFrequencyID" value="54057" ></td>
                                        <td class="product-title">Protection + Supplemental Loss & Damage
                                            <input type="hidden" name="productCode" class="productCode" value="protectionsupplementallossdamage">
                                            <input type="hidden" name="productName"  class="productName" value="Protection + Supplemental Loss & Damage">
                                        </td>
                                        <td class="num-pallets"><input type="text" class="num-pallets-input" name="quantity" id="turface-quick-dry-num-pallets" ></td>
                                         
                                        <td class="price-per-pallet">$<span>14.95</span></td>
                                         
                                        <td class="row-total"><input type="text" class="row-total-input" name="totolPrice" id="turface-quick-dry-row-total" disabled="disabled"></td>
                                    </tr> 
                                    <tr>
                                        <td colspan="6" style="text-align: right;">
                                            Initial Charge: <input type="text" name="totalAmount" class="total-box" value="$0" id="product-subtotal" disabled="disabled">
                                        </td>
                                    </tr>
                                </table>
                                
                                <table id="shipping-table">
                                 
                                
                                </table>
        
                            <div class="clear"></div>
                                
                                <div class="text-center">
                                    <button type="submit" id="button" class="submit-btn form_2_bubmit_btn">Next</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="#" name="customerInformation" method="POST" id="newCustomerForm" class="get_quote_form form_step_3" novalidate="">
                        <div class="row">                 
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
                                        <label>Email *</label>
                                        <input type="text" class="form-control1" name="primaryEmail" id="primaryEmail" value="" placeholder="Email" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control1" name="primaryPhone" id="primaryPhone" value="" placeholder="Phone" aria-required="true" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-block">
                                <label>Billing Address</label>
                                <div class="row">
                                    <div class="col-md-6 form-group1">
                                        <label>Address 1 *</label>
                                        <input type="text" class="form-control1" name="billing_address_1" id="billing_address_1" value="" placeholder="Address 1" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control1" name="billing_address_2" id="billing_address_2" value="" placeholder="Address 2" aria-required="true" required>
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
                                                ?>
                                                <!-- <option value="<?php echo $state['id'] ?>"><?php echo $state['name'] ?></option> -->
                                                <?php
                                            // }
                                            ?>
                                        <!-- </select> -->
                                        <select  class="form-control1" name="billing_state" id="billing_state" required>
                                            <option value=""> - Select State -</option>
                                            <option value="AA">AA</option>
                                            <option value="AE">AE</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AP">AP</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="PR">Puerto Rico (see also separate entry under PR)</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Zipcode *</label>
                                        <input type="text" class="form-control1" name="billing_zipcode" id="billing_zipcode" value="" placeholder="Zipcode" aria-required="true" required>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6 form-block">
                                <label>Product Information</label>
                                <div class="row">
                                    <div class="col-md-6 form-group1">
                                        <label>Chargeable *</label>
                                        <select required="" id="reference3" name="reference3" class="form-control1" required>
                                           <option value="" selected="" disabled="" hidden="">Yes or No</option>
                                           <option>Yes</option>
                                           <option>No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group1">
                                        <label>Referrer *</label>
                                        <input type="text" class="form-control1" name="reference1" id="reference1" value="" placeholder="Referrer" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Serial # Left *</label>
                                        <input type="text" class="form-control1" name="serial_left_medium" id="serial_left" value="" placeholder="Serial # Left" aria-required="true" required>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Serial # Right *</label>
                                        <input type="text" class="form-control1" name="serial_right_source" id="serial_right" value="" placeholder="Serial # Right" aria-required="true" required>
                                    </div>
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
                            <div class="col-md-6 form-block">
                                <label>Shipping Address</label>
                                <div class="row">
                                    <div class="col-md-6 form-group1">
                                        <label>Shipping Contact *</label>
                                        <input type="text" class="form-control1" name="contactName" id="contactName" value="" placeholder="Shipping Contact *" aria-required="true">
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Shipping Instructions *</label>
                                        <input type="text" class="form-control1" name="shippingInstructions" id="shippingInstructions" value="" placeholder="Shipping Instructions" aria-required="true">
                                    </div>
                                    <div class="col-md-12 form-group1 checkbox">
                                        <label>Same as billing</label>
                                        <input type="checkbox" name="useBillingAddressAsShippingAddress" id="useBillingAddressAsShippingAddress" value="" placeholder="Same as billing" aria-required="true">
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
                                       <!--  <select  class="form-control1" name="shipping_state" id="shipping_state" >
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
                                            //     ?>
                                                <!-- <option value="<?php echo $state['id'] ?>"><?php echo $state['name'] ?></option> -->
                                                 <?php
                                            // }
                                            ?>

                                        <!-- </select>  -->
                                        <select id="shipping_state" class="form-control1" name="shipping_state">
                                            <option value=""> - Select State -</option>
                                            <option value="AA">AA</option>
                                            <option value="AE">AE</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AP">AP</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="PR">Puerto Rico (see also separate entry under PR)</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group1">
                                        <label>Zipcode *</label>
                                        <input type="text" class="form-control1" name="shipping_zipcode" id="shipping_zipcode" value="" placeholder="Zipcode" aria-required="true">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-12 form-block"> 
                                <input type="hidden" name="action" value="addCustomer"/>

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
  
    jQuery('#sameAsLwarrentyData').change(function(){
        if(jQuery('#sameAsLwarrentyData').is(':checked')){
            jQuery('#r_warranty_expiry').val(jQuery('#l_warranty_expiry').val());
            var date2 = new Date(jQuery('#l_warranty_expiry').val());
            jQuery('#planMonths').val(monthDiff(new Date(), date2));
        } else { 
            //Clear on uncheck
             jQuery('#r_warranty_expiry').val('');
        };
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
            // console.log('keyup:'+customerId);

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
                    alert('Please enter valid customer ID.');
                }
            });
        }
    })

   jQuery("#referenceCustomerId").focusout(function() {
  		var customerId = jQuery('#referenceCustomerId').val();

        console.log(customerId.length);
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
                if ( JSONObjectArraya.status == true ) {
                    jQuery('#referenceCustomerId').removeClass('denger');
                    jQuery('#firstName').val(JSONObjectArraya.result[0].first_name);
                    jQuery('#lastName').val(JSONObjectArraya.result[0].last_name);
                    jQuery('#primaryEmail').val(JSONObjectArraya.result[0].Email);
                    jQuery('#primaryPhone').val(JSONObjectArraya.result[0].Home_Phone);

                    jQuery('#billing_address_1').val(JSONObjectArraya.result[0].Street1);
                    jQuery('#shipping_address_1').val(JSONObjectArraya.result[0].Street1);

                    jQuery('#billing_address_2').val(JSONObjectArraya.result[0].Street2);
                    jQuery('#shipping_address_2').val(JSONObjectArraya.result[0].Street2);

                    jQuery('#billing_city').val(JSONObjectArraya.result[0].City);
                    jQuery('#shipping_city').val(JSONObjectArraya.result[0].City);

                    jQuery('#billing_country').val(840);
                    jQuery('#shipping_country').val(840);

                    jQuery('#billing_state').val(JSONObjectArraya.result[0].State);
                    jQuery('#shipping_state').val(JSONObjectArraya.result[0].State);

                    var zipcodestr = JSONObjectArraya.result[0].Zipcode; 
                    var zip5 = zipcodestr.slice(0, 5);
                    jQuery('#billing_zipcode').val(zip5);
                    jQuery('#shipping_zipcode').val(zip5);
                } else {
                    jQuery('#referenceCustomerId').addClass('denger');
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


    jQuery('input[id="billing_address_1"]').on('keydown, keyup', function () {
      var address1 = jQuery('#billing_address_1').val();
      jQuery('input[id="shipping_address_1"]').val(address1);
    });

    jQuery('input[id="billing_address_2"]').on('keydown, keyup', function () {
      var address1 = jQuery('#billing_address_2').val();
      jQuery('input[id="shipping_address_2"]').val(address1);
    });

    jQuery('input[id="billing_city"]').on('keydown, keyup', function () {
      var address1 = jQuery('#billing_city').val();
      jQuery('input[id="shipping_city"]').val(address1);
    });

    jQuery('select[id="billing_country"]').on('change', function () {
      jQuery('#shipping_country').val(jQuery('#billing_country option:selected').val());
    });

    jQuery('select[id="billing_state"]').on('change', function () {
      jQuery('#shipping_state').val(jQuery('#billing_state option:selected').val());
    });

    jQuery('input[id="billing_zipcode"]').on('keydown, keyup', function () {
      var address1 = jQuery('#billing_zipcode').val();
      jQuery('input[id="shipping_zipcode"]').val(address1);
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

    jQuery('#l_warranty_expiry').attr('min', maxDate);

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
        jQuery('#r_warranty_expiry').attr('min', maxDate);
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
            jQuery('#shipping_address_1').val(jQuery('#billing_address_1').val());
            jQuery('#shipping_address_2').val(jQuery('#billing_address_2').val());
            jQuery('#shipping_city').val(jQuery('#billing_city').val());
            jQuery('#shipping_country').val(jQuery('#billing_country option:selected').val());
            jQuery('#shipping_state').val(jQuery('#billing_state option:selected').val());
            jQuery('#shipping_zipcode').val(jQuery('#billing_zipcode').val());
            // var state = jQuery('#state-field option:selected').val();
            // jQuery('#state-field1 option[value=' + state + ']').attr('selected','selected');
        } else { 
            //Clear on uncheck
             jQuery('#shipping_address_1').val('');
            jQuery('#shipping_address_2').val('');
            jQuery('#shipping_city').val('');
            jQuery('#shipping_country').val('');
            jQuery('#shipping_state').val('');
            jQuery('#shipping_zipcode').val('');
        };

    });


    jQuery("#newCustomerForm").validate({
        rules: {
            email: {
                required: true,
                email:true,
            },
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
            console.log('Form submitted');
             

            var Selected_Plan =  jQuery("input[name=planFrequencyID]:checked").val();
            var Selected_Product_Name =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.productName').val();
            var Selected_Product_Code =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.productCode').val();
            var Selected_Product_Quntity =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.num-pallets-input').val();
            var Selected_Product_Price =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find("td.price-per-pallet span").text();
            var Selected_Product_Amount =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find("td.row-total input")
                .val();

                var newCustomerForm = jQuery('#newCustomerForm').serialize()  + "&Selected_Plan=" + Selected_Plan  + "&Selected_Product_Name=" + Selected_Product_Name + "&Selected_Product_Code=" + Selected_Product_Code + "&Selected_Product_Quntity=" + Selected_Product_Quntity + "&Selected_Product_Price=" + Selected_Product_Price + "&Selected_Product_Amount=" + Selected_Product_Amount
                // alert(newCustomerForm);

            // alert(productName);
            // alert(productCode);
            // alert(productQuntity);
            // alert(productPrice);
            // alert(productAmount);

             // alert(newCustomerForm);
            jQuery.ajax({
                type: "POST",
                dataType: 'json',
                // url: "http://localhost/miracle-earnw/wp-admin/admin-ajax.php",
                //url: "http://localhost/Projects/Wordpress/miracle-earnw/wp-admin/admin-ajax.php",
                url: "http://staging.miracle-earnw.com/wp-admin/admin-ajax.php",
                data: newCustomerForm,
                success: function(data){
                    // alert(data.valid);
                    // alert(data);
                    if (data.valid == true) {
                        // swal("Great!", "Registration Successfully", "success");
                        // jQuery('#button').text('Checkout');
                          swal({
                              title: "Register Successfully",
                              html: 'buttons',
                              type: "success",
                              showCancelButton: false,
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Checkout",
                              closeOnConfirm: false
                            });
                        // jQuery('#button').css('background','#007bff');
                        // jQuery('#button').css('border-color','#007bff');
                        // jQuery('#button').css('color','#fff');
                        // jQuery('#button').css('float','right');
                        

                        // alert('Registration Successfully');
                        // window.location.reload();
                             // location.roload();
                    } else {
                        // alert(data.ErrorId);
                        // alert(data.[]Errors['val']);
                        // alert('something went wrong!');
                        swal("Ohh", "Somthing went wrong", "error");

                        // jQuery(data.Errors).each(function(i, item){
                        //       console.log(item.key, item.value)
                        // })
                    }
                    // jQuery("#feedback").html(data);
                }
            });

    
            return false;
        }
    });

});  
</script>

<?php
get_footer();