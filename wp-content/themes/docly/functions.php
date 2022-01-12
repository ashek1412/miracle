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

//wp_enqueue_script('jquery');






function addCustomer() {



    $fusebill_id=null;
    $APIKEY=$GLOBALS['API_KEY'];

    $referenceid= $_POST['referenceCustomerId'];
    $firstName= $_POST['firstName']; //First Name
    $lastName= $_POST['lastName']; //Last Name
    $primaryEmail= $_POST['primaryEmail']; //Primary Email
    $primaryPhone= $_POST['primaryPhone']; //Primary Phone



    if(strlen($referenceid)==0)
    {
        $edata[0]="error";
        $edata[1]="Customer ID is blank";
        echo json_encode($edata);
        die;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/customers?query=reference:'.$referenceid,
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers?query=reference:'.$referenceid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>'',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);
    curl_close($curl);



    if(isset($result->ErrorId)) {

        $edata[0]="error";
        $edata[1]=$result->Errors->Value;
        echo json_encode($edata);
        die;
    }






    if(count($result)>0)
    {

        $fusebill_id=$result[0]->id;
    }
    else
    {

        $post = array(
            'firstName'=> $_POST['firstName'],
            'lastName'=> $_POST['lastName'],
            'primaryEmail'=> $_POST['primaryEmail'],
            'primaryPhone'=> $_POST['primaryPhone'],
            'reference'=> $referenceid
        );


        $data_json = json_encode($post);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://secure.fusebill.com/v1/customers',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);

        if(isset($result->ErrorId)) {
            $edata[0]="error";
            $edata[1]=$result->Errors->Value;
            echo json_encode($edata);
            die;
        }

        $fusebill_id = $result->id;

    }





    $selected_plan = $_POST['location_fusebill'];
    $l_warranty_date = $_POST['adContent'];
    $r_warranty_date = $_POST['campaign'];
    $plan_months = $_POST['planMonths'];
    $payment_date=$_POST['payment_date'];
    $plan_interval = $_POST['earningInterval'];


   if($payment_date !=$r_warranty_date)
    {
        $paymentDate=new DateTime($payment_date);
        $warrantyDate=new DateTime($r_warranty_date);
    }



    if (!empty($_POST['planMonths']) && !empty($_POST['earningInterval'])) {
        $months = $_POST['planMonths'];
        $interver = $_POST['earningInterval'];

        if ($interver == 'Monthly') {

            if($paymentDate>$warrantyDate)
            {
                $months=24-$months;
            }

            $planString = 'm';
        } elseif ($interver == 'Yearly') {
            $planString = 'y';
            if($paymentDate>$warrantyDate)
            {
                $months=12;
            }

            $months=intval($months/12);
        }

        $planCode ="hpp-".$months.$planString;
    }


//    var_dump($planCode);
//
//    exit();





    //$ch = curl_init('https://secure.fusebill.com/v1/Plans?query=status:Active');
    $ch = curl_init('https://stg-secure.fusebill.com/v1/Plans?query=status:Active');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . $APIKEY
    ));
    $planDatas = json_decode(curl_exec($ch),true);
    curl_close($ch);


    if(isset($planDatas->ErrorId)) {
        $edata[0]="error";
        $edata[1]=$result->Errors->Value;
        echo json_encode($edata);
        die;

    }

    $planFrequenciesID = array();
    $batteryplanid="";


    foreach ($planDatas as $key => $plan) {

        if ($plan['code'] == $planCode) {
            array_push($planFrequenciesID, $plan['planFrequencies'][0]['id']);
        }
        if ($plan['code'] == "batteryplan") {
            // array_push($planFrequenciesID, $plan['planFrequencies'][0]['id']);
            $batteryplanid=$plan['planFrequencies'][0]['id'];
        }


    }

    array_push($planFrequenciesID,$batteryplanid);


