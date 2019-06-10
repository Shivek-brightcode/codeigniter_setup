<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    	<div class="row">
        	<div class="col-md-12">
            	<div class="box">
                	<div class="box-header with-border">
                    	<div class="box-title"><?php echo $title; ?></div>
                        <div class="pull-right"><a href="<?php echo base_url("master/users/"); ?>" class="btn btn-sm btn-primary">Add User</a></div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Select Table</label>
                                    <?php 
                                        echo form_dropdown('table', $tables,'',array('id'=>'table', 'class'=>'form-control'));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4"><br>
                                <button type="button" class="btn btn-bg-info btn-sm" onClick="$('#table').trigger('change');">Refresh</button>
                            </div>
                        </div><br>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="datatable">
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>  
<input type="hidden" name="table" id="uptable">
<input type="hidden" name="id" id="id">
<input type="hidden" id="temp_val">
<input type="submit" value="save" class="hidden">
        <script>
        	
			$(document).ready(function(e) {
                createTable();
				$('#table').change(function(){
					var table=$(this).val();
					$.ajax({
						type:"POST",
						url:"<?php echo site_url("welcome/gettable/"); ?>",
						data:{table:table},
						success: function(data){
							$('#datatable').html(data);
							createTable();
						}
					});
				});
				$('body').on('dblclick','.editable',function(e){
					if(e.target.id=="column"){ return false; }
					//var prevVal=$('#column').val();
					//$('#column').closest('td').text(prevVal);
					var id=$(this).parent().children(":eq(0)").html();
					var column=$(this).attr('data-column');
					var value=$(this).text();
					var table=$('#table').val();
					$('#uptable').val(table);
					$('#id').val(id);
					$(this).html('<input type="text" id="column" value="">');
					$('#column').attr("name",column);
					$('#column').val(value).focus();
					$('#temp_val').val(value);
				});
				$('body').on('keyup',function(e){
					if(e.which==13){
						if($('#column').length==1){
							var table=$('#uptable').val();
							var id=$('#id').val();
							var column=$('#column').attr("name");
							var value=$('#column').val();
							var data = {};
							data['table']=table;
							data['id']=id;
							data[column] = value;
							$.ajax({
								type:"POST",
								url:"<?php echo base_url('welcome/updatedata'); ?>",
								data:data,
								success: function(data){
									$('#table').trigger('change');
								}
							});
						}
					}
				});
				$('body').on('click',function(e){
					if(e.target.classList!='editable' && e.target.nodeName!='INPUT'){	
						var value=$('#temp_val').val();
						$('#column').closest('td').text(value);
					}
				});
            });
			
			function createTable(){
				$('.data-table').DataTable({
					scrollCollapse: true,
					autoWidth: false,
					responsive: true,
					columnDefs: [{
						targets: "datatable-nosort",
						orderable: false,
					}],
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"language": {
						"info": "_START_-_END_ of _TOTAL_ entries",
						searchPlaceholder: "Search"
					},
				});
			}
        </script>