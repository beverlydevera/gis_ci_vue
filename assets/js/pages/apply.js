let prevent_close = false;
$(document).ready(function(){
	$('.datepicker').datepicker({
	    format:"yyyy-mm-dd",
	    autoclose: true,
	});
})

.on("click", ".next_section", function(e){
	e.preventDefault();
	let next_val = $(this).attr('next-value');
	console.log(next_val)
	$('#pds_tab a:nth-child('+next_val+')').tab('show');
})

.on("submit","#employee_reference_form",function(e){
	e.preventDefault();

	let data_post = $("#employee_personal_form").serialize() + "&" + $("#employee_eligibility_form").serialize() + "&" + $("#employee_voluntary_form").serialize() + "&" + $(this).serialize()
	
	$.ajax({
		url:baseUrl+"/save-employee-form",
		type:"POST",
		dataType:"json",
		data: data_post,
		success:function(response){
			if(response.status){
				prevent_close = false
				bootbox.alert({
					message: response.msg,
					callback: function () {
						setTimeout(function(){
							window.location.href = baseUrl+"/employee";
						},500);
					}
				})
			} else {
				bootbox.alert({
		            message: response.msg,
		            callback: function () {
		            	if($('.modal.in')){
		            		setTimeout(function(){
		            			$('body').addClass('modal-open');
		            		},1000);
		            	}
		            }
	         	})
			}
		}
	});
})
.on("submit","#user_account_form",function(e){
	e.preventDefault();

	let password = $(this).find("input[name='password']").val();
	let c_password = $(this).find("input[name='c_password']").val();

	if(password !== c_password){
		bootbox.alert({
	      message: "Passwords do not match",
	      callback: function () {
	        if($('.modal.in')){
	          setTimeout(function(){
	            $('body').addClass('modal-open');
	          },1000);
	        }
	      }
	    })
	    return false;
	}

	let data_post = $("#employee_personal_form").serialize() + "&" + $("#employee_eligibility_form").serialize() + "&" + $("#employee_voluntary_form").serialize() + "&" + $("#employee_reference_form").serialize() + "&" + $(this).serialize()
	
	$.ajax({
		url:baseUrl+"/save-employee-form",
		type:"POST",
		dataType:"json",
		data: data_post,
		success:function(response){
			if(response.status){
				prevent_close = false
				bootbox.alert({
					message: response.msg,
					callback: function () {
						setTimeout(function(){
							window.location.href = baseUrl+"/employee";
						},500);
					}
				})
			} else {
				bootbox.alert({
		            message: response.msg,
		            callback: function () {
		            	if($('.modal.in')){
		            		setTimeout(function(){
		            			$('body').addClass('modal-open');
		            		},1000);
		            	}
		            }
	         	})
			}
		}
	});
})
.on('input', '.input_empty', function(){
	$(this).removeClass('input_empty');
})
.on('click', '.add_child_item', function(){

	let add_child = '';
	let insert = true;

	add_child += '<tr class="new_row_child">';
	add_child += '<td><input type="text" name="child_name[]" class="form-control form-control-sm"></td>';
	add_child += '<td><input type="text" name="child_birthday[]" class="form-control form-control-sm">';
	add_child += '<span class="text-danger cancel_child_item cancel_item"><i class="fa fa-close"></i></span></td>';
	add_child += '</tr>';

	$('.new_row_child input').each(function(){
		if($(this).val() == ""){
			$(this).addClass('input_empty');
			insert = false;
		} else {
			$(this).removeClass('input_empty');
		}
	})

	if(insert){
		$(add_child).insertBefore($('.add_child_row'));
	}
})
.on('click', '.add_eligibility_item', function(){

	let add_eligibility = '';
	let insert = true;

	add_eligibility += '<tr class="new_row_eligibility">';
	add_eligibility += '<td><input type="text" name="eligibility_name[]" class="form-control form-control-sm"></td>';
	add_eligibility += '<td><input type="text" name="rating[]" class="form-control form-control-sm"></td>';
	add_eligibility += '<td><input type="text" name="exam_date[]" class="form-control form-control-sm"></td>';
	add_eligibility += '<td><input type="text" name="exam_place[]" class="form-control form-control-sm"></td>';
	add_eligibility += '<td><input type="text" name="license_no[]" class="form-control form-control-sm"></td>';
	add_eligibility += '<td><input type="text" name="license_date[]" class="form-control form-control-sm">';
	add_eligibility += '<span class="text-danger cancel_eligibility_item cancel_item"><i class="fa fa-close"></i></span></td>';
	add_eligibility += '</tr>';


	$('.new_row_eligibility input').each(function(){
		if($(this).val() == ""){
			$(this).addClass('input_empty');
			insert = false;
		} else {
			$(this).removeClass('input_empty');
		}
	})

	if(insert){
		$(add_eligibility).insertBefore($('.add_eligibility_row'));
	}
})
.on('click', '.add_work_item', function(){

	let add_work = '';
	let insert = true;

	add_work += '<tr class="new_row_work">';
	add_work += '<td><input type="text" name="work_date_from[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="work_date_to[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="position[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="company[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="salary[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="salary_grade[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="appointment[]" class="form-control form-control-sm"></td>';
	add_work += '<td><input type="text" name="govt_service[]" class="form-control form-control-sm">';
	add_work += '<span class="text-danger cancel_work_item cancel_item"><i class="fa fa-close"></i></span></td>';
	add_work += '</tr>';
            
	$('.new_row_work input').each(function(){
		if($(this).val() == ""){
			$(this).addClass('input_empty');
			insert = false;
		} else {
			$(this).removeClass('input_empty');
		}
	})

	if(insert){
		$(add_work).insertBefore($('.add_work_row'));
	}
})
.on('click', '.add_voluntary_item', function(){

	let add_voluntary = '';
	let insert = true;

	add_voluntary += '<tr class="new_row_voluntary">';
	add_voluntary += '<td><input type="text" name="org_name[]" class="form-control form-control-sm"></td>';
	add_voluntary += '<td><input type="text" name="org_work_date_from[]" class="form-control form-control-sm"></td>';
	add_voluntary += '<td><input type="text" name="org_work_date_to[]" class="form-control form-control-sm"></td>';
	add_voluntary += '<td><input type="text" name="org_hrs[]" class="form-control form-control-sm"></td>';
	add_voluntary += '<td><input type="text" name="org_position[]" class="form-control form-control-sm">';
	add_voluntary += '<span class="text-danger cancel_voluntary_item cancel_item"><i class="fa fa-close"></i></span></td>';
	add_voluntary += '</tr>';
            
	$('.new_row_voluntary input').each(function(){
		if($(this).val() == ""){
			$(this).addClass('input_empty');
			insert = false;
		} else {
			$(this).removeClass('input_empty');
		}
	})

	if(insert){
		$(add_voluntary).insertBefore($('.add_voluntary_row'));
	}
})
.on('click', '.add_learning_item', function(){

	let add_learning = '';
	let insert = true;

	add_learning += '<tr class="new_row_learning">';
	add_learning += '<td><input type="text" name="learning_title[]" class="form-control form-control-sm"></td>';
	add_learning += '<td><input type="text" name="learning_date_from[]" class="form-control form-control-sm"></td>';
	add_learning += '<td><input type="text" name="learning_date_to[]" class="form-control form-control-sm"></td>';
	add_learning += '<td><input type="text" name="learning_hrs[]" class="form-control form-control-sm"></td>';
	add_learning += '<td><input type="text" name="learning_type[]" class="form-control form-control-sm"></td>';
	add_learning += '<td><input type="text" name="learning_sponsored[]" class="form-control form-control-sm">';
	add_learning += '<span class="text-danger cancel_learning_item cancel_item"><i class="fa fa-close"></i></span></td>';
	add_learning += '</tr>';

	$('.new_row_learning input').each(function(){
		if($(this).val() == ""){
			$(this).addClass('input_empty');
			insert = false;
		} else {
			$(this).removeClass('input_empty');
		}
	})

	if(insert){
		$(add_learning).insertBefore($('.add_learning_row'));
	}
})

.on('click', '.cancel_item', function(){
	$(this).closest('tr').remove()
})
window.onbeforeunload = function () {
	if(prevent_close){
    	return "Are you sure you want to leave this page?";
	}
};