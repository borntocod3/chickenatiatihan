<?php 
	$date = date_format(date_create("now"),"Y/m/d H:i")
?>
<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Date</label>
                <div class='input-group date' >
                    <input type='text' readonly="true" value="<?php echo $date; ?>" class="ca_date form-control" />
                    <span class="input-group-addon btn-date-icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

         <div class='col-sm-3'>
            <div class="form-group">
            	<label>Number of heads</label>
                <input type='text'  value="" class=" form-control" />
            </div>
        </div>
	</div>

	<div class="row">
       
    </div>

    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Email</label>
                <input type='email'  value="" class="form-control" />
            </div>
        </div>

        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Contact No.</label>
                <input type='text'  value="" class="form-control" />
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
            	<label>Venue</label>
                <input type='text'  value="" class="form-control" />
            </div>
        </div>

		<div class="col-sm-3">
			<div class="form-group">
				<label>Specialty</label><br/>
	       		<select class="ca_multi-select form-control"  multiple="multiple">
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
            	
                <textarea class="form-control"></textarea> 
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