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
.form_step_2 {
    opacity: 0.2;
    pointer-events: none;
}

.form_step_3 {
    opacity: 0.2;
    pointer-events: none;
}
.divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}
</style>
<?php
/* Template Name: User Registration */


get_header();
global $wpdb;
if(isset($_POST['btnregister'])) {

    var_dump($_POST);
    exit();


    $username = $wpdb->prepare($_POST['user_login']);
    $email = $wpdb->prepare($_POST['txtEmail']);
    $password = $wpdb->prepare($_POST['txtPassword']);
    $ConfPassword = $wpdb->prepare($_POST['txtConfirmPassword']);
    $error = array();
    if (strpos($username, ' ') !== FALSE) {
        $error['username_space'] = "Username has Space";
    }

    if (count($error) == 0) {

        wp_create_user($username, $password, $email);
        echo "User Created Successfully";
        exit();
    }else{

        print_r($error);

    }

}


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
        <div class="card bg-light" style="width: 50%;margin-left: 20%;margin-left: 20%; ">
                <article class="card-body" style="width: fit-content;">
                    <form method="POST" id="newCustomerForm" >
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                                 <input name="full_name" id="full_name" class="form-control" placeholder="Full name" type="text">
                             </div> <!-- form-group// -->
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user-circle"></i> </span>
                                    </div>
                                    <input name="user_login" id="user_login" class="form-control" placeholder="User Name" type="text">
                                </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email_address" id="email_address" class="form-control" placeholder="Email address" type="email"  required>
                        </div> <!-- form-group// -->

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control"  name="password" id="password" placeholder="Create password" type="password">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" name="confirm_password" id="confirm_password" placeholder="Repeat password" type="password">
                        </div> <!-- form-group// -->
                        <div class="col text-center" style="width: 50%;margin-left: 25%;">
                            <input type="hidden" name="action" value="newCustomer"/>
                            <button type="submit" class="btn btn-primary btn-block" name="btnregister"> Create Account  </button>
                        </div> <!-- form-group// -->

            </form>
            </article>
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
get_footer();
?>
<script src="<?php echo DOCLY_DIR_JS ?>/order.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type='text/javascript'>
jQuery(document).ready(function() {

    jQuery.validator.addMethod( "nowhitespace", function( value, element ) {
        return this.optional( element ) || /^\S+$/i.test( value );
    }, "No white space please" );


    jQuery("#newCustomerForm").validate({
        rules: {
            full_name : {
                required: true,
                minlength: 5
            },
            user_login : {
                required: true,
                minlength: 5,
                nowhitespace: true
            },
            email: {
                required: true,
                email:true,
            },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            confirm_password: {
                required: "Please provide a confirm password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Please enter the same password as above"
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
            var customerId = jQuery('#email_address').val();
            var newCustomerForm = jQuery('#newCustomerForm').serialize();

            jQuery.ajax({
                type: "POST",
                // url: "https://miracle-earnw.com/wp-admin/admin-ajax.php",
                url: "http://localhost/miracle/wp-admin/admin-ajax.php",
                data: newCustomerForm,
                success: function(response){
                    var JSONObjectArraya =JSON.parse(response);
                    console.log(JSONObjectArraya.status);
                    if ( JSONObjectArraya.status == 1 )
                    {

                        //alert(JSONObjectArraya.message);
                        swal("Ohh", JSONObjectArraya.message, "error");
                        //document.getElementById("newCustomerForm").submit();
                    }
                    else if ( JSONObjectArraya.status == 2 )
                    {
                        swal("Ohh", JSONObjectArraya.message, "error");
                    }
                    else if ( JSONObjectArraya.status == 3 )
                    {
                        swal({
                            title: "User successfully created",
                            html: 'buttons',
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Thank You",
                            closeOnConfirm: false
                        });

                        // alert('Registration Successfully');
                        var url      = "https://miracle-earnw.com";
                        window.location.href=url;
                    }
                    else
                    {
                        swal("Ohh", JSONObjectArraya.message, "error");
                    }
                }
            });
        }
    });
});
</script>