//
//        echo "<pre>";
//        echo $planCode;
//        print_r($planFrequenciesID);
//        echo "</pre>";
//        exit;



    //Check customer subscription

    $curl = curl_init();
    curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://secure.fusebill.com/v1/customers/'.$fusebill_id.'/subscriptions?query=status:Active,Draft',
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers/'.$fusebill_id.'/subscriptions?query=status:Active,Draft',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $customer_subscription = json_decode($response);
    curl_close($curl);


//    echo "<pre>";
//    print_r($customer_subscription);
//    echo "</pre>";
//    exit;


    if(isset($customer_subscription->ErrorId)) {
        $edata[0]="error";
        $edata[1]=$customer_subscription->Errors->Value;
        echo json_encode($edata);
        die;
    }






    if(count($customer_subscription)==0) {


        $payment_date= $_POST['payment_date']; //Payment Date
        $today=date("Y-m-d");
        if($today!=$payment_date) {

            $subscriptionData = array('CustomerID' => $fusebill_id,
                'planFrequencyID' => $planFrequenciesID[0],
                'scheduledActivationTimestamp' => $payment_date
            );


        }
        else
        {
            $subscriptionData = array('CustomerID' => $fusebill_id,
                'planFrequencyID' => $planFrequenciesID[0]
            );
        }



        $subscription_json = json_encode($subscriptionData);
        $curl = curl_init();


        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/subscriptions',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/subscriptions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $subscription_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $customer_subscription = json_decode($response);
        curl_close($curl);
        $customer_subscription=$customer_subscription->subscriptionProducts;



    }
    else
    {
        if($customer_subscription[0]->status=="Active")
        {
            $edata[0]="error";
            $edata[1]="Customer already have active subscription";
            echo json_encode($edata);
            die;

        }
        $customer_subscription=$customer_subscription[0]->subscriptionProducts;

    }

//        echo "<pre>";
//        print_r($customer_subscription);
//        echo "</pre>";
//        exit;



    if(isset($customer_subscription->ErrorId)) {
        $edata[0]="error";
        $edata[1]=$customer_subscription->Errors->Value;
        echo json_encode($edata);
        die;
    }






    /**
     * Step 4: Find Purchase Product Details
     * Use subscription response data and form post data
     */
    $productDetails = null;
    $count = 0;
    $subdetail =null;

//    echo "<pre>";
//    print_r($customer_subscription);
//    echo "</pre>";
//    exit;



    //$customer_subscription=$customer_subscription[0]->subscriptionProducts;



    $plan_html="";

    foreach ($customer_subscription as $row) {


        $productDetails=$row;
        $subdetail[$count]['subscriptionId']=$productDetails->subscriptionId;
        $subdetail[$count]['productCode']=$productDetails->planProduct->productCode;
        $subdetail[$count]['productId']=$productDetails->id;
        $count++;

    }
    $subdetail[$count]['subscriptionId']="";
    $subdetail[$count]['productCode']="batteryplan";
    $subdetail[$count]['productId']=$planFrequenciesID[1];



    $html[0]= '<tr style="displsy:none;">
  		        <td class="text-center">
  		          <input type="hidden" id="customerId" name="customerId" value="'.$fusebill_id.'" >
  		          <input type="hidden" id="customerrefId" name="customerrefId" value="'.$referenceid.'" >
              <input type="hidden" name="subscriptionId" id="subscriptionId" value="'. $subdetail[0]['subscriptionId'].'" class="planCode" style="width: 75px;" >
                <input type="hidden" id="firstName" name="firstName" value="'.$firstName.'" >
                <input type="hidden" id="lastName" name="lastName" value="'.$lastName.'" >
                <input type="hidden" id="primaryEmail" name="primaryEmail" value="'.$primaryEmail.'" >
                <input type="hidden" id="primaryPhone" name="primaryPhone" value="'.$primaryPhone.'" > 
                <input type="hidden" id="selected_plan" name="selected_plan" value="'.$selected_plan.'" > 
                 <input type="hidden" id="payment_date" name="payment_date" value="'.$payment_date.'" > 
  		          
                <input type="hidden" id="l_warranty_date" name="l_warranty_date" value="'.$l_warranty_date.'" >
  		          <input type="hidden" id="r_warranty_date" name="r_warranty_date" value="'.$r_warranty_date.'" >
  		          <input type="hidden" id="plan_months" name="plan_months" value="'.$plan_months.'" >
  		          <input type="hidden" id="plan_interval" name="plan_interval" value="'.$plan_interval.'" >
  		        </td>
  	        </tr>';

    $html[1]=$subdetail;

