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
		var dt_stockgroup_class = $('#table_master_stockgroup_class').DataTable({
			ajax: {
				type: "POST",
				data: {input: 'mas_stock_a_class'},
				url: "Cmaster/getDataMasterStockGroup",
				dataSrc: ""
			},
			createdRow: function(row, data, dataIndex){
				$(row).attr('id', data.StockClassCode)
			},
			responsive: {
				details:{
					type: 'column'
				}
			},
			columnDefs:[
				{targets:0, className: 'control', orderable: false, defaultContent: ""},
				{targets:1, data: "StockClassCode"},
				{targets:2, data: "StockClassDescription"},
				{targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
			],
			order: [1,'asc'],
			autoWidth: false,
			lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"]]
		})

		var dt_stockgroup_cat = $('#table_master_stockgroup_cat').DataTable({
			ajax: {
				type: "POST",
				data: {input: 'mas_stock_b_cat'},
				url: "Cmaster/getDataMasterStockGroup",
				dataSrc: ""
			},
			createdRow: function(row, data, dataIndex){
				$(row).attr('id', data.CatCode)
			},
			responsive: {
				details:{
					type: 'column'
				}
			},
			columnDefs:[
				{targets:0, className: 'control', orderable: false, defaultContent: ""},
				{targets:1, data: "CatCode"},
				{targets:2, data: "CatDescription"},
				{targets:3, data: "StockClassDescription"},
				{targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
			],
			order: [1,'asc'],
			autoWidth: false,
			lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"]]
		})

		var dt_stockgroup_type = $('#table_master_stockgroup_type').DataTable({
			ajax: {
				type: "POST",
				data: {input: 'mas_stock_c_type'},
				url: "Cmaster/getDataMasterStockGroup",
				dataSrc: ""
			},
			createdRow: function(row, data, dataIndex){
				$(row).attr('id', data.TypeCode)
			},
			responsive: {
				details:{
					type: 'column'
				}
			},
			columnDefs:[
				{targets:0, className: 'control', orderable: false, defaultContent: ""},
				{targets:1, data: "TypeCode"},
				{targets:2, data: "TypeDescription"},
				{targets:3, data: "CatDescription"},
				{targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
			],
			order: [1,'asc'],
			autoWidth: false,
			lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"]]
		})

		var dt_stockgroup_grp = $('#table_master_stockgroup_grp').DataTable({
			ajax: {
				type: "POST",
				data: {input: 'mas_stock_d_grp'},
				url: "Cmaster/getDataMasterStockGroup",
				dataSrc: ""
			},
			createdRow: function(row, data, dataIndex){
				$(row).attr('id', data.GroupCode)
			},
			responsive: {
				details:{
					type: 'column'
				}
			},
			columnDefs:[
				{targets:0, className: 'control', orderable: false, defaultContent: ""},
				{targets:1, data: "GroupCode"},
				{targets:2, data: "GroupDescription"},
				{targets:3, data: "TypeDescription"},
				{targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
			],
			order: [1,'asc'],
			autoWidth: false,
			lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"]]
		})
	//Data Table End
	$(document).on('click', 'button.btnModal', function(){
		$('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
		switch($(this).attr('id')){
			case 'button_master_file_add_stockgroup_class':
				$('#master_crud').modal('show');
				$('#btnAdd').attr('input','mas_stock_a_class').show();
				$('#btnEdit').hide();
				$.ajax({
					type: "POST",
					data: {input: 'mas_stock_a_class'},
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
		        		$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Class`);
		        		$('#master_crud').on('shown.bs.modal', function(){
		        			$('#stockclasscode').focus()
		        		})
					}
				})
				break;
			case 'button_master_file_add_stockgroup_cat':
				$('#master_crud').modal('show');
				$('#btnAdd').attr('input','mas_stock_b_cat').show();
				$('#btnEdit').hide();
				$.ajax({
					type: "POST",
					data: {input: 'mas_stock_b_cat'},
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
		        		$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Category`);
		        		$.ajax({
		        			type: "POST",
		        			data: {input: 'mas_stock_a_class'},
		        			url: 'Cmaster/getDataMasterStockGroup',
		        			dataType: 'JSON',
		        			success: function(hasil){
		        				var html='<option></option>';
		        				for(var i=0;i<hasil.length;i++){
		        					html += `<option value="${hasil[i].StockClassCode}">${hasil[i].StockClassCode} - ${hasil[i].StockClassDescription}</option>`
		        				}
		        				$('#stockclasscode').html(html);
		        				$('#stockclasscode').select2({
		        					placeholder: "Choose Class",
		        					dropdownParent: $('#master_crud'),
		        					width: 'auto'
		        				});
		        			}
		        		})
					}
				})
				break;
			case 'button_master_file_add_stockgroup_type':
				$('#master_crud').modal('show');
				$('#btnAdd').attr('input','mas_stock_c_type').show();
				$('#btnEdit').hide();
				$.ajax({
					type: "POST",
					data: {input: 'mas_stock_c_type'},
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
		        		$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Type`);
		        		$.ajax({
		        			type: "POST",
		        			data: {input: 'mas_stock_b_cat'},
		        			url: 'Cmaster/getDataMasterStockGroup',
		        			dataType: 'JSON',
		        			success: function(hasil){
		        				var html='<option></option>';
		        				for(var i=0;i<hasil.length;i++){
		        					html += `<option value="${hasil[i].CatCode}">${hasil[i].CatCode} - ${hasil[i].CatDescription}</option>`
		        				}
		        				$('#stockcatcode').html(html);
		        				$('#stockcatcode').select2({
		        					dropdownParent: $('#master_crud'),
		        					width: 'auto'
		        				});
		        			}
		        		})
					}
				})
				break;
			case 'button_master_file_add_stockgroup_grp':
				$('#master_crud').modal('show');
				$('#btnAdd').attr('input','mas_stock_d_grp').show();
				$('#btnEdit').hide();
				$.ajax({
					type: "POST",
					data: {input: 'mas_stock_d_grp'},
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
		        		$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Group`);
		        		$.ajax({
		        			type: "POST",
		        			data: {input: 'mas_stock_c_type'},
		        			url: 'Cmaster/getDataMasterStockGroup',
		        			dataType: 'JSON',
		        			success: function(hasil){
		        				var html='<option></option>';
		        				for(var i=0;i<hasil.length;i++){
		        					html += `<option value="${hasil[i].TypeCode}">${hasil[i].TypeCode} - ${hasil[i].TypeDescription}</option>`
		        				}
		        				$('#stocktypecode').html(html);
		        				$('#stocktypecode').select2({
		        					dropdownParent: $('#master_crud'),
		        					width: 'auto'
		        				});
		        			}
		        		})
					}
				})
				break;
		}
	})

	$(document).on('click', 'button#btnAdd', function(){
		switch($(this).attr('input')){
			case 'mas_stock_a_class':
				var data_stockclass = $('#form_stockclass').serialize();
				validate = validation('form_stockclass')
				if(validate == true){
					$.ajax({
						type: "POST",
						data: data_stockclass+"&input=mas_stock_a_class",
						url: 'Cmaster/inputDataMasterStockGroup',
						success: function(data){
							data = data.replace(/["]/g, "")
							if(data == "success"){
								alert('Class Created');
								dt_stockgroup_class.ajax.reload();
								$('#master_crud').modal('hide');
							}
							if(data == "Data Exist"){
								alert(`${data}!`)
								$('#stockclasscode').parents('.form-group').addClass('has-warning')
								$('#stockclasscode').focus()
							}
						}, error: function(e){
							alert('Error Occured!')
						}
					})
				} else {
					alert('Error Occured!')
				} 
					
				break;
			case 'mas_stock_b_cat':
				var data_stockcategory = $('#form_stockcategory').serialize();
				validate = validation('form_stockcategory')
				if(validate == true){
					$.ajax({
						type: "POST",
						data: data_stockcategory+"&input=mas_stock_b_cat",
						url: 'Cmaster/inputDataMasterStockGroup',
						success: function(data){
							data = data.replace(/["]/g, "")
							if(data == "success"){
								alert('Category Created');
								dt_stockgroup_cat.ajax.reload();
								$('#master_crud').modal('hide');
							}
							if(data == "Data Exist"){
								alert(`${data}!`)
								$('#stockcatcode').parents('.form-group').addClass('has-warning')
								$('#stockcatcode').focus()
							}
						}, error: function(e){
							alert('Error Occured!')
						}
					})
				} else {
					alert('Error Occured!')
				}
				break;
			case 'mas_stock_c_type':
				var data_stocktype = $('#form_stocktype').serialize();
				validate = validation('form_stocktype')
				if(validate == true){
					$.ajax({
						type: "POST",
						data: data_stocktype+"&input=mas_stock_c_type",
						url: 'Cmaster/inputDataMasterStockGroup',
						success: function(data){
							data = data.replace(/["]/g, "")
							if(data == "success"){
								alert('Sub Category Created');
								dt_stockgroup_type.ajax.reload();
								$('#master_crud').modal('hide');
							}
							if(data == "Data Exist"){
								alert(`${data}!`)
								$('#stocktypecode').parents('.form-group').addClass('has-warning')
								$('#stocktypecode').focus()
							}
						}, error: function(e){
							alert('Error Occured!')
						}
					})
				} else {
					alert('Error Occured!')
				}
				break;
			case 'mas_stock_d_grp':
				var data_stockgrp = $('#form_stockgrp').serialize();
				validate = validation('form_stockgrp')
				if(validate == true){
					$.ajax({
						type: "POST",
						data: data_stockgrp+"&input=mas_stock_d_grp",
						url: 'Cmaster/inputDataMasterStockGroup',
						success: function(data){
							data = data.replace(/["]/g, "")
							if(data == "success"){
								alert('Group Created');
								dt_stockgroup_grp.ajax.reload();
								$('#master_crud').modal('hide');
							}
							if(data == "Data Exist"){
								alert(`${data}!`)
								$('#stockgrpcode').parents('.form-group').addClass('has-warning')
								$('#stockgrpcode').focus()
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

	$(document).on('click', 'a.edit-stockgroup', function(e){
		e.preventDefault();
		var id = $(this).parents('tr').attr('id');
		if(!id){
			id = $(this).data('id')
		}
		$('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
		switch($(this).attr('input')){
			case 'mas_stock_a_class':
				$('#master_crud').modal('show');
				$('#btnAdd').hide();
				$('#btnEdit').attr({'data-id':id, 'input':'mas_stock_a_class'}).show();
				$.ajax({
					type: "POST",
					data: { input: 'mas_stock_a_class' },
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
						$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Class`);
						$.ajax({
							type: "POST",
							data: { 
								input: 'mas_stock_a_class' ,
								StockClassCode: id
							},
							url: 'Cmaster/getDataMasterStockGroupByID',
							dataType: 'JSON',
							success: function(hasil){
								$('#stockclasscode').val(hasil.StockClassCode);
								$('#stockclassdescription').val(hasil.StockClassDescription);
							},
						})
					}
				})
				break;
			case 'mas_stock_b_cat':
				$('#master_crud').modal('show');
				$('#btnAdd').hide();
				$('#btnEdit').attr({'data-id':id, 'input':'mas_stock_b_cat'}).show();
				$.ajax({
					type: "POST",
					data: { input: 'mas_stock_b_cat' },
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
						$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Category`);
						$.ajax({
							type: "POST",
							data: { 
								input: 'mas_stock_b_cat' ,
								CatCode: id
							},
							url: 'Cmaster/getDataMasterStockGroupByID',
							dataType: 'JSON',
							success: function(hasil){
								$.ajax({
				        			type: "POST",
				        			data: {input: 'mas_stock_a_class'},
				        			url: 'Cmaster/getDataMasterStockGroup',
				        			dataType: 'JSON',
				        			success: function(value){
				        				var html='<option></option>';
				        				for(var i=0;i<value.length;i++){
				        					html += `<option value="${value[i].StockClassCode}">${value[i].StockClassCode} - ${value[i].StockClassDescription}</option>`
				        				}
				        				$('#stockclasscode').html(html);
				        				$('#stockclasscode').select2({
				        					dropdownParent: $('#master_crud'),
				        					width: 'auto'
				        				});
										$('#stockclasscode').val(hasil.StockClassCode).trigger('change');

				        			}
				        		})

								$('#stockcatcode').val(hasil.CatCode);
								$('#stockcatdescription').val(hasil.CatDescription);
							},
						})
					}
				})
				break;
			case 'mas_stock_c_type':
				$('#master_crud').modal('show');
				$('#btnAdd').hide();
				$('#btnEdit').attr({'data-id':id, 'input':'mas_stock_c_type'}).show();
				$.ajax({
					type: "POST",
					data: { input: 'mas_stock_c_type' },
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
						$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Sub Category`);
						$.ajax({
							type: "POST",
							data: { 
								input: 'mas_stock_c_type' ,
								TypeCode: id
							},
							url: 'Cmaster/getDataMasterStockGroupByID',
							dataType: 'JSON',
							success: function(hasil){
								$.ajax({
				        			type: "POST",
				        			data: {input: 'mas_stock_b_cat'},
				        			url: 'Cmaster/getDataMasterStockGroup',
				        			dataType: 'JSON',
				        			success: function(value){
				        				var html='<option></option>';
				        				for(var i=0;i<value.length;i++){
				        					html += `<option value="${value[i].CatCode}">${value[i].CatCode} - ${value[i].CatDescription}</option>`
				        				}
				        				$('#stockcatcode').html(html);
				        				$('#stockcatcode').select2({
				        					dropdownParent: $('#master_crud'),
				        					width: 'auto'
				        				});
										$('#stockcatcode').val(hasil.CatCode).trigger('change');

				        			}
				        		})

								$('#stocktypecode').val(hasil.TypeCode);
								$('#stocktypedescription').val(hasil.TypeDescription);
							},
						})
					}
				})
				break;
			case 'mas_stock_d_grp':
				$('#master_crud').modal('show');
				$('#btnAdd').hide();
				$('#btnEdit').attr({'data-id':id, 'input':'mas_stock_d_grp'}).show();
				$.ajax({
					type: "POST",
					data: { input: 'mas_stock_d_grp' },
					url: 'Cmaster/viewModalMasterStockGroup',
					success: function(data){
						$('#master_crud').find('div.modal-body').html(data);
						$('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Group`);
						$.ajax({
							type: "POST",
							data: { 
								input: 'mas_stock_d_grp' ,
								GroupCode: id
							},
							url: 'Cmaster/getDataMasterStockGroupByID',
							dataType: 'JSON',
							success: function(hasil){
								$.ajax({
				        			type: "POST",
				        			data: {input: 'mas_stock_c_type'},
				        			url: 'Cmaster/getDataMasterStockGroup',
				        			dataType: 'JSON',
				        			success: function(value){
				        				var html='<option></option>';
				        				for(var i=0;i<value.length;i++){
				        					html += `<option value="${value[i].TypeCode}">${value[i].TypeCode} - ${value[i].TypeDescription}</option>`
				        				}
				        				$('#stocktypecode').html(html);
				        				$('#stocktypecode').select2({
				        					dropdownParent: $('#master_crud'),
				        					width: 'auto'
				        				});
										$('#stocktypecode').val(hasil.TypeCode).trigger('change');

				        			}
				        		})

								$('#stockgrpcode').val(hasil.GroupCode);
								$('#stockgrpdescription').val(hasil.GroupDescription);
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
			case 'mas_stock_a_class' :
				var data_stockclass = $('#form_stockclass').serialize();
				$.ajax({
					type: "POST",
					data: data_stockclass+"&input=mas_stock_a_class&id="+id,
					url: 'Cmaster/editDataMasterStockGroup',
					success: function(data){
						dt_stockgroup_class.ajax.reload();
						$('#master_crud').modal('hide');
						alert('Class Updated');
					}
				})
				break;
			case 'mas_stock_b_cat' :
				var data_stockcategory = $('#form_stockcategory').serialize();
				$.ajax({
					type: "POST",
					data: data_stockcategory+"&input=mas_stock_b_cat&id="+id,
					url: 'Cmaster/editDataMasterStockGroup',
					success: function(data){
						dt_stockgroup_cat.ajax.reload();
						$('#master_crud').modal('hide');
						alert('Category Updated');
					}
				})
				break;
			case 'mas_stock_c_type' :
				var data_stocktype = $('#form_stocktype').serialize();
				$.ajax({
					type: "POST",
					data: data_stocktype+"&input=mas_stock_c_type&id="+id,
					url: 'Cmaster/editDataMasterStockGroup',
					success: function(data){
						dt_stockgroup_type.ajax.reload();
						$('#master_crud').modal('hide');
						alert('Sub Category Updated');
					}
				})
				break;
			case 'mas_stock_d_grp' :
				var data_stockgrp = $('#form_stockgrp').serialize();
				$.ajax({
					type: "POST",
					data: data_stockgrp+"&input=mas_stock_d_grp&id="+id,
					url: 'Cmaster/editDataMasterStockGroup',
					success: function(data){
						dt_stockgroup_grp.ajax.reload();
						$('#master_crud').modal('hide');
						alert('Group Updated');
					}
				})
				break;
		}
	})

	$(document).on('click', 'a.disc-stockgroup', function(e){
		e.preventDefault();
		var id = $(this).parents('tr').attr('id');
		var accept = confirm('Are you sure to discontinue this data ?');
		switch($(this).attr('input')){
			case 'mas_stock_a_class':
				if(accept == true){
					var remarks = prompt("Remarks", "");
					  if (remarks != null) {
						    document.getElementById("demo").innerHTML =
								$.ajax({
									type: "POST",
									data: {
										input: 'mas_stock_a_class',
										id: id,
										remarks: remarks
									},
									url: 'Cmaster/discDataMasterStockGroup',
									success: function(data){
										dt_stockgroup_class.ajax.reload();
										alert('Class Discontinued');
									}
								})
					  }else{
					  	alert('Thankyou')
					  }
				} else {
					alert('Thankyou')
				}
				break;
			case 'mas_stock_b_cat':
				if(accept == true){
					var remarks = prompt("Remarks", "");
					  if (remarks != null) {
						    document.getElementById("demo").innerHTML =
								$.ajax({
									type: "POST",
									data: {
										input: 'mas_stock_b_cat',
										id: id,
										remarks: remarks
									},
									url: 'Cmaster/discDataMasterStockGroup',
									success: function(data){
										dt_stockgroup_cat.ajax.reload();
										alert('Category Discontinued');
									}
								})
					  }else{
					  	alert('Thankyou')
					  }
				} else {
					alert('Thankyou')
				}
				break;
			case 'mas_stock_c_type':
				if(accept == true){
					var remarks = prompt("Remarks", "");
					  if (remarks != null) {
						    document.getElementById("demo").innerHTML =
								$.ajax({
									type: "POST",
									data: {
										input: 'mas_stock_c_type',
										id: id,
										remarks: remarks
									},
									url: 'Cmaster/discDataMasterStockGroup',
									success: function(data){
										dt_stockgroup_type.ajax.reload();
										alert('Sub Category Discontinued');
									}
								})
					  }else{
					  	alert('Thankyou')
					  }
				} else {
					alert('Thankyou')
				}
				break;
			case 'mas_stock_d_grp':
				if(accept == true){
					var remarks = prompt("Remarks", "");
					  if (remarks != null) {
						    document.getElementById("demo").innerHTML =
								$.ajax({
									type: "POST",
									data: {
										input: 'mas_stock_d_grp',
										id: id,
										remarks: remarks
									},
									url: 'Cmaster/discDataMasterStockGroup',
									success: function(data){
										dt_stockgroup_grp.ajax.reload();
										alert('Group Discontinued');
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