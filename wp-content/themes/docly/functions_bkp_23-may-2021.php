<?php
/**
 * docly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package docly
 */


if ( ! function_exists( 'docly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function docly_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gull, use a find and replace
	 * to change 'gull' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'docly', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable excerpt support for page
    add_post_type_support( 'page', 'excerpt' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    add_post_type_support( 'forum', 'thumbnail' );
    add_theme_support( 'post-formats', array( 'video', 'quote', 'link' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu'   => esc_html__( 'Main Menu', 'docly' ),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );
    add_theme_support( 'responsive-embeds' );
}
endif;
add_action( 'after_setup_theme', 'docly_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function docly_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'docly_content_width', 1170 );
}
add_action( 'after_setup_theme', 'docly_content_width', 0 );


/**
 * Constants
 * Defining default asset paths
 */
define('DOCLY_DIR_CSS', get_template_directory_uri().'/assets/css' );
define('DOCLY_DIR_JS', get_template_directory_uri().'/assets/js' );
define('DOCLY_DIR_VEND', get_template_directory_uri().'/assets/vendors' );
define('DOCLY_DIR_IMG', get_template_directory_uri().'/assets/img' );
define('DOCLY_DIR_FONT', get_template_directory_uri().'/assets/fonts' );


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';


/**
 * Theme's helper functions
 */
require get_template_directory() . '/inc/classes/Docly_helper.php';

/**
 * Theme's filters and actions
 */
require get_template_directory() . '/inc/filter_actions.php';
require get_template_directory() . '/inc/ajax_actions.php';
require get_template_directory() . '/inc/reg_process.php';

/**
 * Classes
 */
require get_template_directory() . '/inc/classes/Docly_Walker_Docs.php';
require get_template_directory() . '/inc/classes/Docly_Mobile_Nav_Walker.php';
require get_template_directory() . '/inc/classes/Docly_Walker_Docs_Onepage.php';
require get_template_directory() . '/inc/classes/Docly_Walker_Comment.php';
require get_template_directory() . '/inc/classes/Docly_Forum_Class.php';
// Updater
require get_template_directory() . '/inc/classes/Docly_base.php';
require get_template_directory() . '/inc/classes/Docly_register_theme.php';
require get_template_directory() . '/inc/classes/Docly_admin_page.php';
require get_template_directory() . '/inc/admin/dashboard/Docly_admin_dashboard.php';
require get_template_directory() . '/inc/classes/Docly_update_checker.php';

/**
 * Theme settings
 */
require get_template_directory() . '/options/opt-config.php';

/**
 * Configure one click demo
 */
require get_template_directory() . '/inc/demo_config.php';

/**
 * Required plugins activation
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Required plugins activation
 */
require get_template_directory() . '/inc/plugin_activation.php';

/**
 * Bootstrap Nav Walker
 */
require get_template_directory() . '/inc/classes/Docly_Nav_Walker.php';


/**
 * Register Sidebar Areas
 */
require get_template_directory() . '/inc/sidebars.php';



wp_enqueue_script('jquery');

function addCustomer() {

  global $wpdb;
 
  $selected_plan = $_POST['location_fusebill'];
  $l_warranty_date = $_POST['adContent'];
  $r_warranty_date = $_POST['campaign'];
  $plan_months = $_POST['planMonths'];
  $plan_interval = $_POST['earningInterval'];

  $post = array('reference'=> $_POST['referenceCustomerId'], //Customer Id
                'firstName'=> $_POST['firstName'], //First Name
                'lastName'=> $_POST['lastName'], //Last Name
                'primaryEmail'=> $_POST['primaryEmail'], //Primary Email
                'primaryPhone'=> $_POST['primaryPhone'], //Primary Phone

                'customerReference' => array(
                    'reference3'=> $_POST['reference3'], //Chargeable
                    'reference1'=> $_POST['reference1'], //Referrer
                    'salesTrackingCodes' => [array(
                                  'type' => 'Store',
                                  'code' => $_POST['location_fusebill'], //Store Location
                                  // "name" => $_POST['location_fusebill'], //Store Location
                      )]
                  ),

                'customerAcquisition' =>  array(
                      // 'medium'=> $_POST['serial_left_medium'], //Serial # Left
                      // 'source'=> $_POST['serial_right_source'], //Serial # Right

                      'adContent'=> $_POST['adContent'], //L Warranty Expiry
                      'campaign'=> $_POST['campaign'], //R Warranty Expiry

                      // 'landingPage'=> $_POST['landingPage'], //L Battery Size
                      // 'keyword'=> $_POST['keyword'], //R Battery Size
                ),
              );

  $data_json = json_encode($post);

  $curl = curl_init();

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
  $CustomerID = $result->id;

  curl_close($curl);
  // exit;
  // $CustomerID = $result->id;
  // $firstName = $result->firstName;
  // $lastName = $result->lastName;
  // $primaryEmail = $result->primaryEmail;
  // $primaryPhone = $result->primaryPhone;
  // $CustomerID = 9815871;
  // $firstName = "Jay";
  // $lastName = "Brack";
  // $primaryEmail = "jebrack@gmail.com";
  // $primaryPhone = "2069486303";
  // echo "customers ID: 9809503";
  // echo "<br>";
  if (!empty($_POST['planMonths']) && !empty($_POST['earningInterval'])) {
      $months = $_POST['planMonths'];
      $interver = $_POST['earningInterval'];

      if ($interver == 'Monthly') {
        $planString = 'm';
      } elseif ($interver == 'Yearly') {
        $planString = 'y';
      }

      $planCode ="hpp-".$months.$planString;
  }
  // echo "MonthCode: ".$planCode;
  // echo "<br>";

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
    if ($plan['code'] == $planCode) {
      array_push($planFrequenciesID, $plan['planFrequencies'][0]['id']);
    } 
  }

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
      
      /**
       * Step 4: Find Purchase Product Details
       * Use subscription response data and form post data
       */
      $productDetails = [];
      $count = 1;
      $html = '';
      foreach ($subscriptionResults->subscriptionProducts as $key => $row) {
        // echo "------------------<br>";
        // echo "<strong>Plan : ".$count."</strong><br>";
        // echo "----------------------------------------<br>";
        // echo "productCode: ".$row->planProduct->productCode."<br>";
        // echo "productName: ".$row->planProduct->productName."<br>";
        // echo "productId: ".$row->planProduct->productId."  | ";
        // echo "quantity: ".$row->planProduct->quantity."  |  ";
        // echo "Price: ".$row->planProduct->orderToCashCycles[0]->pricingModel->quantityRanges[0]->prices[0]->amount."<br>";
        $plan_html.= '<tr>
  	        <td class="text-center">
  	        	<input type="radio" id="plan_'.$row->planProduct->productId.'" name="planFrequencyID" value="'.$row->planProduct->productId.'" >
  	        </td>
  	        <td>
  	        	<label for="plan_'.$row->planProduct->productId.'">'.$row->planProduct->productName.'</label>
  		        <input type="hidden" name="planName" value="'.$row->planProduct->productName.'" class="planName" style="width: 75px;" >
  		        <input type="hidden" name="planCode" value="'.$row->planProduct->productCode.'" class="planCode" style="width: 75px;" >
  	        </td>
  	        <td>
  	        	<input type="number" name="planQty" value="1" class="'.$row->planProduct->quantity.'" style="width: 75px;" >
  	        </td>
  	        <td>
  	        	<span>'.$price.'</span>
  	          	<input type="hidden" name="planPrice" value="'.$price.'" class="planPrice">
  	          	<input type="hidden" name="mplanPrice" value="'.$price.'" class="mplanPrice">
  	        </td>
  	        <td>
  	        	<input type="text" name="planTotalPrice" value="'.$price.'" class="planTotalPrice" disabled="" style="width: 100px; text-align: right;">
          	</td>
  	      </tr>';
        $count++;
      }

      $html.= '<tr style="displsy:none;">
  		        <td class="text-center">
  		          <input type="hidden" id="customerId" name="customerId" value="'.$CustomerID.'" >
  		          
                <input type="hidden" id="firstName" name="firstName" value="'.$firstName.'" >
                <input type="hidden" id="lastName" name="lastName" value="'.$lastName.'" >
                <input type="hidden" id="primaryEmail" name="primaryEmail" value="'.$primaryEmail.'" >
                <input type="hidden" id="primaryPhone" name="primaryPhone" value="'.$primaryPhone.'" > 
                <input type="hidden" id="selected_plan" name="selected_plan" value="'.$selected_plan.'" > 
  		          
                <input type="hidden" id="l_warranty_date" name="l_warranty_date" value="'.$l_warranty_date.'" >
  		          <input type="hidden" id="r_warranty_date" name="r_warranty_date" value="'.$r_warranty_date.'" >
  		          <input type="hidden" id="plan_months" name="plan_months" value="'.$plan_months.'" >
  		          <input type="hidden" id="plan_interval" name="plan_interval" value="'.$plan_interval.'" >
  		        </td>
  	        </tr>';

          $html.='|<div class="fusebil_plan">Fusebil Plans</div>';

  echo  json_encode($html);
  // echo $html;
  die;

}
add_action('wp_ajax_addCustomer', 'addCustomer');
add_action('wp_ajax_nopriv_addCustomer', 'addCustomer');


function customerInformationForm2() {

 global $wpdb;
 // echo "<pre>";
 // print_r($_POST);
 // echo 
 // exit;
// $_POST['Selected_Plan'].' | '.
// $_POST['Selected_Product_Name'].'  | '.
// $_POST['Selected_Product_Code'].' | '.
// $_POST['Selected_Product_Quntity'].' | '.
// $_POST['Selected_Product_Price'].' | '.
// $_POST['Selected_Product_Amount'];
 // exit;

// $CustomerID = '9812932';

// $selected_plan = $_POST['selected_plan'];
// $l_warranty_date = $_POST['adContent'];
// $r_warranty_date = $_POST['campaign'];
// $plan_months = $_POST['planMonths'];
// $plan_interval = $_POST['earningInterval'];
// $CustomerID = 9815871;
//   $firstName = "Jay";
//   $lastName = "Brack";
//   $primaryEmail = "jebrack@gmail.com";
//   $primaryPhone = "2069486303";

$customer_update_data = array('id'=> $_POST['$CustomerID'], //Customer Id
                'firstName' => $_POST['firstName'],
                'middleName' => 'Dev',
                'lastName' => $_POST['lastName'],
                'primaryEmail' => $_POST['primaryEmail'],
                'primaryPhone' => $_POST['primaryPhone'],
                // 'status'=> "Active",
                'status'=> "Draft",
                'customerReference' => array(
                    'reference3'=> $_POST['reference3'], //Chargeable
                    'reference1'=> $_POST['reference1'], //Referrer
                    'salesTrackingCodes' => [array(
                                  'code' => 'Honolulu', //Store Location
                                  "name" => 'Honolulu', //Store Location
                                  'type' => 'Store',
                      )]
                  ),

                'customerAcquisition' =>  array(
                      'medium'=> $_POST['serial_left_medium'], //Serial # Left
                      'source'=> $_POST['serial_right_source'], //Serial # Right

                      'adContent'=> $_POST['l_warranty_date'], //L Warranty Expiry
                      'campaign'=> $_POST['r_warranty_date'], //R Warranty Expiry

                      'landingPage'=> $_POST['landingPage'], //L Battery Size
                      'keyword'=> $_POST['keyword'], //R Battery Size
                ),
              );

  $customer_update_data_json = json_encode($customer_update_data);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.fusebill.com/v1/customers',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS =>$customer_update_data_json,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);
  $CustomerID = $result->id;
  curl_close($curl);

  // Customer Update Address Preferences
  $address_preferences_data = array('id'=> $CustomerID, //Customer Id
                'contactName'=> $_POST['contactName'], //Contact Name
                'shippingInstructions'=> $_POST['shippingInstructions'],
                'useBillingAddressAsShippingAddress'=> $_POST['useBillingAddressAsShippingAddress'],

                // 'billingAddress' => array(
                //     'customerAddressPreferenceId'=> $CustomerID,
                //     'addressType'=> 'Billing',
                //     'companyName'=> "Svala", 
                //     'line1'=> $_POST['billing_address_1'], 
                //     'line2'=> $_POST['billing_address_2'], 
                //     'countryId'=> $_POST['billing_country'], 
                //     'country'=> $_POST['billing_country'], 
                //     'stateId'=> $_POST['billing_state'], 
                //     'state'=> $_POST['billing_city'],
                //     'city'=> $_POST['billing_city'],
                //     'valid'=> true,
                //     'postalZip'=> $_POST['billing_zipcode']
                //   ),
              );

  $address_preferences_data_json = json_encode($address_preferences_data);
  
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.fusebill.com/v1/CustomerAddressPreferences',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS =>$address_preferences_data_json,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);
  $CustomerID = $result->id;

  curl_close($curl);

  // Customer Billing Address data
  $billing_address_data = array('CustomerAddressPreferenceId'=> $CustomerID, 
                    'addressType'=> 'Billing',
                    'companyName'=> "", 
                    'line1'=> $_POST['billing_address_1'], 
                    'line2'=> $_POST['billing_address_2'], 
                    'countryId'=> $_POST['billing_country'],
                    'stateId'=> $_POST['billing_state'], 
                    'state'=> $_POST['billing_city'],
                    'city'=> $_POST['billing_city'],
                    'valid'=> true,
                    'postalZip'=> $_POST['billing_zipcode']
              );

  $billing_address_data_json = json_encode($billing_address_data);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.fusebill.com/v1/Addresses',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$billing_address_data_json,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);
  $CustomerID = $result->id;

  curl_close($curl);

  // Customer Shipping Address data
  $billing_address_data = array('CustomerAddressPreferenceId'=> $CustomerID, 
                    'addressType'=> 'Shipping',
                    'companyName'=> "", 
                    'line1'=> $_POST['shipping_address_1'], 
                    'line2'=> $_POST['shipping_address_2'], 
                    'countryId'=> $_POST['shipping_country'],
                    'stateId'=> $_POST['shipping_state'], 
                    'state'=> $_POST['shipping_state'],
                    'city'=> $_POST['shipping_state'],
                    'valid'=> true,
                    'postalZip'=> $_POST['shipping_zipcode']
              );

  $billing_address_data_json = json_encode($billing_address_data);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.fusebill.com/v1/Addresses',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$billing_address_data_json,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic MDpTaE45SHF5V2tzMEZCcldzckE3V2tyMXJvdTFDTm5tdUtaU2JWcmllSjAwS1hjZUZid1FuT1BnMnZrNGpKWkVJ',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);
  $CustomerID = $result->id;

  curl_close($curl);

echo  json_encode($CustomerID);
// echo $html;
die;

}
add_action('wp_ajax_customerInformationForm2', 'customerInformationForm2');
add_action('wp_ajax_nopriv_customerInformationForm2', 'customerInformationForm2');

