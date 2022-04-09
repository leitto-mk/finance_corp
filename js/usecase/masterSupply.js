/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const callable = {
    validateModalInputs: form => {
        let forms = $(`#${form} .form-required`).serializeArray()

        //Validate each inputs
        for(const e of forms){
            if(e['value'] == ""){
                $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').addClass('has-error')
                return false
            } else {
               $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').removeClass('has-error')
                return true
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

        return true
    }
}

const msup = {
    initTables: () => {
        //Group
        repository.generateDataTable(
            '#table_master_stockgroup_grp',
            'Cmaster/getDataMasterStockGroup',
            {
                input: 'mas_stock_d_grp'
            },
            [
                {targets:0, className: 'control', orderable: false, defaultContent: ""},
                {targets:1, data: "GroupCode"},
                {targets:2, data: "GroupDescription"},
                {targets:3, data: "TypeDescription"},
                {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
            ]
        ).then(() => {
            helper.unblockUI()
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'icon': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.desc}</h4>`
            })
        })

        //Sub-Category
        repository.generateDataTable(
            '#table_master_stockgroup_type',
            'Cmaster/getDataMasterStockGroup',
            {
                input: 'mas_stock_c_type'
            },
            [
                {targets:0, className: 'control', orderable: false, defaultContent: ""},
                {targets:1, data: "TypeCode"},
                {targets:2, data: "TypeDescription"},
                {targets:3, data: "CatDescription"},
                {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
            ]
        ).then(() => {
            helper.unblockUI()
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'icon': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.desc}</h4>`
            })
        })

        //Category
        repository.generateDataTable(
            '#table_master_stockgroup_cat',
            'Cmaster/getDataMasterStockGroup',
            {
                input: 'mas_stock_b_cat'
            },
            [
                {targets:0, className: 'control', orderable: false, defaultContent: ""},
                {targets:1, data: "CatCode"},
                {targets:2, data: "CatDescription"},
                {targets:3, data: "StockClassDescription"},
                {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
            ]
        ).then(() => {
            helper.unblockUI()
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'icon': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.desc}</h4>`
            })
        })

        //Stock-Class
        repository.generateDataTable(
            '#table_master_stockgroup_class',
            'Cmaster/getDataMasterStockGroup',
            {
                input: 'mas_stock_a_class'
            },
            [
                {targets:0, className: 'control', orderable: false, defaultContent: ""},
                {targets:1, data: "StockClassCode"},
                {targets:2, data: "StockClassDescription"},
                {targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
            ]
        ).then(() => {
            helper.unblockUI()
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'icon': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.desc}</h4>`
            })
        })
    },

    eventAddNewItem: () => {
        //OPEN MODAL
        $(document).on('click','.btnModal', function(){
            switch($(this).attr('id')){
                case 'btn_add_stockgroup_grp':
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
                                    helper.setSelect2($('#stocktypecode'), {
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'btn_add_stockgroup_type':
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
                                    helper.setSelect2($('#stockcatcode'), {
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'btn_add_stockgroup_cat':
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
                                    helper.setSelect2($('#stockclasscode'), {
                                        placeholder: "Choose Class",
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'btn_add_stockgroup_class':
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
            }
        })

        //SUBMIT ITEM
        $(document).on('click', '#btnAdd', function(){
            switch($(this).attr('input')){
                case 'mas_stock_d_grp':
                    var data_stockgrp = $('#form_stockgrp').serialize();
                    validate = callable.validateModalInputs('form_stockgrp')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_stockgrp+"&input=mas_stock_d_grp",
                            url: 'Cmaster/inputDataMasterStockGroup',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    repository.generateDataTable(
                                        '#table_master_stockgroup_grp',
                                        'Cmaster/getDataMasterStockGroup',
                                        {
                                            input: 'mas_stock_d_grp'
                                        },
                                        [
                                            {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                            {targets:1, data: "GroupCode"},
                                            {targets:2, data: "GroupDescription"},
                                            {targets:3, data: "TypeDescription"},
                                            {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                        ]
                                    ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                case 'mas_stock_c_type':
                    var data_stocktype = $('#form_stocktype').serialize();
                    validate = callable.validateModalInputs('form_stocktype')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_stocktype+"&input=mas_stock_c_type",
                            url: 'Cmaster/inputDataMasterStockGroup',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    repository.generateDataTable(
                                        '#table_master_stockgroup_type',
                                        'Cmaster/getDataMasterStockGroup',
                                        {
                                            input: 'mas_stock_c_type'
                                        },
                                        [
                                            {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                            {targets:1, data: "TypeCode"},
                                            {targets:2, data: "TypeDescription"},
                                            {targets:3, data: "CatDescription"},
                                            {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                        ]
                                    ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                case 'mas_stock_b_cat':
                    var data_stockcategory = $('#form_stockcategory').serialize();
                    validate = callable.validateModalInputs('form_stockcategory')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_stockcategory+"&input=mas_stock_b_cat",
                            url: 'Cmaster/inputDataMasterStockGroup',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    repository.generateDataTable(
                                        '#table_master_stockgroup_cat',
                                        'Cmaster/getDataMasterStockGroup',
                                        {
                                            input: 'mas_stock_b_cat'
                                        },
                                        [
                                            {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                            {targets:1, data: "CatCode"},
                                            {targets:2, data: "CatDescription"},
                                            {targets:3, data: "StockClassDescription"},
                                            {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                        ]
                                    ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                case 'mas_stock_a_class':
                    var data_stockclass = $('#form_stockclass').serialize();
                    validate = callable.validateModalInputs('form_stockclass')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_stockclass+"&input=mas_stock_a_class",
                            url: 'Cmaster/inputDataMasterStockGroup',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    repository.generateDataTable(
                                        '#table_master_stockgroup_class',
                                        'Cmaster/getDataMasterStockGroup',
                                        {
                                            input: 'mas_stock_a_class'
                                        },
                                        [
                                            {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                            {targets:1, data: "StockClassCode"},
                                            {targets:2, data: "StockClassDescription"},
                                            {targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                        ]
                                    ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
            }
        })
    },

    eventEditItem: () => {
        //OPEN MODAL
        $(document).on('click', 'a.edit-stockgroup', function(e){
            e.preventDefault();
            var id = $(this).parents('tr').attr('id');
            if(!id){
                id = $(this).data('id')
            }
            switch($(this).attr('input')){
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
                                            helper.setSelect2($('#stocktypecode'), {
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
                                            helper.setSelect2($('#stockcatcode'), {
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
                                            helper.setSelect2($('#stockclasscode'), {
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
            }
        })

        //SUBMIT EDIT
        $(document).on('click', 'button#btnEdit', function(){
            var id = $(this).attr('data-id')
            switch ($(this).attr('input')){
                case 'mas_stock_d_grp' :
                    var data_stockgrp = $('#form_stockgrp').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_stockgrp+"&input=mas_stock_d_grp&id="+id,
                        url: 'Cmaster/editDataMasterStockGroup',
                        success: function(data){
                            repository.generateDataTable(
                                $('#table_master_stockgroup_grp'),
                                'Cmaster/getDataMasterStockGroup',
                                {
                                    input: 'mas_stock_d_grp'
                                },
                                [
                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                    {targets:1, data: "GroupCode"},
                                    {targets:2, data: "GroupDescription"},
                                    {targets:3, data: "TypeDescription"},
                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                ]
                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
                            $('#master_crud').modal('hide');
                            alert('Group Updated');
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
                            repository.generateDataTable(
                                $('#table_master_stockgroup_type'),
                                'Cmaster/getDataMasterStockGroup',
                                {
                                    input: 'mas_stock_c_type'
                                },
                                [
                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                    {targets:1, data: "TypeCode"},
                                    {targets:2, data: "TypeDescription"},
                                    {targets:3, data: "CatDescription"},
                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                ]
                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
                            $('#master_crud').modal('hide');
                            alert('Sub Category Updated');
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
                            repository.generateDataTable(
                                $('#table_master_stockgroup_cat'),
                                'Cmaster/getDataMasterStockGroup',
                                {
                                    input: 'mas_stock_b_cat'
                                },
                                [
                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                    {targets:1, data: "CatCode"},
                                    {targets:2, data: "CatDescription"},
                                    {targets:3, data: "StockClassDescription"},
                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                ]
                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
                            $('#master_crud').modal('hide');
                            alert('Category Updated');
                        }
                    })
                    break; 
                case 'mas_stock_a_class' :
                    var data_stockclass = $('#form_stockclass').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_stockclass+"&input=mas_stock_a_class&id="+id,
                        url: 'Cmaster/editDataMasterStockGroup',
                        success: function(data){
                            repository.generateDataTable(
                                $('#table_master_stockgroup_class'),
                                'Cmaster/getDataMasterStockGroup',
                                {
                                    input: 'mas_stock_a_class'
                                },
                                [
                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                    {targets:1, data: "StockClassCode"},
                                    {targets:2, data: "StockClassDescription"},
                                    {targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                ]
                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
                            $('#master_crud').modal('hide');
                            alert('Class Updated');
                        }
                    })
                    break;
            }
        })
    },

    eventDeleteItem: () => {
        $(document).on('click', 'a.disc-stockgroup', function(e){
            e.preventDefault();
            var id = $(this).parents('tr').attr('id');
            var accept = confirm('Are you sure to discontinue this data ?');
            switch($(this).attr('input')){
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
                                            repository.generateDataTable(
                                                $('#table_master_stockgroup_grp'),
                                                'Cmaster/getDataMasterStockGroup',
                                                {
                                                    input: 'mas_stock_d_grp'
                                                },
                                                [
                                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                                    {targets:1, data: "GroupCode"},
                                                    {targets:2, data: "GroupDescription"},
                                                    {targets:3, data: "TypeDescription"},
                                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                                ]
                                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                                            repository.generateDataTable(
                                                $('#table_master_stockgroup_type'),
                                                'Cmaster/getDataMasterStockGroup',
                                                {
                                                    input: 'mas_stock_c_type'
                                                },
                                                [
                                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                                    {targets:1, data: "TypeCode"},
                                                    {targets:2, data: "TypeDescription"},
                                                    {targets:3, data: "CatDescription"},
                                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                                ]
                                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                                            repository.generateDataTable(
                                                $('#table_master_stockgroup_cat'),
                                                'Cmaster/getDataMasterStockGroup',
                                                {
                                                    input: 'mas_stock_b_cat'
                                                },
                                                [
                                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                                    {targets:1, data: "CatCode"},
                                                    {targets:2, data: "CatDescription"},
                                                    {targets:3, data: "StockClassDescription"},
                                                    {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                                ]
                                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
                                            repository.generateDataTable(
                                                $('#table_master_stockgroup_class'),
                                                'Cmaster/getDataMasterStockGroup',
                                                {
                                                    input: 'mas_stock_a_class'
                                                },
                                                [
                                                    {targets:0, className: 'control', orderable: false, defaultContent: ""},
                                                    {targets:1, data: "StockClassCode"},
                                                    {targets:2, data: "StockClassDescription"},
                                                    {targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-pencil" title="Edit"></i></a> <a class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal"><i class="fa fa-close" title="Discontinue"></i></a></center>'}
                                                ]
                                            ).then(() => {
                                                helper.unblockUI()
                                            })
                                            .fail(err => {
                                                helper.unblockUI()

                                                Swal.fire({
                                                    'icon': 'error',
                                                    'title': 'ERROR',
                                                    'html': `<h4 class="sbold">${err.desc}</h4>`
                                                })
                                            })
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
            }   
        })
    }
}

export default msup