//        echo "<pre>";
//        print_r($subdetail);
//        echo "</pre>";
//        exit;

    echo  json_encode($html);
    die;

}
add_action('wp_ajax_addCustomer', 'addCustomer');
add_action('wp_ajax_nopriv_addCustomer', 'addCustomer');


function customerInformationForm2() {

    global $wpdb;

    $APIKEY=$GLOBALS['API_KEY'];
    $CustomerID=$_POST['customerId'];
    $subscriptionId=$_POST['subscriptionId'];
    $planCode=$_POST['Selected_Product_Code'];

    //echo "<pre>";
    // print_r($planCode);
    // echo "</pre>";
    // exit;


    if($planCode=="batteryplan")
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/subscriptions/Delete/'. $subscriptionId,
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/subscriptions/Delete/'. $subscriptionId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS =>'',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);

        if(isset($result->ErrorId)) {
            echo json_encode("error");
            die;
        }
        else
        {
            $payment_date= $_POST['payment_date']; //Payment Date
            $today=date("Y-m-d");
            if($today!=$payment_date) {

                $subscriptionData = array('CustomerID' => $CustomerID,
                    'planFrequencyID' => $_POST['Selected_Product_id'],
                    'scheduledActivationTimestamp' => $payment_date
                );
            }
            else
            {
                $subscriptionData = array('CustomerID' => $CustomerID,
                    'planFrequencyID' => $_POST['Selected_Product_id']
                );
            }

            $subscription_json = json_encode($subscriptionData);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                // CURLOPT_URL => 'https://secure.fusebill.com/v1/subscriptions',
                CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/subscriptions',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $subscription_json,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic '.$APIKEY,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            curl_close($curl);

            $_POST['Selected_Product_id']=$result->subscriptionProducts[0]->id;
        }

    }



    $customer_update_data = array('id'=> $CustomerID, //Customer Id
        'firstName' => $_POST['firstName'],
        'middleName' => '',
        'lastName' => $_POST['lastName'],
        'primaryEmail' => $_POST['primaryEmail'],
        'primaryPhone' => $_POST['primaryPhone'],
        'reference'=> $_POST['customerrefId'],
        'status'=>'Draft',
        'currency'=>'USD',
        'customerReference' => array(
            'reference3'=> $_POST['reference3'], //Chargeable
            'reference1'=> '', //Referrer
            'salesTrackingCodes' => [array(
                'code' => $_POST['selected_plan'], //Store Location
                "name" => $_POST['selected_plan'], //Store Location
                'type' => 'Store',
            )]
        ),

        'customerAcquisition' =>  array(

            'medium'=> $_POST['serial_right_source'], //Serial # Left
            'source'=> $_POST['serial_left_medium'], //Serial # Right
            // 'medium'=> $_POST['serial_left_medium'], //Serial # Left

            'adContent'=> $_POST['l_warranty_date'], //L Warranty Expiry
            'campaign'=> $_POST['r_warranty_date'], //R Warranty Expiry

            'landingPage'=> $_POST['landingPage'], //L Battery Size
            'keyword'=> $_POST['keyword'], //R Battery Size
        ),
    );

    $customer_update_data_json = json_encode($customer_update_data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/customers',
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>$customer_update_data_json,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);
    curl_close($curl);


