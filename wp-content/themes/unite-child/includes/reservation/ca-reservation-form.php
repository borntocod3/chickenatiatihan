<?php 
	$date = date_format(date_create("now"),"Y/m/d H:i")
?>
<div id="reservation-form">
        <div class='col-md-12'>
            <h4><span class="required">*</span>&nbsp;Required fields</h4>
        </div>
        <div class='col-md-12'>
            <div class="form-group required">
                <label class="control-label">Event Name</label>
                <input name='ca_event_name' type='text'  value="" class="form-control" required="true"/>
            </div>
        </div>

        <div class='col-md-6'>
            <div class="form-group required">
                <label class="control-label">Your Name</label>
                <input name='ca_name' type='text'  value="" class="form-control" required="true"/>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group required">
                <label class="control-label">Date</label>
                <?php
                wp_nonce_field('ca_reservation_data','ca_reservation_nonce');
                ?>
                <div class='input-group date' >
                    <input name='ca_date' type='text' readonly="true" value="<?php echo $date; ?>" class="ca_date form-control" required="true" />
                    <span class="input-group-addon btn-date-icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group required">
                <label class="control-label">Number of heads</label>
                <input name='ca_num_of_heads' id="ca_num_of_heads" type='text'  value="" class=" form-control" required="true" />
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group required">
            	<label class="control-label">Email&nbsp;</label><i>(ex. juandelacruz@gmail.com)</i>
                <input name='ca_email' type='email'  value="" class="form-control" required="true" />
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group required">
            	<label class="control-label">Contact No.</label>
                <input name='ca_contact_no' type='text'  value="" class="form-control" required="true"/>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="form-group required">
            	<label class="control-label">Venue&nbsp;</label><i>(Leave blank if your venue is in Chicken atiatihan)</i>
                <input name='ca_venue' type='text'  value="" class="form-control" />
            </div>
        </div>
        <?php

                    $args = array(
                        'type'                     => 'ca_product',
                        'taxonomy'                 => 'products_category',//the specialty category
                        'hide_empty'               => true

                    );
                    /**
                     * Get the category specialty
                     */
                    $categories = get_categories( $args );

                    /**
                     * Check if category is not empty 
                     * if its not empty then we will show it the the end user
                     * else we should not let end user see it.
                     */
                    if(!empty($categories)){

                        ?>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label class="control-label">Food Tray</label><br/>
                                <select name='ca_specialty[]' class="ca_multi-select form-control"  multiple="multiple" required="true">
                                <?php
                                    foreach ($categories as $category) {

                                        $args = array(
                                            'post_type' => 'ca_product',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy'  => 'products_category',
                                                    'field'     => 'id',
                                                    'terms'     => $category->term_id
                                                )
                                            )
                                        );

                                        $products = new WP_Query( $args );
                                        $products = $products->posts;
            
                                        ?>
                                        <optgroup label="<?php echo $category->name;?>">
                                        <?php 
                                            foreach ($products as $product) {
                                                //get the previously save meta data
                                                $product_price  = get_post_meta($product->ID,'ca_product_price', true);
                                                ?>

                                                <option value="<?php echo $product->ID; ?>">
                                                    <?php echo $product->post_title.' Php '.$product_price; ?>
                                                </option>

                                            <?php }

                                        ?>
                                        </optgroup><?php

                                    }
                                ?>
                                </select>
                            </div>
                       </div>
                        <?php
                    }

        ?>
		<div class='col-md-6'><label class="control-label">Notes</label>
            <div class="form-group">

                <textarea name='ca_notes' class="form-control"></textarea> 
            </div>
        </div>
        <div class="col-md-12">
            <label class="control-label">&nbsp;Total <span id="lbl-total"></span></label><br/>
        </div>
        <div id="payment-option" class='col-md-12'>
            <hr class="section-divider">
            <h4>Payment Options</h4>
            <label class="control-label">Payment method</label>
            <div class="form-group">
                <div class="radio-section">
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="paypal">Paypal
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="bank">Bank
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="other">Pay in-person<i>(Personally pay in Chicken atiatihan)</i>
                        </label>
                    </div>
                </div>
                <div id="paypal-content" class="payment-content">
                    <h4>&emsp;For PayPal online payment through paypal click to proceed.</h4>
                    <a class="btn btn-danger" href="<?php echo get_permalink(get_page_by_path('pay-with-paypal'));?>" target="_blank"><i class="fa fa-paypal"></i>Proceed with PayPal</a>
                </div>
                <div id="bank-content" class="payment-content">
                    <h4>&emsp;For Bank Payment, you can pay the total amount due to this trasaction to the ff:</h4><i>&emsp;(Kindly include printed document of this transaction upon payment.)</i>
                    <br><br>
                    <label>Account name:&nbsp;</label>Chicken Atiatihan<br>
                    <label>Account number:&nbsp;</label>Peso: 00-453-0018647 Dollar: 10-453-0039482<br>
                    <label>Bank:&nbsp;</label>Banco De Oro
                </div>
                <div id="personal-content" class="payment-content">
                    <h4>&emsp;Proceed to submit</h4>
                </div>
            </div>

        </div>

        <div class='col-md-2'>
            <div class="form-group">
            	<input type="submit" class="btn btn-primary form-control" />
            </div>
        </div>
</div>