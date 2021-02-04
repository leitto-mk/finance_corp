<?php $this->load->view('report/template/header');s?>
<style type="text/css">
    .table td,th{
        border-top: 0px!important;
    }

    .profile-contact .table{
        margin-top: 10px;
    }

    .profile-contact .table th{
        padding: 12px 0px!important;
        color: #555555;
    }

    .profile-contact .table td{
        font-size: 16px;
        padding-right: 10px;
        color: #5e738b;
    }
</style>
<div class="">
    <div class="page-content bg-grey-steel">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <!-- <h1>Master File</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
                <li class="active">System</li>
            </ol> -->
            <!-- Sidebar Toggle Button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#page-sidebar">
                <span class="sr-only">Toggle navigation</span>
                <span class="toggle-icon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <!-- Sidebar Toggle Button -->
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
        <div class="page-content-container" style="margin-top: -40px">
            <div class="page-content-row">
                <?php $this->load->view('report/template/sidebar_master'); ?>
                <div class="page-content-col">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 0px; padding: 0px">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px">
                            <div class="portlet light bordered">
                                <div class="portlet-body"> 
                                    Download Report :
                                    <a href="<?php echo site_url('Report/excel_report_student_nohp'); ?>" ><img src="<?php echo base_url(); ?>assets/flaticon/dimitry-miroliubov/flat/files-icon-pack/xls.png" alt="..." style="width: 40px; height: 40px;object-fit: cover;"></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="#"><img src="<?php echo base_url(); ?>assets/flaticon/dimitry-miroliubov/flat/files-icon-pack/pdf.png" alt="..." style="width: 40px; height: 40px;object-fit: cover;"></a>
                                    <div class="table-responsive" style="margin-top: 20px">
                                        <table class="table table-bordered table-stripped table-condensed">
                                            <thead>
                                                <tr style="background-color: #bfbfbfb0" class="font-dark">
                                                    <th width="5%" class="text-center">No</th>
                                                    <th width="25%" class="text-center">NIS</th>
                                                    <th width="30%" class="text-center">Nama Lengkap</th>
                                                    <th width="20%" class="text-center">Ruangan</th>
                                                    <th width="20%" class="text-center">Handphone</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_report_student">
                                                  <tr><td colspan="5"><h4 align="center" class="font-green bold"><i>Please! Select Parameter First</i></h4></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>  
                        </div>  
                        <form class="margin-bottom-40 form-horizontal">
                            <div class="col-md-4 col-sm-12 col-xs-12" style=" background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa; padding-right: 0px"> 
                                <h3><i class="fa fa-edit"></i>&nbsp;Parameter</h3>
                                <div class="portlet-body">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><b>School<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                            <div class="col-md-8">
                                                <select name="sch" id="sch" class="form-control" required>
                                                </select>                          
                                            </div>                                                                   
                                        </div>                                                      
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><b>Class<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                            <div class="col-md-5">
                                                <select class="form-control" name="cls" id="cls" required>
                                                    <option value="All" selected>All</option>  
                                                </select>                            
                                            </div>                                                                   
                                        </div>                                                      
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><b>Room<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                            <div class="col-md-5">
                                                <select class="form-control" name="rm" id="rm" required>
                                                    <option value="All" selected>All</option>                   
                                                </select>                            
                                            </div>                                                                   
                                        </div>                                                      
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><b>Action<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                            <div class="col-md-4">
                                                <input id="submit_report_s" value="Priview" class="btn btn-transparent green btn-block btn-sm">                           
                                            </div>                                                                   
                                        </div>                                                      
                                    </div>
                                </div>
                            </div>          
                        </form> 
                    </div>    
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>
<?php $this->load->view('report/template/footer');?>
<script type="text/javascript">
    // Notes : This Code Add row Copyright to mredkj.com - tabledeleterow.js version 1.2 2006-02-21
    window.onload = get_detail_addrow
    function get_detail_addrow() {
        document.body.style.zoom = 0.9;
        // $('#sch').select2();
        $('#cls').select2();
        $('#rm').select2();

        load_list_school();

        $('#sch').change(function(){
            var idsch = $(this).val() 
            if (idsch != 'All') {            
                load_list_class(idsch)
            } else {            
                $('#cls').html('<option value="All"> All </option>');
                $('#rm').html('<option value="All"> All </option>');
            }
        });

        $(document).on('change', '#cls', function(){
            var clsvalue = $(this).val();
            if (clsvalue != "All") {
                let clscodes = $('#cls option:selected').val()         
                let clscodes_id = $('#cls option:selected').attr('cls-id')
                load_list_room_by_class(clscodes_id) 
            } else {
                $('#rm').html('<option value="All"> All </option>');       
                $('#idnum').html('<option value="All"> All </option>');       
            }
        });

        function load_list_school(){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_list_school'); ?>",
                type    : "POST",
                async   : false,
                dataType : "json",
                success : function(data){
                    if (data.rstatus == "success") {
                        var school = data.data;
                        // html += '<option value="All">All</option>';    
                        for (let index = 0; index < school.length; index++) {
                            html += '<option value="'+school[index].SchoolID+'">'+school[index].School_Desc+' | '+school[index].SchoolName+'</option>';                                                      
                        }
                        $('#sch').html(html);  
                    } else {
                        $('#sch').html('<option disabled> No Data School </option>');
                    }
                }, error : function(){
                    alert("Error to load School !");
                }
            });
        }

        function load_list_class(idsch){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Report/get_list_class_by_school'); ?>",
                data    : {id_sch : idsch},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var class_ = data.data;
                        html += '<option value="All">All</option>';                                                      
                        for (let index = 0; index < class_.length; index++) {
                            html += '<option value="'+class_[index].ClassDesc+'"  cls-id="'+class_[index].ClassID+'">'+class_[index].ClassDesc+'</option>';                                                      
                        }
                        $('#cls').html(html);

                    } else {
                        $('#cls').html('<option disabled> No Data Class </option>');
                    }
                }, error : function(){
                    alert("Error to load Class !");
                }
            });
        }

        function load_list_room_by_class(clscodes_id){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Report/get_data_list_room_by_class'); ?>",
                data    : {cls_codes_id : clscodes_id},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var room_ = data.data;
                        html += '<option value="All">All</option>';
                        for (let index = 0; index < room_.length; index++) {
                            html += '<option value="'+room_[index].RoomDesc+'">'+room_[index].RoomDesc+'</option>';                                                      
                        }
                        $('#rm').html(html);      
                        
                    } else {
                        $('#rm').html('<option disabled> No Data Room </option>');
                    }
                }, error : function(){
                    alert("Error to load Room !");
                }
            });      
        }

        $(document).on('click','#submit_report_s', function() {
            let sch = $('#sch option:selected').val()    
            let cls = $('#cls option:selected').val()    
            let rm = $('#rm option:selected').val()
            console.log(sch,cls,rm)
            $.ajax({
                url     : "get_data_report_student",
                type    : "POST",
                data    : {
                    sch : sch, cls : cls, rm : rm
                },
                success : function(data){
                    $('#table_report_student').html(data)
                }, error : function(){
                    alert("Error to load Data !");
                }
            });
        });
    }
</script>
                