//
//      echo "<pre>";
//   print_r($result);
//   echo "</pre>";
//   exit;

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }

    if($_POST['useBillingAddressAsShippingAddress']!=true)
        $_POST['useBillingAddressAsShippingAddress']=false;

    // Customer Update Address Preferences
    $address_preferences_data = array('id'=> $CustomerID, //Customer Id
        'contactName'=> $_POST['contactName'], //Contact Name
        'shippingInstructions'=> $_POST['shippingInstructions'],
        'useBillingAddressAsShippingAddress'=> $_POST['useBillingAddressAsShippingAddress'],


    );

    $address_preferences_data_json = json_encode($address_preferences_data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/CustomerAddressPreferences',
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/CustomerAddressPreferences',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>$address_preferences_data_json,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);
    curl_close($curl);
    //echo "<pre>";
    //print_r($result);
    //echo "</pre>";
    //exit;

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }

    $billing_address_id=null;
    $shipping_address_id=null;
    if(empty($result->billingAddress->line1)) {
        //Add  Customer Billing Address data
        $billing_address_data = array('CustomerAddressPreferenceId' => $CustomerID,
            'addressType' => 'Billing',
            'companyName' => "",
            'line1' => $_POST['billing_address_1'],
            'line2' => $_POST['billing_address_2'],
            'countryId' => $_POST['billing_country'],
            'stateId' => $_POST['billing_state'],
            'city' => $_POST['billing_city'],
            //'valid' => true,
            'postalZip' => $_POST['billing_zipcode']
        );

        $billing_address_data_json = json_encode($billing_address_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://secure.fusebill.com/v1/Addresses',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/Addresses',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $billing_address_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);


        //$billing_address_id=$result->id;
    }

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }


    //  echo "<pre>";
    //  print_r($result );
    // echo "</pre>";
    // exit;


    if(empty($result->shippingAddress->line1)) {
        // Customer Shipping Address data
        $shipping_address_data = array('CustomerAddressPreferenceId' => $CustomerID,
            'addressType' => 'Shipping',
            'companyName' => "",
            'line1' => $_POST['shipping_address_1'],
            'line2' => $_POST['shipping_address_2'],
            'countryId' => $_POST['shipping_country'],
            'stateId' => $_POST['shipping_state'],
            'city' => $_POST['shipping_city'],
            //'valid' => true,
            'postalZip' => $_POST['shipping_zipcode']

        );

        $shipping_address_data_json = json_encode($shipping_address_data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/Addresses',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/Addresses',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $shipping_address_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);

        curl_close($curl);

    }

//      echo "<pre>";
//      print_r($result );
//     echo "</pre>";
//     exit;

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }




    $html.= '<td class="sanjay">
  <input type="hidden" name="customerID" value="'.$CustomerID.'">
            <input type="hidden" name="Selected_Product_id" value="'.$_POST['Selected_Product_id'].'">
            <input type="hidden" name="subscriptionId" value="'.$_POST['subscriptionId'].'">
            '.$_POST['Selected_Product_Name'].'
            <input type="hidden" name="planName" value="'.$_POST['Selected_Product_Name'].'">
          </td>
          <td>
            '.$_POST['Selected_Product_Quntity'].'
            <input type="hidden" name="planQty" value="'.$_POST['Selected_Product_Quntity'].'">
          </td>
          <td>
            '.$_POST['Selected_Product_Price'].'
            <input type="hidden" name="planPrice" value="'.$_POST['Selected_Product_Price'].'">
          </td>
          <td>
            '.$_POST['Selected_Product_Price']*$_POST['Selected_Product_Quntity'].'
            <input type="hidden" name="planTotalPrice" value="'.$_POST['Selected_Product_Price']*$_POST['Selected_Product_Quntity'].'">
          </td>';


    $html.='|<td colspan="3" style="text-align: right">Subtotal:<br>Pending Charges:</td>
                <td>$'.$_POST['Selected_Product_Price']*$_POST['Selected_Product_Quntity'].'<br>$'.$_POST['Selected_Product_Price']*$_POST['Selected_Product_Quntity'].'
                  <input type="hidden" name="Subtotal" value="'.$_POST['Selected_Product_Price']*$_POST['Selected_Product_Quntity'].'">
                  <input type="hidden" name="CustomerID" value="'.$CustomerID.'">
                </td>';
    //billing address
    $html.='|'.$_POST['billing_address_1'].'|'.$_POST['billing_address_2'].'|'.$_POST['billing_city'].'|'.$_POST['billing_country'].'|'.$_POST['billing_state'].'|'.$_POST['billing_zipcode'];


    echo json_encode($html);
