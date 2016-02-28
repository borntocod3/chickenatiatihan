<?php 
	$date = date_format(date_create("now"),"Y/m/d H:i")
?>
<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Date</label>
                <?php 
                    wp_nonce_field('ca_reservation_data','ca_reservation_nonce');
                ?>
                <div class='input-group date' >
                    <input name='ca_date' type='text' readonly="true" value="<?php echo $date; ?>" class="ca_date form-control" />
                    <span class="input-group-addon btn-date-icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

         <div class='col-sm-3'>
            <div class="form-group">
            	<label>Number of heads</label>
                <input name='ca_num_of_heads' type='text'  value="" class=" form-control" />
            </div>
        </div>
	</div>

	<div class="row">
       
    </div>

    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Email</label>
                <input name='ca_email' type='email'  value="" class="form-control" />
            </div>
        </div>

        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Contact No.</label>
                <input name='ca_contact_no' type='text'  value="" class="form-control" />
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Venue</label>
                <input name='ca_venue' type='text'  value="" class="form-control" />
            </div>
        </div>

		<div class="col-sm-3">
			<div class="form-group">
				<label>Specialty</label><br/>
	       		<select name='ca_specialty[]' class="ca_multi-select form-control"  multiple="multiple">
				    <option value="cheese">Cheese</option>
				    <option value="tomatoes">Tomatoes</option>
				    <option value="mozarella">Mozzarella</option>
				    <option value="mushrooms">Mushrooms</option>
				    <option value="pepperoni">Pepperoni</option>
				    <option value="onions">Onions</option>
				    <option value="cheese">Cheese</option>
				    <option value="tomatoes">Tomatoes</option>
				    <option value="mozarella">Mozzarella</option>
				    <option value="mushrooms">Mushrooms</option>
				    <option value="pepperoni">Pepperoni</option>
				    <option value="onions">Onions</option>
				</select>
			</div>
       </div>

        
    </div>

    <div class="row">
		<div class='col-sm-3'><label>Notes</label>
            <div class="form-group">
            	
                <textarea name='ca_notes' class="form-control"></textarea> 
            </div>
        </div>

        <div class='col-sm-3'>
            <div class="form-group">
            	<label>&nbsp;</label><br/>
            	<input type="submit" class="btn btn-primary form-control" />
            </div>
        </div>
    </div>

</div>