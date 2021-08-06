<style>
     

.customer-registration .form-group1.planInterval input[type=radio] {
    width: auto !important;
}
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
</style>
<?php
/**
 * Template Name: Customer Registration
 */


if (isset( $_POST['customer_registration_form_1_fields'] ) && wp_verify_nonce( $_POST['customer_registration_form_1_fields'], 'customer_registration_form_1_action' ) ) {
     
     // echo "<pre>";
     print_r($_POST);
    //  exit;
    $post = array('reference'=> $_POST['referenceCustomerId'],
                  'firstName'=> $_POST['firstName'],
                  'lastName'=> $_POST['lastName'],
                  'primaryEmail'=> $_POST['primaryEmail'],
                  'primaryPhone'=> $_POST['primaryPhone'],
                  // 'customerAcquisition' =>  array(
                  //       'medium'=> $_POST['serial_left_medium'],
                  //       'source'=> $_POST['serial_right_source'],

                  //       'landingPage'=> $_POST['landingPage'],
                  //       'keyword'=> $_POST['keyword'],

                  //       'adContent'=> $_POST['adContent'],
                  //       'campaign'=> $_POST['campaign'],
                  // ),

                  // 'customerReference' => array(
                  //     'reference3'=> $_POST['reference3'],
                  //     'reference1'=> $_POST['reference1'],
                  //   ),
            );

$data_json = json_encode($post);
$curl = curl_init();
/*
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://secure.fusebill.com/v1/customers',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$data_json,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$result = json_decode($response);
echo "<pre>";
// var_dump($result->customerReference->id);die;
curl_close($curl);
*/

// echo "<strong>Created Customer Info with Draft Status</strong><br>";
// echo "----------------------------------------<br>";
// echo "<strong>CustomerID:</strong> $result->id <br>";
// echo "<strong>First Name:</strong> $result->firstName<br>";
// echo "<strong>Last Name:</strong> $result->lastName<br>";
// echo "<strong>Email:</strong> $result->primaryEmail<br>";
// echo "<strong>Phone:</strong> $result->primaryPhone<br>";
// echo "<strong>Reference:</strong> $result->reference<br>";
// echo "<strong>Status:</strong> $result->status<br>";
// echo "<strong>Status:</strong> $result->status<br>"
// echo json_decode($response);
// die;

// if(isset($result->status) && $result->status  == 'Draft'){
    $CustomerID = '9801285';
    $firstName = 'Jay';
    $lastName = 'Brack';
    $primaryEmail = 'jebrack@gmail.com';
    $primaryPhone = '2069486303';
    $reference = '0321127';
    $status = 'Draft';
    echo "<strong>Created Customer Info with Draft Status</strong><br>";
    echo "----------------------------------------<br>";
    echo "<strong>CustomerID:</strong> ".$CustomerID." <br>";
    echo "<strong>First Name:</strong> ".$firstName."<br>";
    echo "<strong>Last Name:</strong> ". $lastName ."<br>";
    echo "<strong>Email:</strong> ".$primaryEmail."<br>";
    echo "<strong>Phone:</strong> ".$primaryPhone."<br>";
    echo "<strong>Reference:</strong> ".$reference."<br>";
    echo "<strong>Status:</strong> ".$status."<br>";

    echo "<br>";
     $months = $_POST['planMonths'];
    $interver = 'Monthly';

    if ($interver == 'Monthly') {
      $planString = 'm';
    } elseif ($interver == 'Yearly') {
      $planString = 'y';
    }

    $planCode ="hpp-".$months.$planString;

    $APIKEY = "MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ";
    $ch = curl_init('https://secure.fusebill.com/v1/Plans?query=status:Active');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Authorization: Basic ' . $APIKEY
       ));
    $planDatas = json_decode(curl_exec($ch),true);
    // print_r($data);

    $planFrequenciesID = [];

    foreach ($planDatas as $key => $plan) {
      // echo $plan['code']."<br>";
      // $planCode = "hpp-15m";
      if ($plan['code'] == $planCode) {
        array_push($planFrequenciesID, $plan['planFrequencies'][0]['id']);
      } 
    }

    // echo "<br>";
    // echo "----------------------------------------<br>";
    // echo "Step 1: Find planFrequencyID ";
    // echo "<br>";
    // echo "----------------------------------------<br>";
    echo "<br>";
    echo "<strong>Use month code : hpp-15m </strong><br>";
    // echo "<br>";
    echo "<strong>planFrequenciesID : ";
    print_r($planFrequenciesID[0]);
    echo "</strong><br>";
    echo "<br>";

    $subscriptionData = array('CustomerID'=> $CustomerID,
                              'planFrequencyID'=> $planFrequenciesID[0]
                             );

    $subscription_json = json_encode($subscriptionData);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://secure.fusebill.com/v1/subscriptions',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$subscription_json,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    $subscriptionResults = json_decode($response);
    curl_close($curl);
    

    echo "----------------------------------------------------------------<br>";
    echo "<strong>Step 3: Subscription Plan list <br>Use CustomerID: 9507619 and planFrequencyID: 69965 </strong>";
    echo "<br>";
    echo "----------------------------------------------------------------<br>";
    // print_r($subscriptionResults);
    /**
     * Step 4: Find Purchase Product Details
     * Use subscription response data and form post data
     */
    // $productDetails = [];
    // $count = 1;
    // foreach ($subscriptionResults->subscriptionProducts as $key => $row) {
    //   // print_r( $row->planProduct);
    //   // if ( $row->planProduct->productCode == $_POST['Selected_Product_Code']) {
    //   // if ( $row->planProduct->productCode == 'protectionsupplementallossdamage') {
    //   //   echo "productId....".$row->planProduct->productId."<br>";
    //   //   echo "productName....".$row->planProduct->productName."<br>";
    //   //   echo "quantity....".$row->planProduct->quantity."<br>";
    //     // print_r($row->planProduct);
    //     $productDetails['productId']= $row->planProduct->productId;
    //     $productDetails['productCode']= $row->planProduct->productCode;
    //     $productDetails['productName']= $row->planProduct->productName;
    //     $productDetails['quantity']= $row->planProduct->quantity;
    //     $productDetails['price']= $row->planProduct->orderToCashCycles[0]->pricingModel->quantityRanges[0]->prices[0]->amount;
    //   // }
    //   // echo "------------------<br>";
    //   // echo "<strong>Plan : ".$count."</strong><br>";
    //   // echo "----------------------------------------<br>";
    //   // echo "productCode: ".$row->planProduct->productCode."<br>";
    //   // echo "productName: ".$row->planProduct->productName."<br>";
    //   // echo "productId: ".$row->planProduct->productId."  | ";
    //   // echo "quantity: ".$row->planProduct->quantity."  |  ";
    //   // echo "Price: ".$row->planProduct->orderToCashCycles[0]->pricingModel->quantityRanges[0]->prices[0]->amount."<br>";
    //   // echo "<br>";
    //   $count++;
    // }