// echo $html;
    die;

}
add_action('wp_ajax_customerInformationForm2', 'customerInformationForm2');
add_action('wp_ajax_nopriv_customerInformationForm2', 'customerInformationForm2');


function findandReplace(&$array,$amount) {
    foreach($array as $key => &$value)
    {
        if(is_array($value))
        {
            findandReplace($value,$amount);
        }
        else{

            if ($key == 'amount') {
                // echo $key." = ".$value."<br />\n";
                $array['amount'] =$amount;
                //break;
            }
//            if ($key == 'monthlyRecurringRevenue') {
//                // echo $key." = ".$value."<br />\n";
//                $array['monthlyRecurringRevenue'] =$amount;
//                //break;
//            }
//            if ($key == 'netMonthlyRecurringRevenue') {
//                // echo $key." = ".$value."<br />\n";
//                $array['netMonthlyRecurringRevenue'] =$amount;
//                //break;
//            }
            if ($key == 'lastPurchaseDate') {
                // echo $key." = ".$value."<br />\n";
                $array['lastPurchaseDate'] = date("Y-m-d H:i:s");
                //break;
            }
            if ($key == 'isIncluded') {
                // echo $key." = ".$value."<br />\n";
                $array['isIncluded'] = true;
                //break;
            }
        }
    }

    return $array;
}




//Checkout Form
function planCheckoutForm() {

    global $wpdb;
    $APIKEY=$GLOBALS['API_KEY'];
    $customerId = $_POST['CustomerID'];
    $subscriptionId=$_POST['subscriptionId'];
    $Selected_Product_id=$_POST['Selected_Product_id'];

    $Selected_Product_Amount=$_POST['planTotalPrice'];
    $amount=$_POST['planTotalPrice'];
    $sourceType=$_POST['source'];
    $paymentMethod="";
    $paymentId="";

    //get subscription product
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/SubscriptionProducts/'.$Selected_Product_id,
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/SubscriptionProducts/' . $Selected_Product_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => '',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . $APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response,true);
    curl_close($curl);

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }

//    echo "<pre>";
//    print_r($result);
//    exit;





    findandReplace($result,$amount);
    // echo "<pre>";
    // print_r($result);

//    echo "<pre>";
//    print_r($result);
//    exit;
    $subscription_product_info = json_encode($result);




    //update subscription product
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/SubscriptionProducts/'.$Selected_Product_id,
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/SubscriptionProducts/' . $Selected_Product_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $subscription_product_info,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . $APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);
    curl_close($curl);


//    echo "<pre>";
//    print_r($result);
//    exit;

    //activate customer
    $customer_info=array('customerId' => $customerId,
        'activateAllSubscriptions' => true

    );

    $customer_info=json_encode($customer_info);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://secure.fusebill.com/v1/customeractivation/',
        CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customeractivation/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $customer_info,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . $APIKEY,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response,true);
    curl_close($curl);

    if(isset($result->ErrorId)) {
        echo json_encode("error");
        die;
    }

