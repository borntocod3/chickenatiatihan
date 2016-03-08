jQuery(document).ready(function($){
    /*
     Radio button
     */
    $('#paypal-content').hide();
    $('#bank-content').hide();
    $('#personal-content').hide();

    $('input:radio[name="inlineRadioOptions"]').change(
        function(){
            if (this.checked && this.value == 'paypal') {
                $('#paypal-content').show();
                console.log('paypal');
            }
            else
                $('#paypal-content').hide();

            if (this.checked && this.value == 'bank') {
                $('#bank-content').show();
                console.log('bank');
            }
            else
                $('#bank-content').hide();

            if (this.checked && this.value == 'other') {
                $('#personal-content').show();
            }
            else
                $('#personal-content').hide();
        });
});