$(document).ready(function(){
	//validation initialise
	let validate = false
	function validation(form){
        let form_validation = $(`#${form} .form-required`).serializeArray()
        let return_value = false
        console.log(form_validation)

        //give class has-error
        for(const e of form_validation){
            if(e['value']==""){
                $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').addClass('has-error')
                return_value = false
            } else {
               $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').removeClass('has-error')
                return_value = true
            }
        }

        //remove class has-error
        for(const e of form_validation){
    		$(`#${e['name']}.form-required`).on('blur', function(){
    			if($(this).val()==""){
    				$(this).parents('.form-group').addClass('has-error')
    			} else {
                    $(this).parents('.form-group').removeClass('has-error')
    			}
    		})
    	}

    	//focus form
    	let focus_input = $('div.has-error').first().find('.form-required').focus()

    	//last form has-error
    	let last_form_error = $('div.has-error').last().find('.form-required')

    	if(last_form_error.val()==""){
    		return_value = false
    	} else {
    		return_value = true
    	}

        return return_value
    }

    //ajax success after validation
    function ajax_add_success(data, form, dt, input){
    	data = data.replace(/["]/g, "")
		if(data == "success"){
			alert(`${input} Created`);
			dt.ajax.reload();
			$('#master_crud').modal('hide');
		}
		if(data == "Data Exist"){
			alert(`${data}!`)
			$(`#${form}`).parents('.form-group').addClass('has-warning')
			$(`#${form}`).focus()
		}
    }
    //Data Table Start
		var dt_master_ctypeprice = $('#table_master_custype_price').DataTable({
			ajax: {
				type: "POST",
				data: {input: 'mas_customer_price_type'},
				url: "Cmaster/getDataMaster",
				dataSrc: ""
			},
			createdRow: function(row, data, dataIndex){
				$(row).attr('id', data.CustType)
			},
			responsive: {
				details:{
					type: 'column'
				}
			},
			columnDefs:[
				{targets:0, className: 'control', orderable: false, defaultContent: ""},
				{targets:1, data: "CustType"},
				{targets:2, data: "CustTypeDesc"},
				{targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-master" input="mas_customer_price_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-master" input="mas_customer_price_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
			],
			order: [1,'asc'],
			autoWidth: false,
			lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"]]
		})
	//Data Table End
	$(document).on('click', 'button.btnModal', function(){
		$('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
		switch($(this).attr('id')){
			case 'button_add_master_custtype_price':
				$('#master_crud').modal('show');
				$('#btnAdd').attr('input','mas_customer_price_type').show();
				$('#btnEdit').hide();
				$.ajax({
					type: "POST",
					data: {input: 'mas_customer_price_type'},
					url: 'Cmaster/viewModalMaster',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
		        		$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Customer Type Price`);
		        		$('#master_crud').on('shown.bs.modal', function(){
		        			$('#custtype').focus()
		        		})
					}
				})
				break;
		}
	})

	$(document).on('click', 'button#btnAdd', function(){
		switch($(this).attr('input')){
			case 'mas_customer_price_type':
				var data_customer_type_price = $('#form_custtypeprice').serialize();
				validate = validation('form_custtypeprice')
				if(validate == true){
					$.ajax({
						type: "POST",
						data: data_customer_type_price+"&input=mas_customer_price_type",
						url: 'Cmaster/inputDataMaster',
						success: function(data){
							data = data.replace(/["]/g, "")
							if(data == "success"){
								alert('Price Type Created');
								dt_master_ctypeprice.ajax.reload();
								$('#master_crud').modal('hide');
							}
							if(data == "Data Exist"){
								alert(`${data}!`)
								$('#custtype').parents('.form-group').addClass('has-warning')
								$('#custtype').focus()
							}
						}, error: function(e){
							alert('Error Occured!')
						}
					})
				} else {
					alert('Error Occured!')
				} 
					
				break;
		}
	})

	$(document).on('click', 'a.edit-master', function(e){
		e.preventDefault();
		var id = $(this).parents('tr').attr('id');
		if(!id){
			id = $(this).data('id')
		}
		$('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
		switch($(this).attr('input')){
			case 'mas_customer_price_type':
				$('#master_crud').modal('show');
				$('#btnAdd').hide();
				$('#btnEdit').attr({'data-id':id, 'input':'mas_customer_price_type'}).show();
				$.ajax({
					type: "POST",
					data: { input: 'mas_customer_price_type' },
					url: 'Cmaster/viewModalMaster',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
						$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Customer Type Price`);
						$.ajax({
							type: "POST",
							data: { 
								input: 'mas_customer_price_type' ,
								CustType: id
							},
							url: 'Cmaster/getDataMasterByID',
							dataType: 'JSON',
							success: function(hasil){
								$('#custtype').val(hasil.CustType);
								$('#custtypedesc').val(hasil.CustTypeDesc);
							},
						})
					}
				})
				break;
		}
	})

	$(document).on('click', 'button#btnEdit', function(){
		var id = $(this).attr('data-id')
		switch ($(this).attr('input')){
			case 'mas_customer_price_type' :
				var data_customer_type_price = $('#form_custtypeprice').serialize();
				$.ajax({
					type: "POST",
					data: data_customer_type_price+"&input=mas_customer_price_type&id="+id,
					url: 'Cmaster/editDataMaster',
					success: function(data){
						dt_master_ctypeprice.ajax.reload();
						$('#master_crud').modal('hide');
						alert('Customer Type Updated');
					}
				})
				break;
		}
	})

	$(document).on('click', 'a.disc-master', function(e){
		e.preventDefault();
		var id = $(this).parents('tr').attr('id');
		var accept = confirm('Are you sure to discontinue this data ?');
		switch($(this).attr('input')){
			case 'mas_customer_price_type':
				if(accept == true){
					var remarks = prompt("Remarks", "");
					  if (remarks != null) {
						    document.getElementById("demo").innerHTML =
								$.ajax({
									type: "POST",
									data: {
										input: 'mas_customer_price_type',
										id: id,
										remarks: remarks
									},
									url: 'Cmaster/discDataMaster',
									success: function(data){
										dt_master_ctypeprice.ajax.reload();
										alert('Customer Type Discontinued');
									}
								})
					  }else{
					  	alert('Thankyou')
					  }
				} else {
					alert('Thankyou')
				}
				break;			
		}
	})

})