//
//    echo "<pre>";
//    print_r($result);
//    exit;



    if ($_POST['paymentMethod'] == 'ACH' ) {
        $paymentMethod = 'ACH';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/customers/'.$customerId.'/paymentMethods/creditCard',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers/' . $customerId . '/paymentMethods/achCard',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);

        if (isset($result->ErrorId)) {
            echo json_encode("error");
            die;
        }


        if (count($result) == 0) {

            $payment_data = array('customerId' => $_POST['CustomerID'],

                'transitNumber' => $_POST['transit_number'],
                'accountNumber' => $_POST['account_number'],
                'bankAccountType' => $_POST['bank_account_type'],
                'firstName' => $_POST['first_name'],
                'lastName' => $_POST['last_name'],
                'address1' => $_POST['billing_address_1'],
                'address2' => $_POST['billing_address_2'],
                'city' => $_POST['billing_city'],
                'stateId' => $_POST['billing_state'],
                'countryId' => $_POST['billing_country'],
                'postalZip' => $_POST['billing_zipcode'],
                'source' => 'Manual'
            );

            $payment_data_json = json_encode($payment_data);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                //CURLOPT_URL => 'https://secure.fusebill.com/v1/paymentMethods/achCard',
                CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/paymentMethods/achCard',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payment_data_json,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . $APIKEY,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            curl_close($curl);

            if (isset($result->ErrorId)) {
                echo json_encode("error");
                die;
            }

            if(!empty($result->id))
            {
                $paymentId = $result->id;
            }

        }
        else
        {
            if(!empty($result[0]->id))
            {
                $paymentId = $result[0]->id;
            }


        }
    }
    else if ($_POST['paymentMethod'] == 'CreditCard' ) {

        $paymentMethod = 'CreditCard';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/customers/'.$customerId.'/paymentMethods/creditCard',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/customers/' . $customerId . '/paymentMethods/creditCard',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);

        if (isset($result->ErrorId)) {
            echo json_encode("error");
            die;
        }

        if (count($result) == 0) {

            $payment_data = array('customerId' => $_POST['CustomerID'],
                'cardNumber' => $_POST['card_number'],
                'expirationMonth' => $_POST['expiry_month'],
                'expirationYear' => $_POST['expiry_year'],
                'cvv' => $_POST['card_cvv'],
                'firstName' => $_POST['first_name'],
                'lastName' => $_POST['last_name'],
                'address1' => $_POST['billing_address_1'],
                'address2' => $_POST['billing_address_2'],
                'city' => $_POST['billing_city'],
                'stateId' => $_POST['billing_state'],
                'countryId' => $_POST['billing_country'],
                'postalZip' => $_POST['billing_zipcode'],
                'isDefault' => true
            );

            $payment_data_json = json_encode($payment_data);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                //CURLOPT_URL => 'https://secure.fusebill.com/v1/paymentMethods/creditCard',
                CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/paymentMethods/creditCard',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payment_data_json,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . $APIKEY,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            curl_close($curl);

            if (isset($result->ErrorId)) {
                echo json_encode($result->Errors);
                die;
            }
            if(!empty($result->id))
            {
                $paymentId = $result->id;
            }

        }
        else
        {
            if(!empty($result[0]->id))
            {
                $paymentId = $result[0]->id;
            }

        }
    }





