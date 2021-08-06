
function IsNumeric(n) {
    return !isNaN(n);
} 

function CleanNumber(value) {

    // Assumes string input, removes all commas, dollar signs, and spaces      
    newValue = value.replace(",","");
    newValue = newValue.replace("$","");
    newValue = newValue.replace(/ /g,'');
    return newValue;
    
}

function CommaFormatted(amount) {
    
  var delimiter = ","; 
  var i = parseInt(amount);
  
  if(isNaN(i)) { return ''; }
  
  i = Math.abs(i);
  
  var minus = '';
  if (i < 0) { minus = '-'; }
  
  var n = new String(i);
  var a = [];
  
  while(n.length > 3)
  {
    var nn = n.substr(n.length-3);
    a.unshift(nn);
    n = n.substr(0,n.length-3);
  }
  
  if (n.length > 0) { a.unshift(n); }
  
  n = a.join(delimiter);
  
  amount = "$" + minus + n;
  
  return amount;
  
}


// ORDER FORM UTILITY FUNCTIONS

function applyName(klass, numPallets) {

    var toAdd = jQuery("td." + klass).text();
    
    var actualClass = jQuery("td." + klass).attr("rel");
    
    jQuery("input." + actualClass).attr("value", numPallets + " pallets");
    
}

function removeName(klass) {
    
    var actualClass = jQuery("td." + klass).attr("rel");
    
    jQuery("input." + actualClass).attr("value", "");
    
}

function calcTotalPallets() {

    var totalPallets = 0;

    jQuery(".num-pallets-input").each(function() {
    
        var thisValue = parseInt(jQuery(this).val());
    
        if ( (IsNumeric(thisValue)) &&  (thisValue != '') ) {
            totalPallets += parseInt(thisValue);
        };
    
    });
    
    jQuery("#total-pallets-input").val(totalPallets);

}

function calcProdSubTotal() {
    
    var prodSubTotal = 0;

    jQuery(".row-total-input").each(function() {
    
        var valString = jQuery(this).val() || 0;
        
        prodSubTotal += parseFloat(valString);
                    
    });
        
    jQuery("#product-subtotal").val(prodSubTotal.toFixed(2));

}

function calcShippingTotal() {

    var totalPallets = jQuery("#total-pallets-input").val() || 0;
    var shippingRate = jQuery("#shipping-rate").text() || 0;
    var shippingTotal = totalPallets * shippingRate;
    
    jQuery("#shipping-subtotal").val(CommaFormatted(shippingTotal));

}

function calcOrderTotal() {

    var orderTotal = 0;

    var productSubtotal = jQuery("#product-subtotal").val() || 0;
    var shippingSubtotal = jQuery("#shipping-subtotal").val() || 0;
    var underTotal = jQuery("#under-box").val() || 0;
        
    var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(shippingSubtotal));    
        
    jQuery("#order-total").val(CommaFormatted(orderTotal));
    
    jQuery("#fc-price").attr("value", orderTotal);
    
}

// DOM READY
jQuery(function() {

    var inc = 1;

    jQuery(".product-title").each(function() {
        
        jQuery(this).addClass("prod-" + inc).attr("rel", "prod-" + inc);
    
        var prodTitle = jQuery(this).text();
                
        jQuery("#foxycart-order-form").append("<input type='hidden' name='" + prodTitle + "' value='' class='prod-" + inc + "' />");
        
        inc++;
    
    });
    
    // Reset form on page load, optional
    jQuery("#order-table input[type=text]:not('#product-subtotal')").val("");
    jQuery("#product-subtotal").val("$0");
    jQuery("#shipping-subtotal").val("$0");
    jQuery("#fc-price").val("$0");
    jQuery("#order-total").val("$0");
    jQuery("#total-pallets-input").val("0");
    
    jQuery('input[name=plan]').change(function(){
var value = jQuery( 'input[name=plan]:checked' ).val();
// alert(value);
if(value == 'Monthly'){
    jQuery(".price-per-pallet span").each(function() {
 var $el = jQuery(this);
         var multiplier = $el
            .text();
            // alert(multiplier);
             var rowTotal =  multiplier / 12;
             $el.text(rowTotal.toFixed(2));
    })
}else{

 jQuery(".price-per-pallet span").each(function() {
 var $el = jQuery(this);
         var multiplier = $el
            .text();
           // alert(multiplier);
             var rowTotal = 12 * multiplier;
             $el.text(rowTotal.toFixed(2));
    })
}
 jQuery('.num-pallets-input').val('');
 jQuery('.row-total-input').val('');

});

    // "The Math" is performed pretty much whenever anything happens in the quanity inputs
    jQuery('.num-pallets-input').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = jQuery(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal.toFixed(2));
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
        
        // If the quantity is invalid, let the user know with UI change                                    
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        // Calcuate the overal totals
        calcProdSubTotal();
        calcTotalPallets();
        calcShippingTotal();
        calcOrderTotal();
    
    });

});