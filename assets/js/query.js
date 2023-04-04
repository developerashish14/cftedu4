

    $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			$( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.search').submit(function(e){
				e.preventDefault();
				var frm = $(this);
				var form_btn = $(frm).find('button[type="submit"]');
				var form_result_div = '#form-result';
				$(form_result_div).remove();
				form_btn.after('<div class="row"><div id="form-result" class="alert alert-success col-md-4" role="alert" style="display: none;"></div></div>');
				var form_btn_old_msg = form_btn.html();
				form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
				$.ajax({
					url: frm.attr('action'),
					data: new FormData(this),
					type: 'post',
					dataType: 'json',
					contentType: false,
					processData: false,
					cache: false,
					success: function(result){
						if(result.success == true){
							form_btn.prop('disabled', false).html(form_btn_old_msg);
							
							if(result.check == true){  //number length check 
								if(result.customer == true){ 
									$('#customer_details').show();
									$("#customer_details").html(result.message);
									$("#add_customer").hide(); //hide add button
									AddRemarkAjaxCall();
								}else{
									$('#customer_details').show();
									$("#customer_details").html(result.message);
									$(".show-user").hide();
									$("#add_customer").show();  //show add button
									
									setTimeout(function(){ $("#customer_details").fadeOut('slow') }, 5000);
									
								}
							}else{
								$("#add_customer").hide();
								$('#customer_details').show();
								$("#customer_details").html(result.message);
								setTimeout(function(){ $("#customer_details").fadeOut('slow') }, 5000);
								
							}
						}else{
							form_btn.prop('disabled', false).html(form_btn_old_msg);
							var error = '';
							$.each(result.message, function(key,value){
								var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
								if(value.length > 2){
									if(result.border == true){
										inpt.addClass('border-danger');
										error = error+', '+value;
									}else{
										inpt.addClass('border-danger').before(value);
									}
								}
							});
							
							$(form_result_div).html(error).fadeIn('slow');
							setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
							
						}
						form_btn.html(form_btn.prop('enable', true).data("loading-text"));
					}
				});
			});
			
			
			$('.form-query').submit(function(e){
				e.preventDefault();
				var frm = $(this);
				var form_btn = $(frm).find('button[type="submit"]');
				var form_result_div = '#form-result';
				$(form_result_div).remove();
				form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
				var form_btn_old_msg = form_btn.html();
				form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
				$.ajax({
					url: frm.attr('action'),
					data: new FormData(this),
					type: 'post',
					dataType: 'json',
					contentType: false,
					processData: false,
					cache: false,
					success: function(result){
						if(result.success == true){
							form_btn.prop('disabled', false).html(form_btn_old_msg);
							
							if(result.customer == true){ 
								$("#addQuery").modal('hide');  // add query model hide 
								$('#customer_details').show();
								$("#customer_details").html(result.message);
								$("#add_customer").hide(); //hide add button
								AddRemarkAjaxCall();
							}else{
								$('#customer_details').show();
								$("#customer_details").html(result.message);
								setTimeout(function(){ $("#customer_details").fadeOut('slow') }, 5000);
								$(form_result_div).html(result.message).fadeIn('slow');
								setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
							}
							
						}else{
							form_btn.prop('disabled', false).html(form_btn_old_msg);
							var error = '';
							$.each(result.message, function(key,value){
								var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
								if(value.length > 2){
									if(result.border == true){
										inpt.addClass('border-danger');
										error = error+', '+value;
									}else{
										inpt.addClass('border-danger').before(value);
									}
								}
							});
							$(form_result_div).html(error).fadeIn('slow');
							setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
							
						}
						//form_btn.html(form_btn.prop('enable', true).data("loading-text"));
					}
				});
			});
			$(".courseDetails").change(function(){
					
				var id = $('option:selected', this).val();
				if(id){
					$.ajax({
						type: "POST",
						url: "visitor/get_amount",
						dataType: "json",
						data: {id:id},
						cache: false,
						success: function(result){
							if(result.success==true){
								$("input[name='amount']").val(result.amount);
							}else{
								alert('ErrorNo amount...');
							}
						}
					});
				}else{
					alert('Error....');
				}
			});
			
			$("#add_customer").click(function(){
					 var inputString = $("#visitor_details").val();
					$("input[name='contact']").val(inputString);
					
			});
			
			
			//AddRemarkAjaxCall();
			
		});
		
	/////after page ajax jquery reload ,first load jqeury not consider 
	function AddRemarkAjaxCall()                               
	{
		$('.add-remark').on('click',function(){
			//alert('test');
	
			var query_id = $(this).data('query_id');
			
			var remark = $('textarea[name=remark_'+query_id+']').val();
			if(remark){
				$.ajax({
					type: "POST",
					url: "visitor/add_remark",
					dataType: "json",
					data: {query_id:query_id,remark:remark},
					cache: false,
					success: function(result){
						var str = '<div class="d-flex flex-row justify-content-start">									  <p class="p-5" style="margin-bottom: -5px;"><b>'+result.admin.f_name+'</b>,<span class="align-right">'+result.remark.insert_time+'</span></p><div><p class="p-5" style="border-radius: 15px;background-color: #f5f6f7;">'+result.remark.remark_msg+'</p><hr></div></div>';
						$('#updated_remarks_'+query_id).append(str);
						$('textarea[name=remark_'+query_id+']').val('');
						$('#updated_remarks_'+query_id).animate({ scrollTop:  500 });
						
						
						
					}
				});
			}
			
			
		});
		
		
		
		$('.action-button').on('click',function(){
			var id = $(this).data('id');
			$("input[name=qry_id]").attr('value',id);
		});
		
		
		
		$('.form-submit-amount').submit(function(e){
			//alert('test');
			e.preventDefault();
			var frm = $(this);
			var form_btn = $(frm).find('button[type="submit"]');
			var form_result_div = '#form-result';
			$(form_result_div).remove();
			form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
			var form_btn_old_msg = form_btn.html();
			form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
			$.ajax({
				url: frm.attr('action'),
				data: new FormData(this),
				type: 'post',
				dataType: 'json',
				contentType: false,
				processData: false,
				cache: false,
				success: function(result){
					if(result.success == true){
						$(frm).find('.form-control').val('');
						form_btn.prop('disabled', false).html(form_btn_old_msg);
						
						 $('#upamountModal').modal('hide');
						var str = '<div class="d-flex flex-row justify-content-start">									  <p class="p-5" style="margin-bottom: -5px;"><b>'+result.admin.f_name+'</b>,<span class="align-right">'+result.remark.insert_time+'</span></p><div><p class="p-5" style="border-radius: 15px;background-color: #f5f6f7;">'+result.remark.remark_msg+'</p><hr></div></div>';
						$('#updated_remarks_'+result.remark.query_id).append(str);
						$('textarea[name=remark_'+result.remark.query_id+']').val('');
						$('#updated_remarks_'+result.remark.query_id).animate({ scrollTop:  500 });
						
						
					}else{
						form_btn.prop('disabled', false).html(form_btn_old_msg);
						var error = '';
						$.each(result.message, function(key,value){
							var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
							if(value.length > 2){
								if(result.border == true){
									inpt.addClass('border-danger');
									error = error+', '+value;
								}else{
									inpt.addClass('border-danger').before(value);
								}
							}
						});
						$(form_result_div).html(error).fadeIn('slow');
						setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
						
					}
				   
				}
			});
		});
	}	
			
		
	$('#visitor_details').autocomplete({
		source: function( request, response ) {
			//console.log(request.term);
			$.ajax({
				type: "POST",
				url: "visitor/catch_visitor_info",
				dataType: "json",
				data: {details:request.term},
				cache: false,
				success: function( data ) {
					//response( data );
					//alert(data);
					response( $.map( data, function( item ) {
						return {
							label: item.contact+'|'+item.email,
							value: item.contact+'|'+item.email,
							item_id: item.id,
							item_email: item.email,
							item_contact: item.contact,
						};
					}));
				}
			});
		},
		minLength: 3,
		select: function( event, ui ) 
		{
			var label = ui.item.label;
			var value = ui.item.value;
			var itemid = ui.item.item_id;
			var email = ui.item.item_email;
			var contact = ui.item.item_contact;
			
			$.ajax({
				type: "POST",
				url: "visitor/catch_visitor_on_select",
				data: {visitor:itemid},
				dataType: 'json',
				cache: false,
				success: function(result){
					
						$('.show-user').show();
						$('#visitor-name').html(result.name);
						$('#visitor-contact').html(result.contact);
						$('#visitor-email').html(result.email);
						$('#visitor-address').html(result.address);
						
						
						//-------assign value in ---------
						
						$("input[name='cust_id']").val(result.id);
					
			
				}
			});
		}
	});
	