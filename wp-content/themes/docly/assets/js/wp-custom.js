/**
 * Search results
 */
function fetchResults(){
    let keyword = jQuery('#searchInput').val();
    if( keyword == "" ){
        jQuery('#docly-search-result').removeClass('ajax-search').html("");
    } else {
        jQuery.ajax({
            url: docly_local_object.ajaxurl,
            type: 'post',
            data: { action: 'docly_search_data_fetch', keyword: keyword  },
            success: function(data) {
                if(data.length > 0){
                    jQuery('#docly-search-result').addClass('ajax-search').html( data );
                }else{
                    var data_error = '<h5>No Results Found</h5>';
                    jQuery('#docly-search-result').addClass('ajax-search').html( data_error );
                }
            }
        });
    }
}

;(function ($) {
    $(document).ready(function () {
        /**
         * Search Keywords
         */
        $(".header_search_keyword ul li a").on("click", function (e) {
            e.preventDefault();
            var content = $(this).text();
            $("#searchInput").val(content).focus();
            fetchResults();
        });

        /**
         * Disable  enter key press on Forum Topics Filter search input field
         */
        $('.post-header .category-menu .cate-search-form').keypress(
            function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            }
        )

        $('.onepage-doc .nav-sidebar .nav-item:first-child').addClass('active');

        if($('.single-docs .elementor-widget-container > h2').length) {
            anchors.options = {
                icon: '#'
            };
            anchors.add('.elementor-widget-container > h2');
        }

        $('#searchInput').on('input', function(e) {
            if ( '' == this.value ) {
                $('#docly-search-result').removeClass('ajax-search');
            }
        });

        /**
         * Doc : On this page
         * @param str
         * @returns {string}
         */
        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
            var to   = "aaaaaeeeeeiiiiooooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function convertToTitle(Text)
        {
            let title = Text.replaceAll('-', ' ');
            return capitalizeFirstLetter(title)
        }

        function onThisPageTitles( divs ) {
            var titles = [];
            jQuery(divs).each(function () {
                titles.push( jQuery(this).attr("id") );
            });
            titles.forEach(onThisPage)

            function onThisPage(item, index) {
                if ( $('#navbar-example3').length ) {
                    document.getElementById("navbar-example3").innerHTML += "<a class='nav-link' href='#" + item + "'>" + convertToTitle(item) + "</a>";
                }
            }
        }

        onThisPageTitles( $( ".shortcode_info .elementor-widget-heading h2.elementor-heading-title" ).toArray() );
        onThisPageTitles( $( ".shortcode_info > h2" ).toArray() );

    })
})(jQuery);

/**
 * Registration Form
 */
if ( jQuery('.registerform').length ) {
    jQuery('.registerform').on("submit", function (e) {
        e.preventDefault();
        let ajax_url = docly_local_object.ajaxurl;
        jQuery.post(
            ajax_url,
            {
                data: jQuery(this).serialize(),
                action: 'dt_custom_registration_form'
            },
            function (res) {
                jQuery('#reg-form-validation-messages').html(res.data.message);
            }
        );
        return false;
    })
}