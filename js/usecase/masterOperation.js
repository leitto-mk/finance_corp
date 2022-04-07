/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const callable = {
    loadDataTable: (table, url, postData, columnDef) => {
        table.DataTable({
            destroy: true,
            responsive: true,
            autoWidth: false,
            lengthMenu: [10, 25, 50, 100, 500],
            ajax: {
                type: "POST",
                data: postData,
                url: url,
                dataSrc: ""
            },
            columnDefs: columnDef
        })
    },
    
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

const mopr = {
    initTables: () => {
        //Company
        callable.loadDataTable(
            $('#table_master_abase_company'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasecompany' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"ComCode"},
                {targets:2, data:"ComShortName"},
                {targets:3, data:"City"},
                {targets:4, orderable: false, defaultContent: '<a class="btn dark btn-xs btn-outline view-abase" input="abasecompany" href="#"><i class="fa fa-search"></i></a> <a class="btn dark btn-xs btn-outline edit-abase" input="abasecompany" href="#"><i class="fa fa-pencil"></i></a> <a class="btn dark btn-xs btn-outline disc-abase" input="abasecompany" href="#"><i class="fa fa-trash"></i></a>'}
            ]
        )

        //Branch
        callable.loadDataTable(
            $('#table_master_abase_branch'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasebranch' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"BranchCode"},
                {targets:2, data:"BranchName"},
                {targets:3, data:"BranchAddress"},
                {targets:4, data:"ContactNo"},
                {targets:5, orderable: false, defaultContent: '<a class="btn blue btn-xs btn-outline view-abase" input="abasebranch" href="#"><i class="fa fa-search"></i></a> <a class="btn green btn-xs btn-outline edit-abase" input="abasebranch" href="#"><i class="fa fa-pencil"></i></a> <a class="btn yellow btn-xs btn-outline disc-abase" input="abasebranch" href="#"><i class="fa fa-close"></i></a>'}
            ]
        )

        //Department
        callable.loadDataTable(
            $('#table_master_abase_department'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartment' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"DeptCode"},
                {targets:2, data:"DeptDes"},
                {targets:3, 
                    data:"Branch",
                    render: function(data,type,row){
                        return `${data} - ${row.BranchName}`
                    }
                },
                {targets:4, 
                    data:"BUCode",
                    render: function(data,type,row){
                        return `${data} - ${row.BUDes}`
                    }
                },
                {targets:5, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-abase" input="abasedepartment" href="#"><i class="fa fa-pencil"></i></a> <a class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartment" href="#"><i class="fa fa-close"></i></a></center>'}
            ]
        )

        //Department Business Unit (BU)
        callable.loadDataTable(
            $('#table_master_abase_department_bu'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartmentbu' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"BUCode"},
                {targets:2, data:"BUDes"},
                {targets:3, 
                    data:"DivCode",
                    render: function(data,type,row){
                        return `${data} - ${row.DivDes}`
                    }
                },
                {targets:4, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-abase" input="abasedepartment" href="#"><i class="fa fa-pencil"></i></a> <a class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartment" href="#"><i class="fa fa-close"></i></a></center>'}
            ]
        )

        //Department Division
        callable.loadDataTable(
            $('#table_master_abase_department_div'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartmentdiv' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"DivCode"},
                {targets:2, data:"DivDes"},
                {targets:3, orderable: false, defaultContent: '<center><a class="btn green btn-xs btn-outline edit-abase" input="abasedepartmentdiv" href="#"><i class="fa fa-pencil"></i></a> <a class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartmentdiv" href="#"><i class="fa fa-close"></i></a></center>'}
            ]
        )

        //Cost Center
        callable.loadDataTable(
            $('#table_master_abase_cost_center'),
            'Cmaster/getDataMasterAbase',
            { input: 'abasecostcenter' },
            [
                {targets:0, className: 'control', orderable: false, defaultContent:""},
                {targets:1, data:"CostCenter"},
                {targets:2, data:"CCDes"},
                {targets:3, data:"DeptCode"},
                {targets:4, orderable: false, defaultContent: '<a class="btn green btn-xs btn-outline edit-abase" input="abasecostcenter" href="#"><i class="fa fa-pencil"></i></a> <a class="btn yellow btn-xs btn-outline disc-abase" input="abasecostcenter" href="#"><i class="fa fa-close"></i></a>'}
            ]
        )
    },

    eventAddNewItem: () => {
        //OPEN MODAL
        $(document).on('click', '.btnModal', function(){
            $('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
            switch($(this).attr('id')){
                case 'button_add_master_abase_company':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasecompany').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasecompany'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Company`);
                            $('#master_crud').on('shown.bs.modal', function(){
                                $('#abasecompanycode').focus()
                            })
                        }
                    })
                    break;
                case 'button_add_master_abase_branch':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasebranch').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasebranch'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Branch`);
                            $.ajax({
                                type: "POST",
                                data: {input: 'abasecompany'},
                                url: 'Cmaster/getDataMasterAbase',
                                dataType: 'JSON',
                                success: function(hasil){
                                    var html='<option></option>';
                                    for(var i=0;i<hasil.length;i++){
                                        html += `<option value="${hasil[i].ComCode}">${hasil[i].ComCode} - ${hasil[i].ComShortName}</option>`
                                    }
                                    $('#abasebranchcompanycode').html(html);
                                    helper.setSelect2($('#abasebranchcompanycode'), {
                                        placeholder: "Choose Company",
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'button_add_master_abase_department':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasedepartment').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasedepartment'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Department`);
                            $.ajax({
                                type: "POST",
                                data: {input: 'abasebranch'},
                                url: 'Cmaster/getDataMasterAbase',
                                dataType: 'JSON',
                                success: function(hasil){
                                    var html='<option></option>';
                                    for(var i=0;i<hasil.length;i++){
                                        html += `<option value="${hasil[i].BranchCode}">${hasil[i].BranchName}</option>`
                                    }
                                    $('#abasedepartmentbranch').html(html);
                                    helper.setSelect2($('#abasedepartmentbranch'), {
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                            $.ajax({
                                type: "POST",
                                data: {input: 'abasedepartmentbu'},
                                url: 'Cmaster/getDataMasterAbase',
                                dataType: 'JSON',
                                success: function(hasil){
                                    var html='<option></option>';
                                    for(var i=0;i<hasil.length;i++){
                                        html += `<option value="${hasil[i].BUCode}">${hasil[i].BUCode} - ${hasil[i].BUDes}</option>`
                                    }
                                    $('#abasedepartmentbucode').html(html);
                                    helper.setSelect2($('#abasedepartmentbucode'), {
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'button_add_master_abase_department_bu':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasedepartmentbu').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasedepartmentbu'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Business Unit`);
                            $.ajax({
                                type: "POST",
                                data: {input: 'abasedepartmentdiv'},
                                url: 'Cmaster/getDataMasterAbase',
                                dataType: 'JSON',
                                success: function(hasil){
                                    var html='<option></option>';
                                    for(var i=0;i<hasil.length;i++){
                                        html += `<option value="${hasil[i].DivCode}">${hasil[i].DivCode} - ${hasil[i].DivDes}</option>`
                                    }
                                    $('#abasedepartmentbudivisioncode').html(html);
                                    helper.setSelect2($('#abasedepartmentbudivisioncode'), {
                                        dropdownParent: $('#master_crud'),
                                        width: 'auto'
                                    });
                                }
                            })
                        }
                    })
                    break;
                case 'button_add_master_abase_department_div':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasedepartmentdiv').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasedepartmentdiv'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i>  Division`);
                        }
                    })
                    break;
                case 'button_add_master_abase_cost_center':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input','abasecostcenter').show();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasecostcenter'},
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Cost Center`);
                            $.ajax({
                                type: "POST",
                                data: {input: 'abasedepartment'},
                                url: 'Cmaster/getDataMasterAbase',
                                dataType: 'JSON',
                                success: function(hasil){
                                    var html='<option></option>';
                                    for(var i=0;i<hasil.length;i++){
                                        html += `<option value="${hasil[i].DeptCode}">${hasil[i].DeptCode} - ${hasil[i].DeptDes}</option>`
                                    }
                                    $('#abasecostcenterdepartment').html(html);
                                    helper.setSelect2($('#abasecostcenterdepartment'), {
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

        //SUBMIT ITEM
        $(document).on('click', '#btnAdd', function(){
            switch($(this).attr('input')){
                case 'abasecompany':
                    var data_abasecompany = $('#form_abasecompany').serialize();
                    validate = callable.validateModalInputs('form_abasecompany')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasecompany+"&input=abasecompany",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                location.reload();
                                $('#master_crud').modal('hide');
                                if(data == 'success'){
                                    alert('Company Created')
                                } 
                                if(data == 'Data Exist') {
                                    alert(data)
                                }
                            }, error: function(e){
                                alert('Error Occured!')
                            }
                        })
                    } else{
                        alert('Error Occured!')
                    }					
                    break;
                case 'abasebranch':
                    var data_abasebranch = $('#form_abasebranch').serialize();
                    validate = callable.validateModalInputs('form_abasebranch')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasebranch+"&input=abasebranch",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    alert('Branch Created')
                                    dt_abase_branch.ajax.reload();
                                    $('#master_crud').modal('hide');
                                }
                                if(data == "Data Exist"){
                                    alert(`${data}!`)
                                    $('#abasebranchcode').parents('.form-group').addClass('has-warning')
                                    $('#abasebranchcode').focus()
                                }
                            }, error: function(e){
                                alert('Error Occured!')
                            }
                        })
                    } else {
                        alert('Error Occured!')
                    }
                    break;
                case 'abasedepartment':
                    var data_abasedepartment = $('#form_abasedepartment').serialize();
                    validate = callable.validateModalInputs('form_abasedepartment')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasedepartment+"&input=abasedepartment",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    alert('Department Created')
                                    dt_abase_department.ajax.reload();
                                    $('#master_crud').modal('hide');
                                }
                                if(data == "Data Exist"){
                                    alert(`${data}!`)
                                    $('#abasedepartmentcode').parents('.form-group').addClass('has-warning')
                                    $('#abasedepartmentcode').focus()
                                }
                                
                            }, error: function(e){
                                alert('Error Occured!')
                            }
                        })
                    } else {
                        alert('Error Occured!')
                    } 
                        
                    break;
                case 'abasedepartmentbu':
                    var data_abasedepartmentbu = $('#form_abasedepartmentbu').serialize();
                    validate = callable.validateModalInputs('form_abasedepartmentbu')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasedepartmentbu+"&input=abasedepartmentbu",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    alert('Business Unit Created');
                                    dt_abase_department_bu.ajax.reload();
                                    $('#master_crud').modal('hide');
                                }
                                if(data == "Data Exist"){
                                    alert(`${data}!`)
                                    $('#abasedepartmentbucode').parents('.form-group').addClass('has-warning')
                                    $('#abasedepartmentbucode').focus()
                                }
                            }, error: function(e){
                                alert('Error Occured!')
                            }
                        })
                    } else {
                        alert('Error Occured!')
                    }
                    break;
                case 'abasedepartmentdiv':
                    var data_abasedepartmentdiv = $('#form_abasedepartmentdiv').serialize();
                    validate = callable.validateModalInputs('form_abasedepartmentdiv')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasedepartmentdiv+"&input=abasedepartmentdiv",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    alert('Division Created');
                                    dt_abase_department_div.ajax.reload();
                                    $('#master_crud').modal('hide');
                                }
                                if(data == "Data Exist"){
                                    alert(`${data}!`)
                                    $('#abasedepartmentdivcode').parents('.form-group').addClass('has-warning')
                                    $('#abasedepartmentdivcode').focus()
                                }
                            }, error: function(e){
                                alert('Error Occured!')
                            }
                        })
                    } else {
                        alert('Error Occured!')
                    } 
                        
                    break;
                case 'abasecostcenter':
                    var data_abasecostcenter = $('#form_abasecostcenter').serialize();
                    validate = callable.validateModalInputs('form_abasecostcenter')
                    if(validate == true){
                        $.ajax({
                            type: "POST",
                            data: data_abasecostcenter+"&input=abasecostcenter",
                            url: 'Cmaster/inputDatamasterAbase',
                            success: function(data){
                                data = data.replace(/["]/g, "")
                                if(data == "success"){
                                    alert('Cost Center Created');
                                    dt_abase_cost_center.ajax.reload();
                                    $('#master_crud').modal('hide');
                                }
                                if(data == "Data Exist"){
                                    alert(`${data}!`)
                                    $('#abasecostcentercode').parents('.form-group').addClass('has-warning')
                                    $('#abasecostcentercode').focus()
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
        // OPEN MODAL COMPANY PROFILE
        $(document).on('click', '.view-abase', function(){
            var id = $(this).parent().parent().attr('id');
            $('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-lg');
            switch($(this).attr('input')){
                case 'abasecompany':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasecompany'},
                        url: 'Cmaster/viewModalMasterViewAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-search"></i> Company`);
                            $('#master_crud').find('.abasecompanyviewaction').attr('id', id);
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasecompany',
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $('#abasecompanyshortname').text(hasil.ComShortName)
                                    $('#abasecompanydescription').text(hasil.ComDes)
                                    $('#abasecompanyaddress').text(`${hasil.Address}, ${hasil.City}, ${hasil.Province}, ${hasil.Country}, ${hasil.PostalCode}`)
                                    $('#abasecompanycode').text(hasil.ComCode)
                                    $('#abasecompanyname').text(hasil.ComName)
                                    $('#abasecompanytype').html(`<span class="badge badge-roundless bg-blue bg-font-blue">${hasil.CompType}</span>`)
                                    $('#abasecompanynpwp').text(hasil.NPWP)
                                    $('#abasecompanyphone').text(hasil.PhoneNo)
                                    $('#abasecompanycontact').text(hasil.ContactNo);
                                    $('#abasecompanycontactname').text(hasil.ContactName);
                                    $('#abasecompanyemail').text(hasil.Email);
                                    $('#abasecompanywebaddress').text(hasil.WebAddress);
                                    $('#abasebranchlogo').attr("src","http://localhost/assets/"+hasil.Logo)
                                }
                            })
                        }
                    })
                    break;
                case 'abasebranch' :
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').hide();
                    $.ajax({
                        type: "POST",
                        data: {input: 'abasebranch'},
                        url: 'Cmaster/viewModalMasterViewAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-search"></i> Branch`);
                            $('#master_crud').find('.abasebranchviewaction').attr('id', id);
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasebranch',
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $('#abasebranchname').text(hasil.BranchName)
                                    $('#abasebranchdescription').text(hasil.BranchDes)
                                    $('#abasebranchaddress').text(`${hasil.BranchAddress}, ${hasil.BranchCity}, ${hasil.Province}, ${hasil.Country}, ${hasil.PostalCode}`)
                                    $('#abasebranchcode').text(hasil.BranchCode)
                                    $('#abasebranchtype').html(`<span class="badge badge-roundless bg-blue bg-font-blue">${hasil.BranchType}</span>`)
                                    $('#abasebranchphone').text(hasil.PhoneNo)
                                    $('#abasebranchcontact').text(hasil.ContactNo)
                                    $('#abasebranchcontactname').text(hasil.ContactName)
                                    $('#abasebranchemail').text(hasil.Email)
                                    $('#abasebranchwebaddress').text(hasil.WebAddress)
                                }
                            })
                        }
                    })
                     break;
            }
        })

        //OPEN MODAL ITEM
        $(document).on('click', '.edit-abase', function(e){
            e.preventDefault();
            var id = $(this).parents('tr').attr('id');
            if(!id){
                id = $(this).data('id')
            }
            $('#master_crud>div.modal-dialog').attr('class','modal-dialog modal-md');
            switch($(this).attr('input')){
                case 'abasecompany':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasecompany'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasecompany' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Company`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasecompany' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $('#abasecompanycode').val(hasil.ComCode);
                                    $('#abasecompanyname').val(hasil.ComName);
                                    $('#abasecompanyshortname').val(hasil.ComShortName);
                                    $('#abasecompanydescription').val(hasil.ComDes);
                                    $('#abasecompanytype').val(hasil.CompType);
                                    $('#abasecompanyaddress').val(hasil.Address);
                                    $('#abasecompanycity').val(hasil.City);
                                    $('#abasecompanyprovince').val(hasil.Province);
                                    $('#abasecompanypostalcode').val(hasil.PostalCode);
                                    $('#abasecompanycountry').val(hasil.Country);
                                    $('#abasecompanyregion').val(hasil.Region);
                                    $('#abasecompanyphone').val(hasil.PhoneNo);
                                    $('#abasecompanycontact').val(hasil.ContactNo);
                                    $('#abasecompanycontactname').val(hasil.ContactName);
                                    $('#abasecompanynpwp').val(hasil.NPWP);
                                    $('#abasecompanylogo').val(hasil.Logo);
                                    $('#abasecompanyemail').val(hasil.Email);
                                    $('#abasecompanyremarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
                case 'abasebranch':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasebranch'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasebranch' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Branch`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasebranch' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $.ajax({
                                        type: "POST",
                                        data: {input: 'abasecompany'},
                                        url: 'Cmaster/getDataMasterAbase',
                                        dataType: 'JSON',
                                        success: function(value){
                                            var html='<option></option>';
                                            for(var i=0;i<value.length;i++){
                                                html += `<option value="${value[i].ComCode}">${value[i].ComCode} - ${value[i].ComShortName}</option>`
                                            }
                                            $('#abasebranchcompanycode').html(html);
                                            helper.setSelect2($('#abasebranchcompanycode'), {
                                                dropdownParent: $('#master_crud'),
                                                width: 'auto'
                                            });
                                            $('#abasebranchcompanycode').val(hasil.ComCode).trigger('change');
    
                                        }
                                    })
    
                                    $('#abasebranchcode').val(hasil.BranchCode);
                                    $('#abasebranchname').val(hasil.BranchName);
                                    $('#abasebranchdescription').val(hasil.BranchDes);
                                    $('#abasebranchtype').val(hasil.BranchType);
                                    $('#abasebranchaddress').val(hasil.BranchAddress);
                                    $('#abasebranchcity').val(hasil.BranchCity);
                                    $('#abasebranchprovince').val(hasil.Province);
                                    $('#abasebranchprovincegroup').val(hasil.ProvinceGrp);
                                    $('#abasebranchpostalcode').val(hasil.PostalCode);
                                    $('#abasebranchcountry').val(hasil.Country);
                                    $('#abasebranchphone').val(hasil.PhoneNo);
                                    $('#abasebranchcontact').val(hasil.ContactNo);
                                    $('#abasebranchcontactname').val(hasil.ContactName);
                                    $('#abasebranchnpwp').val(hasil.NPWP);
                                    $('#abasebranchlogo').val(hasil.Logo);
                                    $('#abasebranchemail').val(hasil.Email);
                                    $('#abasebranchremarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
                case 'abasedepartment':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasedepartment'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasedepartment' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Department`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasedepartment' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $.ajax({
                                        type: "POST",
                                        data: {input: 'abasebranch'},
                                        url: 'Cmaster/getDataMasterAbase',
                                        dataType: 'JSON',
                                        success: function(value){
                                            var html='<option></option>';
                                            for(var i=0;i<value.length;i++){
                                                html += `<option value="${value[i].BranchCode}">${value[i].BranchName}</option>`
                                            }
                                            $('#abasedepartmentbranch').html(html);
                                            helper.setSelect2($('#abasedepartmentbranch'), {
                                                dropdownParent: $('#master_crud'),
                                                width: 'auto'
                                            });
                                            $('#abasedepartmentbranch').val(hasil.Branch).trigger('change');
                                            
    
                                        }
                                    })
                                    $.ajax({
                                        type: "POST",
                                        data: {input: 'abasedepartmentbu'},
                                        url: 'Cmaster/getDataMasterAbase',
                                        dataType: 'JSON',
                                        success: function(value){
                                            var html='<option></option>';
                                            for(var i=0;i<value.length;i++){
                                                html += `<option value="${value[i].BUCode}">${value[i].BUCode} - ${value[i].BUDes}</option>`
                                            }
                                            $('#abasedepartmentbucode').html(html);
                                            helper.setSelect2($('#abasedepartmentbucode'), {
                                                dropdownParent: $('#master_crud'),
                                                width: 'auto'
                                            });
                                            $('#abasedepartmentbucode').val(hasil.BUCode).trigger('change');
                                        }
                                    })
                                    $('#abasedepartmentcode').val(hasil.DeptCode);
                                    $('#abasedepartmentdescription').val(hasil.DeptDes);
                                    $('#abasedepartmentremarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
                case 'abasedepartmentbu':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasedepartmentbu'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasedepartmentbu' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Business Unit`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasedepartmentbu' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $.ajax({
                                        type: "POST",
                                        data: {input: 'abasedepartmentdiv'},
                                        url: 'Cmaster/getDataMasterAbase',
                                        dataType: 'JSON',
                                        success: function(value){
                                            var html='<option></option>';
                                            for(var i=0;i<value.length;i++){
                                                html += `<option value="${value[i].DivCode}">${value[i].DivCode} - ${value[i].DivDes}</option>`
                                            }
                                            $('#abasedepartmentbudivisioncode').html(html);
                                            helper.setSelect2($('#abasedepartmentbudivisioncode'), {
                                                dropdownParent: $('#master_crud'),
                                                width: 'auto'
                                            });
                                            $('#abasedepartmentbudivisioncode').val(hasil.DivCode).trigger('change');
    
                                        }
                                    })
    
                                    $('#abasedepartmentbucode').val(hasil.BUCode);
                                    $('#abasedepartmentbudescription').val(hasil.BUDes);
                                    $('#abasedepartmentburemarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
                case 'abasedepartmentdiv':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasedepartmentdiv'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasedepartmentdiv' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Division`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasedepartmentdiv' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $('#abasedepartmentdivcode').val(hasil.DivCode);
                                    $('#abasedepartmentdivdescription').val(hasil.DivDes);
                                    $('#abasedepartmentdivremarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
                case 'abasecostcenter':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({'data-id':id, 'input':'abasecostcenter'}).show();
                    $.ajax({
                        type: "POST",
                        data: { input: 'abasecostcenter' },
                        url: 'Cmaster/viewModalMasterAbase',
                        success: function(data){
                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Cost Center`);
                            $.ajax({
                                type: "POST",
                                data: { 
                                    input: 'abasecostcenter' ,
                                    CtrlNo: id
                                },
                                url: 'Cmaster/getDataMasterAbaseByID',
                                dataType: 'JSON',
                                success: function(hasil){
                                    $.ajax({
                                        type: "POST",
                                        data: {input: 'abasedepartment'},
                                        url: 'Cmaster/getDataMasterAbase',
                                        dataType: 'JSON',
                                        success: function(value){
                                            var html='<option></option>';
                                            for(var i=0;i<value.length;i++){
                                                html += `<option value="${value[i].DeptCode}">${value[i].DeptCode} - ${value[i].DeptDes}</option>`
                                            }
                                            $('#abasecostcenterdepartment').html(html);
                                            helper.setSelect2($('#abasecostcenterdepartment'), {
                                                dropdownParent: $('#master_crud'),
                                                width: 'auto'
                                            });
                                            $('#abasecostcenterdepartment').val(hasil.DeptCode).trigger('change');
    
                                        }
                                    })
                                    $('#abasecostcentercode').val(hasil.CostCenter);
                                    $('#abasecostcenterdescription').val(hasil.CCDes);
                                    $('#abasecostcenterremarks').val(hasil.Remarks);
                                },
                            })
                        }
                    })
                    break;
            }
        })
    
        //SUBMIT EDIT
        $(document).on('click', '#btnEdit', function(){
            var id = $(this).attr('data-id')
            switch ($(this).attr('input')){
                case 'abasecompany' :
                    var data_abasecompany = $('#form_abasecompany').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasecompany+"&input=abasecompany&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_company.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Company Updated');
                            location.reload()
                        }
                    })
                    break;
                case 'abasebranch' :
                    var data_abasebranch = $('#form_abasebranch').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasebranch+"&input=abasebranch&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_branch.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Branch Updated');
                        }
                    })
                    break;
                case 'abasedepartment' :
                    var data_abasedepartment = $('#form_abasedepartment').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasedepartment+"&input=abasedepartment&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_department.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Department Updated');
                        }
                    })
                    break;
                case 'abasedepartmentbu' :
                    var data_abasedepartmentbu = $('#form_abasedepartmentbu').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasedepartmentbu+"&input=abasedepartmentbu&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_department_bu.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Business Unit Updated');
                        }
                    })
                    break;
                case 'abasedepartmentdiv' :
                    var data_abasedepartmentdiv = $('#form_abasedepartmentdiv').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasedepartmentdiv+"&input=abasedepartmentdiv&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_department_div.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Division Updated');
                        }
                    })
                    break;
                case 'abasecostcenter' :
                    var data_abasecostcenter = $('#form_abasecostcenter').serialize();
                    $.ajax({
                        type: "POST",
                        data: data_abasecostcenter+"&input=abasecostcenter&id="+id,
                        url: 'Cmaster/editDataMasterAbase',
                        success: function(data){
                            dt_abase_cost_center.ajax.reload();
                            $('#master_crud').modal('hide');
                            alert('Cost Center Updated');
                        }
                    })
                    break;
            }
        })
    },

    eventDeleteItem: () => {
        $(document).on('click', 'a.disc-abase', function(){
            var id = $(this).parents('tr').attr('id')
            var accept = confirm('Are you sure to discontinue this data ?')

            switch($(this).attr('input')){
                case 'abasecompany':
                    if(accept == true){
                        $.ajax({
                            type: "POST",
                            data: {
                                input: 'abasecompany',
                                id: id
                            },
                            url: 'Cmaster/discDataMasterAbase',
                            success: function(data){
                                $('#master_crud').modal('hide');
                                dt_abase_company.ajax.reload();
                                alert('Company Discontinued');
                            }
                        })
                    } else {
                        alert('Thankyou')
                    }
                    break;
                case 'abasebranch':
                    if(accept == true){
                        var remarks = prompt("Remarks", "");
                          if (remarks != null) {
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasebranch',
                                    id: id,
                                    remarks: remarks
                                },
                                url: 'Cmaster/discDataMasterAbase',
                                success: function(data){
                                    $('#master_crud').modal('hide');
                                    dt_abase_branch.ajax.reload();
                                    alert('Branch Discontinued');
                                }
                            })
                        }else{
                            alert('Thankyou')
                        }
                    } else {
                        alert('Thankyou')
                    }
                    break;
                case 'abasedepartment':
                    if(accept == true){
                        var remarks = prompt("Remarks", "");
                          if (remarks != null) {
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasedepartment',
                                    id: id,
                                    remarks: remarks
                                },
                                url: 'Cmaster/discDataMasterAbase',
                                success: function(data){
                                    dt_abase_department.ajax.reload();
                                    alert('Department Discontinued');
                                }
                            })
                        }else{
                            alert('Thankyou')
                        }
                    } else {
                        alert('Thankyou')
                    }
                    break;
                case 'abasedepartmentbu':
                    if(accept == true){
                        var remarks = prompt("Remarks", "");
                          if (remarks != null) {
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasedepartmentbu',
                                    id: id,
                                    remarks: remarks
                                },
                                url: 'Cmaster/discDataMasterAbase',
                                success: function(data){
                                    dt_abase_department_bu.ajax.reload();
                                    alert('Business Unit Discontinued');
                                }
                            })
                        }else{
                            alert('Thankyou')
                        }
                    } else {
                        alert('Thankyou')
                    }
                    break;
                case 'abasedepartmentdiv':
                    if(accept == true){
                        var remarks = prompt("Remarks", "");
                          if (remarks != null) {
                            $.ajax({
                                type: "POST",
                                data: {
                                    input: 'abasedepartmentdiv',
                                    id: id,
                                    remarks: remarks
                                },
                                url: 'Cmaster/discDataMasterAbase',
                                success: function(data){
                                    dt_abase_department_div.ajax.reload();
                                    alert('Division Discontinued');
                                }
                            })
                        }else{
                            alert('Thankyou')
                        }
                    } else {
                        alert('Thankyou')
                    }
                    break;
                case 'abasecostcenter':
                    if(accept == true){
                        $.ajax({
                            type: "POST",
                            data: {
                                input: 'abasecostcenter',
                                id: id
                            },
                            url: 'Cmaster/discDataMasterAbase',
                            success: function(data){
                                dt_abase_cost_center.ajax.reload();
                                alert('Cost Center Discontinued');
                            }
                        })
                    } else {
                        alert('Thankyou')
                    }
                    break;
            }
        })
    }
}

export default mopr