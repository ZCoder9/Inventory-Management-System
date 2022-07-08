<?php
//vendor.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

if($_SESSION['type'] != 'master')
{
	header("location:index.php");
}

include('header.php');

?>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <div class="row">
                            <h3 class="panel-title">Vendor List</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <div class="row" align="right">
                             <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#vendorModal" class="btn btn-success btn-xs">Add</button>   		
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="vendor_data" class="table table-bordered table-striped">
                    			<thead><tr>
									<th>ID</th>
									<th>Vendor Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
									<th>Status</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr></thead>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="vendorModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="vendor_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Vendor</h4>
    				</div>
    				<div class="modal-body">
    					<label>Enter Vendor Name</label>
						<input type="text" name="vendor_name" id="vendor_name" class="form-control" required />
    				
                    <div class="form-group">
                            <label>Enter Vendor Contact Number</label>
                            <input type="tel" name="vendor_contact" id="vendor_contact" class="form-control" required pattern="[0-9]{10}" />
                    </div>
                    <div class="form-group">
                        <label>Enter Vendor Address</label>
                        <textarea name="vendor_address" id="vendor_address" class="form-control" rows="5" required></textarea>
                    </div>
					</div>
    				<div class="modal-footer">
    					<input type="hidden" name="vendor_id" id="vendor_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#vendor_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Vendor");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});

	$(document).on('submit','#vendor_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"vendor_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#vendor_form')[0].reset();
				$('#vendorModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success ">'+data+'</div>').fadeOut(2000);
				$('#action').attr('disabled', false);
				vendordataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var vendor_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"vendor_action.php",
			method:"POST",
			data:{vendor_id:vendor_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#vendorModal').modal('show');
				$('#vendor_name').val(data.vendor_name);
				$('#vendor_contact').val(data.vendor_contact);
				$('#vendor_address').val(data.vendor_address);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Vendor");
				$('#vendor_id').val(vendor_id);
				$('#action').val('Edit');
				$('#btn_action').val("Edit");
			}
		})
	});

	var vendordataTable = $('#vendor_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"vendor_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,4,6],
				"orderable":false,
			},
		],
		"pageLength": 25
	});
	$(document).on('click', '.delete', function(){
		var vendor_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"vendor_action.php",
				method:"POST",
				data:{vendor_id:vendor_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>').fadeOut(2000);
					vendordataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});
});
</script>

<?php
include('footer.php');
?>


				