// }
// exit;

    // $my_cptpost_args = array(
    //     'post_title'    => $_POST['title'],
    //     'post_content'  => $_POST['title'],
    //     'post_status'   => 'publish',
    //     'post_type' => $_POST['post_type']
    // );

    // $worksite_id = wp_insert_post( $my_cptpost_args, $wp_error);
    // $user_info = wp_get_current_user();

    // if ($worksite_id) {
    //     add_post_meta( $worksite_id, 'admin', $user_info->ID );
    //     add_post_meta( $worksite_id, 'client', $_POST['client'] );

    //     $users = $_POST['user'];
    //     foreach ($users as $key => $row) {
    //         add_post_meta( $worksite_id, 'user', $row );
    //     }

    //     wp_redirect( home_url('/worksites/') );
    // }

}

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
                                        <label>Email *</label>
                                        <input type="text" class="form-control1" name="primaryEmail" id="primaryEmail" value="" placeholder="Email" aria-required="true" required>
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
                                    <div class="col-md-6 form-group1">
                                        <div class="row1">
                                            <div class="col-md-121 form-group1">
                                                <label>L Warranty Expiry *</label>
                                                <input type="date" class="form-control1 cotrol1" name="adContent" id="l_warranty_expiry" value="" placeholder="L Warranty Expiry" aria-required="true" required>
                                            </div>
                                            <div class="col-md-121 form-group1 checkbox samedate">
                                                <div class="samedate">
                                                    <input type="checkbox" name="sameAsLwarrentyData" id="sameAsLwarrentyData" value="" placeholder="Same as L Warranty Expiry Date" aria-required="true" >
                                                    <label for="sameAsLwarrentyData">Same as L Warranty Expiry Date</label>
                                                </div>
                                                <!-- 
                                                <label for="sameAsLwarrentyData">Same as L Warranty Expiry Date</label>
                                                <input type="checkbox" name="sameAsLwarrentyData" id="sameAsLwarrentyData" value="" placeholder="Same as billing" aria-required="true"> -->
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
            <input type="hidden" name="planCode" value="secureplusplansupplementalrepairwarranty" class="planCode" style="width: 75px;" >
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
                <input type="hidden" name="planCode" value="secureplansupplementalrepairwarrantysingleaid" class="planCode" style="width: 75px;" >
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
                <input type="hidden" name="planName" value="Protection+ Supplemental Loss & Damage (Single Aid)" class="planName" style="width: 75px;" >
                <input type="hidden" name="planCode" value="secureplansupplementalrepairwarranty" class="planCode" style="width: 75px;" >
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
                      <input type="hidden" name="planCode" value="secureplansupplementalrepairwarranty" class="planCode" style="width: 75px;" >
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
                      <input type="hidden" name="planName" value="Protection + Supplemental Loss & Damage" class="planName" style="width: 75px;" >
                      <input type="hidden" name="planCode" value="protectionsupplementallossdamage" class="planCode" style="width: 75px;" >
                    </td>
                      <td><input type="number" name="planQty" value="1" class="planQty" style="width: 75px;" disabled="disabled"></td>
                      <td>
                      <span>$14.95</span>
                      <input type="hidden" name="planPrice" value="14.95" class="planPrice">
                      <input type="hidden" name="mplanPrice" value="14.95" class="mplanPrice">
                      </td>
                      <td><input type="text" name="planTotalPrice" value="14.95" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;"></td>
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
                                        <label>Shipping Instructions *</label>
                                        <input type="text" class="form-control1" name="shippingInstructions" id="shippingInstructions" value="" placeholder="Shipping Instructions" aria-required="true">
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
// jQuery(document).ready(function($) {
    
