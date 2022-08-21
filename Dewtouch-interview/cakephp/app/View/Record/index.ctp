
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<?php $this->start('script_own')?>
<script>
$(document).ready(function(){

	$("#table_records").dataTable({
		"bPaginate"     : true,
		"bServerSide"   : false,
		"sAjaxSource"   : "<?php echo Router::url('/Record/index')?>",
		"sAjaxDataProp" : "aData",
	});

})
</script>
<?php $this->end()?>