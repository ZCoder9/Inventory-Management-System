
<?php
//inward.php

include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
    header('location:login.php');
}

if($_SESSION['type'] != 'master')
{
    header('location:index.php');
}

include('header.php');



?>

<link rel="stylesheet" href="css/datepicker.css">
	<script src="js/bootstrap-datepicker1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

	<script>
	$(document).ready(function(){
		$('#inward_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});
	});
	</script>

        <span id='alert_action'></span>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h3 class="panel-title">Inward List</h3>
                            </div>
                        
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='right'>
                                <button type="button" name="add" id="add_button" class="btn btn-success btn-xs">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row"><div class="col-sm-12 table-responsive">
                            <table id="inward_data" class="table table-bordered table-striped">
                                <thead><tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Vendor</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Price Per Item</th>
                                    <th>Total Price</th>
                                    <th>Tax</th>
                                    <th>Total Tax</th>
                                    <th>Total Item Amount</th>
                                    <th>Total Transcost</th>
                                    <th>Total Cost</th>
                                </tr></thead>
                            </table>
                        </div></div>
                    </div>
                </div>
			</div>
		</div>

        <div id="inwardModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="inward_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Inward</h4>
                        </div>
                        <div class="modal-body">
                           
								<div class="form-group">
									<label>Date</label>
									<input type="text" name="inward_date" id="inward_date" class="form-control" required />
								</div>
                            <div class="form-group">
                                <label>Select Product</label>
                                <select name="inward_product_id" id="inward_product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    <?php echo fill_product_list($connect);?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Can't find product?&nbsp;&nbsp;</label>
                                <a href="product.php">
                                    <input type="button" value="Add New Product here!" />
                                </a>
						    </div>
                            <div class="form-group">
                                <label>Select Vendor</label>
                                <select name="inward_vendor_id" id="inward_vendor_id" class="form-control" required>
                                    <option value="">Select Vendor</option>
                                    <?php echo fill_vendor_list($connect);?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Can't find vendor?&nbsp;&nbsp;</label>
                                <a href="vendor.php">
                                    <input type="button" value="Add New Vendor here!" />
                                </a>
						    </div>
                            <div class="form-group">
                                <label>Enter Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                            <div class="form-group">
                                <label>Enter Price Per Item</label>
                                <input type="text" name="price_per_item" id="price_per_item" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                            <!-- <div class="form-group">
                                <label>Enter Total Price</label>
                                <input type="text" name="total_price" id="total_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div> -->
                            <!-- <div class="form-group">
                                <label>Enter Total Price</label>
                                <input type="text" name="total_price" id="total_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" disabled />
                                <script>
                                    function calculateTotalPrice(quantity,price_per_item) {
                                        var tot_price = quantity * price_per_item;
                                        /*display the result*/
                                        var divobj = document.getElementById('total_price');
                                        divobj.value = tot_price;
                                        
                                    }
                                </script>
                            </div> -->
                            <div class="form-group">
                                <label>Enter Tax (%)</label>
                                <input type="text" name="tax" id="tax" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                            <!-- <div class="form-group">
                                <label>Enter Total Tax</label>
                                <input type="text" name="total_tax" id="total_tax" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" disabled/>
                            </div> -->
                            <!-- <div class="form-group">
                                <label>Enter Total Item Amount</label>
                                <input type="text" name="total_item_amount" id="total_item_amount" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" disabled />
                            </div> -->
                            <div class="form-group">
                                <label>Enter Per Item Transportation Cost</label>
                                <input type="text" name="peritem_transcost" id="peritem_transcost" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                            <!-- <div class="form-group">
                                <label>Enter Total Transportation Cost</label>
                                <input type="text" name="total_transcost" id="total_transcost" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" disabled/>
                            </div> -->
                            <!-- <div class="form-group">
                                <label>Enter Total Bill Amount</label>
                                <input type="text" name="total_bill_amount" id="total_bill_amount" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" disabled/>
                            </div> -->
                            <div class="form-group">
                                <label>Select Stock Type</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <select name="stock_type" id="stock_type" required>
                                            <option value="bill">Billing</option>
                                            <option value="nonbill">Non Billing</option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="inward_inward_id" id="inward_inward_id" />
                            <input type="hidden" name="btn_action" id="btn_action" />
                            <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="inwarddetailsModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="inward_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Inward Details</h4>
                        </div>
                        <div class="modal-body">
                            <Div id="inward_details"></Div>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



<script>
$(document).ready(function(){

    var inwarddataTable = $('#inward_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"inward_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[0],
                "orderable":false,
            },
        ],
        "pageLength": 10
    });

    $('#add_button').click(function(){
        $('#inwardModal').modal('show');
        $('#inward_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Inward");
        $('#action').val("Add");
        $('#btn_action').val("Add");
    });

    $('#category_id').change(function(){
        var category_id = $('#category_id').val();
        var btn_action = 'load_brand';
        $.ajax({
            url:"inward_action.php",
            method:"POST",
            data:{category_id:category_id, btn_action:btn_action},
            success:function(data)
            {
                $('#brand_id').html(data);
            }
        });
    });

    $(document).on('submit', '#inward_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"inward_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#inward_form')[0].reset();
                $('#inwardModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>').fadeOut(2000);
                $('#action').attr('disabled', false);
                inwarddataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.view', function(){
        var inward_id = $(this).attr("id");
        var btn_action = 'inward_details';
        $.ajax({
            url:"inward_action.php",
            method:"POST",
            data:{inward_id:inward_id, btn_action:btn_action},
            success:function(data){
                $('#inwarddetailsModal').modal('show');
                $('#inward_details').html(data);
            }
        })
    });

    $(document).on('click', '.update', function(){
        var inward_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"inward_action.php",
            method:"POST",
            data:{inward_id:inward_id, btn_action:btn_action},
            dataType:"json",
            success:function(data){
                $('#inwardModal').modal('show');
                $('#category_id').val(data.category_id);
                $('#brand_id').html(data.brand_select_box);
                $('#brand_id').val(data.brand_id);
                $('#inward_name').val(data.inward_name);
                $('#inward_description').val(data.inward_description);
                $('#inward_quantity').val(data.inward_quantity);
                $('#inward_unit').val(data.inward_unit);
                $('#inward_base_price').val(data.inward_base_price);
                $('#inward_tax').val(data.inward_tax);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Product");
                $('#inward_id').val(inward_id);
                $('#action').val("Edit");
                $('#btn_action').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var inward_id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"inward_action.php",
                method:"POST",
                data:{inward_id:inward_id, status:status, btn_action:btn_action},
                success:function(data){
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>').fadeOut(2000);
                    inwarddataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;
        }
    });

});
</script>