//    echo "<pre>";
//    echo "id:".$paymentId;
//    print_r($result);
//     exit;



    //make payment

    if($paymentMethod=="ACH")
    {
        $payment_id=$paymentId;

        $payment_post_data = array('customerId' => $_POST['CustomerID'],
            'amount' =>  $Selected_Product_Amount,
            'paymentMethod' =>'ACH',
            'paymentMethodId' => $payment_id,
            'source' => 'Manual'
        );

        $payment_post_data_json = json_encode($payment_post_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/payments',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payment_post_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);

//        echo "<pre>";
//        print_r($result);
//        exit;
        if(isset($result->ErrorId))
            echo json_encode("error");
        else
            echo json_encode("success");
        die;

    }
    else if($paymentMethod=="CreditCard")
    {

        $payment_id=$paymentId;

        $payment_post_data = array('customerId' => $_POST['CustomerID'],
            'amount' =>  $Selected_Product_Amount,
            'paymentMethod' =>'CreditCard',
            'paymentMethodId' => $payment_id,
            'source' => 'Manual',
            'autoAllocate' => true


        );

        $payment_post_data_json = json_encode($payment_post_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/payments',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payment_post_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);

//      echo "<pre>";
//      print_r($result);
//      exit;
        curl_close($curl);

        if(isset($result->ErrorId))
            echo json_encode("error");
        else
            echo json_encode("success");
        die;

    }
    else if($_POST['paymentMethod']=="Cash")
    {
        $payment_post_data = array('customerId' => $_POST['CustomerID'],
            'amount' =>  $Selected_Product_Amount,
            'paymentMethod' =>'Cash',
            'source' => $sourceType,
            'autoAllocate' => true
        );

        $payment_post_data_json = json_encode($payment_post_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/payments',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payment_post_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);

//        echo "<pre>";
//        print_r($result);
//        exit;
        curl_close($curl);

        if(isset($result->ErrorId))
            echo json_encode("error");
        else
            echo json_encode("success");
        die;

    }
    else if($_POST['paymentMethod']=="Check")
    {



        $payment_post_data = array('customerId' => $_POST['CustomerID'],
            'amount' =>  $Selected_Product_Amount,
            'paymentMethod' =>'Check',
            'source' => $sourceType,
            'autoAllocate' => true


        );

        $payment_post_data_json = json_encode($payment_post_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/payments',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payment_post_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);

//        echo "<pre>";
//        print_r($result);
//        exit;
        curl_close($curl);
        if(isset($result->ErrorId))
            echo json_encode("error");
        else
            echo json_encode("success");
        die;

    }
    else if($_POST['paymentMethod']=="DirectDeposit")
    {



        $payment_post_data = array('customerId' => $_POST['CustomerID'],
            'amount' =>  $Selected_Product_Amount,
            'paymentMethod' =>'DirectDeposit',
            'source' => $sourceType,
            'autoAllocate' => true


        );

        $payment_post_data_json = json_encode($payment_post_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://secure.fusebill.com/v1/payments',
            CURLOPT_URL => 'https://stg-secure.fusebill.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payment_post_data_json,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $APIKEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);

//        echo "<pre>";
//        print_r($result);
//        exit;
        curl_close($curl);
        if(isset($result->ErrorId))
            echo json_encode("error");
        else
            echo json_encode("success");
        die;

    }



    if(isset($result->ErrorId))
        echo json_encode("error");
    else
        echo json_encode("success");
    die;


}

add_action('wp_ajax_planCheckoutForm', 'planCheckoutForm');
add_action('wp_ajax_nopriv_planCheckoutForm', 'planCheckoutForm');


function newCustomer()
{


    $post_data = array(
        'display_name' => $_POST['full_name'],
        'user_login' => $_POST['user_login'],
        'user_nicename' => $_POST['user_login'],
        'user_email' => $_POST['email_address'],
        'user_pass' => $_POST['password'],
        'email' => $_POST['email_address']
    );


    $check_email = "email_address=".$_POST['email_address'];

    // $check_email = array('email_address' => $_POST['email_address']);


    // $check_email = json_encode($check_email);


    $curl = curl_init();
    curl_setopt_array($curl, array(

        CURLOPT_URL => 'https://phpstack-426242-1347501.cloudwaysapps.com/fetch_email_companydirectory.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $check_email,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);



    if($result->status==0)
    {

        $user_name_exists = get_user_by( 'login', $_POST['user_login'] );
        $user_mail_exists = get_user_by( 'email', $_POST['email_address'] );
        if ( empty( $user_name_exists ) && empty( $user_mail_exists )  )
        {

            $user_id = wp_insert_user($post_data);
            if($user_id>0) {
                $result = array('status' => 3, message => 'User Already Exist this with User name or email');
                echo json_encode($result);
                exit;
            }
            else
            {
                $result = array('status' => 4, message => 'Cannot Create user');
                echo json_encode($result);
                exit;

            }


        }
        else
        {
            $result=array('status'=>2, message=>'User Already Exist this with User name or email');
            echo json_encode($result);
            exit;

        }

    }
    else
    {
        echo json_encode($result);
        exit;

    }
}

add_action('wp_ajax_newCustomer', 'newCustomer');
add_action('wp_ajax_nopriv_newCustomer', 'newCustomer');

