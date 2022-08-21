<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>UOM</th>
<th>Unit Price</th>
<th>Amount</th>
</thead>

<tbody>
	<tr class="tr_1">
		<td><span class="btn mini deletebutton" onclick="func_deletebutton(this)"><i class="icon-trash"></i></td>
		<td><label></label><textarea name="data[1][description]" class="m-wrap description required hidden width100" rows="2" hide></textarea></td>
		<td><label></label><input name="data[1][quantity]" class="hidden width100"></td>
		<td><label></label><input name="data[1][uom]" class="hidden width100"></td>
		<td><label></label><input name="data[1][unit_price]"  class="hidden width100"></td>
		<td><label></label><input name="data[1][amount]" class="hidden width100"></td>
	</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="<?php echo Router::url("/video/q3_2.mov") ?>">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>

tr_cnt = $('tr').size()
prev_editing = false


func_updateLabelValue = function($this){
	if(!prev_editing){
		return
	}

	if($this.find('textarea')[0] != undefined){
		val = $this.find('textarea').val()
		$this.find('label').html(val)
	}
	else if($this.find('input')[0] != undefined){
		val = $this.find('input').val()
		$this.find('label').html(val)
	}
}


func_deletebutton = function(element){
	$el = $(element)
	$el.closest('tr').remove()
}

$(document).ready(function(){


	document.addEventListener("click", function(element){
		func_updateLabelValue(prev_editing)
	});

	$("#add_item_button").click(function(){
		var layout = ''
			+ '<tr class="tr_'+tr_cnt+'">'
			+ '		<td><span class="btn mini deletebutton" onclick="func_deletebutton(this)"><i class="icon-trash"></i></td>'
			+ '		<td>'
			+ '			<label></label>'
			+ '			<textarea name="data['+tr_cnt+'][description]" class="m-wrap description required hidden width100" rows="2" hide></textarea></td>'
			+ '		<td>'
			+ '			<label></label>'
			+ '			<input name="data['+tr_cnt+'][quantity]" class="hidden width100"></td>'
			+ '		<td>'
			+ '			<label></label>'
			+ '			<input name="data['+tr_cnt+'][uom]" class="hidden width100"></td>'
			+ '		<td>'
			+ '			<label></label>'
			+ '			<input name="data['+tr_cnt+'][unit_price]" class="hidden width100"></td>'
			+ '		<td>'
			+ '			<label></label>'
			+ '			<input name="data['+tr_cnt+'][amount]" class="hidden width100"></td>'
			+ '</tr>';

		tr_cnt += 1
		$('tbody').append(layout)
	});

	
	$('body').on('click', 'td', function(){
		if (prev_editing){
			func_updateLabelValue(prev_editing)
			$this.find('label').removeClass('hidden')
			$this.find('textarea').addClass('hidden')
			$this.find('input').addClass('hidden')
		}

		$this = $(this)
		$this.find('label').addClass('hidden')
		$this.find('textarea').removeClass('hidden')
		$this.find('input').removeClass('hidden')

		setTimeout(function(){
			prev_editing = $this
		}, 100)

	})

	
});


</script>
<?php $this->end();?>
<style>
.width100{
	width:90%;
}
th.controls.control-group.success .help-inline, td.controls.control-group.success .help-inline{
	display:none !important;
}
</style>