//     jQuery('.wordpress-ajax-form').on('submit', function(e) {
//         e.preventDefault();

//         var $form = jQuery(this);

//         jQuery.post($form.attr('action'), $form.serialize(), function(data) {
//             alert('This is data returned from the server ' + data);
//         }, 'json');
//     });

// });
jQuery(document).ready(function() {
    
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
            var date2 = new Date(jQuery('#l_warranty_expiry').val());
            jQuery('#planMonths').val(monthDiff(new Date(), date2));
        } else { 
            //Clear on uncheck
             jQuery('#r_warranty_expiry').val('');
        };
    });

jQuery("input[name='earningInterval']").change(function(){
        var planInterval = jQuery("input[name='earningInterval']:checked").val();
        // var planTotalPrice = $(this).closest('tr').find('.planTotalPrice').val();
        console.log('earningInterval:'+planInterval);
        // console.log(format(179.39999999999998)); // "1.35"
        if (planInterval == 'Yearly') {
            jQuery(".planList tr").each(function() {
            var planPrice = jQuery(this).find('.planPrice').val();
            var planPrice12 = 12*planPrice;
            var abc = parseFloat(planPrice12.toFixed(2));
            // parseFloat(3.14159.toFixed(2));
                // console.log('planInterval:'+abc);
            // var yearlyPlanPrice = 12 * planPrice;
            jQuery(this).closest('tr').find('span').text('$'+abc);
            jQuery(this).closest('tr').find('.planPrice').val(abc);
            jQuery(this).closest('tr').find('.planTotalPrice').val(abc);
         });
        } 

        if(planInterval == 'Monthly') {
            jQuery(".planList tr").each(function() {
            var planPrice = jQuery(this).find('.mplanPrice').val();
             // console.log('planInterval:'+planPrice);
            // var planPrice12 = 12*planPrice;
            // var abc = parseFloat(planPrice12.toFixed(2));
            // // parseFloat(3.14159.toFixed(2));
            //     console.log('planInterval:'+abc);
            // // var yearlyPlanPrice = 12 * planPrice;
            // $(this).closest('tr').find('span').text('$'+abc);
            jQuery(this).closest('tr').find('span').text('$'+planPrice);
            jQuery(this).closest('tr').find('.planPrice').val(planPrice);
            jQuery(this).closest('tr').find('.planTotalPrice').val(planPrice);
            });
        }
    });
    jQuery("input[type='radio']").change(function(){
        var radioValue = jQuery("input[name='planFrequencyID']:checked").val();
        var planTotalPrice = jQuery(this).closest('tr').find('.planTotalPrice').val();
         console.log('Select Plan:'+radioValue);
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
            // $('.totalAmount').find('.totalPrice').val(radioValue);
            // jQuery('.planQty').keyup(function(){
            //     // alert("test");
            //     var keyupValue = jQuery("input[name='planFrequencyID']:checked").val();
            //     if (keyupValue == radioValue ) {
            //         var planQty = jQuery(this).closest('tr').find('.planQty').val();
            //         var planPrice = jQuery(this).closest('tr').find('.planPrice').val();
            //         var totalPrice = planQty * planPrice;
            //         // console.log('planQty:'+planQty);
            //         // console.log('planPrice:'+planPrice);
            //         // console.log('totalPrice:'+totalPrice);
            //         jQuery('.planList tr td').find('.totalPrice').val(totalPrice);
            //     }
         
            // });
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


    jQuery('input[id="shipping_address_1"]').on('keydown, keyup', function () {
      var address1 = jQuery('#shipping_address_1').val();
      jQuery('input[id="billing_address_1"]').val(address1);
    });

    jQuery('input[id="shipping_address_2"]').on('keydown, keyup', function () {
      var address1 = jQuery('#shipping_address_2').val();
      jQuery('input[id="billing_address_2"]').val(address1);
    });

    jQuery('input[id="shipping_city"]').on('keydown, keyup', function () {
      var address1 = jQuery('#shipping_city').val();
      jQuery('input[id="billing_city"]').val(address1);
    });

    jQuery('select[id="shipping_country"]').on('change', function () {
      jQuery('#billing_country').val(jQuery('#shipping_country option:selected').val());
    });

    jQuery('select[id="shipping_state"]').on('change', function () {
      jQuery('#billing_state').val(jQuery('#shipping_state option:selected').val());
    });

    jQuery('input[id="shipping_zipcode"]').on('keydown, keyup', function () {
      var address1 = jQuery('#shipping_zipcode').val();
      jQuery('input[id="billing_zipcode"]').val(address1);
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
            console.log('Create customer Form submitted');
             

            // var Selected_Plan =  jQuery("input[name=planFrequencyID]:checked").val();
            // var Selected_Product_Name =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.productName').val();
            // var Selected_Product_Code =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.productCode').val();
            // var Selected_Product_Quntity =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.num-pallets-input').val();
            // var Selected_Product_Price =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find("td.price-per-pallet span").text();
            // var Selected_Product_Amount =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find("td.row-total input")
            //     .val();

                var newCustomerForm = jQuery('#newCustomerForm').serialize();
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
                url: "http://staging.miracle-earnw.com/wp-admin/admin-ajax.php",
                //url: "http://localhost/Projects/Wordpress/miracle-earnw/wp-admin/admin-ajax.php",
                // url: "http://localhost/Projects/Wordpress/live_staging_miracle_new/wp-admin/admin-ajax.php",
                data: newCustomerForm,
                success: function(data){
                    // alert(data.valid);
                    // alert(data);
                    // console.log('Customer Createed');
                    // console.log(data);

                    let arr = data.split('|');
                    console.log(arr[0]);
                    console.log(arr[1]);
                    // console.log('Plan Listed');
                    jQuery('.customerDataHtml').html(arr[0]);
                    jQuery('.form_1_button').hide();
                    jQuery('#customerInformationForm2').css('opacity', 1);
                    jQuery('#customerInformationForm2').css('pointer-events', 'painted');
                    if (data) {
                        // swal("Great!", "Registration Successfully", "success");
                        // jQuery('#button').text('Checkout');
                          swal({
                              title: "Customer create successfully",
                              html: 'buttons',
                              type: "success",
                              showCancelButton: false,
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Please select plan",
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

    jQuery("#customerInformationForm2").validate({
        // rules: {
        //     email: {
        //         required: true,
        //         email:true,
        //     },
        //     phone: {
        //         required: true,
        //         number:true,
        //         min:10,
        //     }
        // },
        // messages: {
        //     customer_id: {
        //         required: "specify customer id"
        //     },
        //     first_name: {
        //         required: "specify First Name"
        //     }
        // },
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
            var Selected_Product_Name =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planName').val();
            var Selected_Product_Code =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planCode').val();
            var Selected_Product_Quntity =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planQty').val();
            var Selected_Product_Price =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planPrice').val();
            var Selected_Product_Amount =  jQuery("input[name=planFrequencyID]:checked").closest('tr').find('.planTotalPrice').val();
            var Selected_Product_Total_Amount =  jQuery(".totalAmount").closest('tr').find('.totalPrice').val();
            

            // var Selected_Plan =  jQuery("input[name=planFrequencyID]:checked").val();
            // var Selected_Product_Name =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.planName').val();
            // var Selected_Product_Code =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.planCode').val();
            // var Selected_Product_Quntity =  jQuery("input[name=planFrequencyID]:checked").parent().siblings("td").find('.planQty').val();
            // var Selected_Product_Price =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find(".planPrice").text();
            // var Selected_Product_Amount =  jQuery("input[name=planFrequencyID]:checked").parent().parent().find(".planTotalPrice")
            //     .val();

                var customerInformationForm2 = jQuery('#customerInformationForm2').serialize()  + "&Selected_Plan=" + Selected_Plan  + "&Selected_Product_Name=" + Selected_Product_Name + "&Selected_Product_Code=" + Selected_Product_Code + "&Selected_Product_Quntity=" + Selected_Product_Quntity + "&Selected_Product_Price=" + Selected_Product_Price + "&Selected_Product_Amount=" + Selected_Product_Amount
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
                url: "http://staging.miracle-earnw.com/wp-admin/admin-ajax.php",
                //url: "http://localhost/Projects/Wordpress/miracle-earnw/wp-admin/admin-ajax.php",
                // url: "http://localhost/Projects/Wordpress/live_staging_miracle_new/wp-admin/admin-ajax.php",
                data: customerInformationForm2,
                success: function(data){
                    // alert(data.valid);
                    // alert(data);
                    // console.log('Customer Createed');
                    console.log(data);
                    // console.log('Plan Listed');
                    jQuery('.planListHtml').html(data);
                    jQuery('.form_1_button').hide();
                    jQuery('#customerInformationForm2').css('opacity', 1);
                    jQuery('#customerInformationForm2').css('pointer-events', 'painted');
                    if (data) {
                        // swal("Great!", "Registration Successfully", "success");
                        // jQuery('#button').text('Checkout');
                          swal({
                              title: "Subscription plan create successfully",
                              html: 'buttons',
                              type: "success",
                              showCancelButton: false,
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Continue to Payment",
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