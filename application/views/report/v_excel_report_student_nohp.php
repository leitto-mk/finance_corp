<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report_excel__contact_student.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
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
        <tbody id="tetsafds">
            <?php foreach ($get_school as $sc){ ?>
                <tr>
                    <td colspan="7"><u><h4 class="bold"><?php echo $sc->SchoolName ?></h4></u></td>
               </tr>
               <?php foreach ($get_class as $cl){ ?>
                    <tr>
                        <td colspan="7" style="background-color : #f6f6f6" class="sbold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cl->ClassDesc ?></td>
                    </tr>
                        <?php if ($data_report_student != false){ ?>
                            <?php $no=1; foreach ($data_report_student as $rs){ ?>
                                    <tr>
                                    <td align="center"><?php echo $no; ?></td>
                                    <td><?php echo $rs->NIS ?></td>
                                    <td class="sbold"><?php echo $rs->FirstName ?> <?php echo $rs->MiddleName ?> <?php echo $rs->LastName ?></td>
                                    <td><?php echo $rs->RoomDesc ?></td>
                                    <td><?php echo $rs->Phone ?></td>
                                    </tr>
                            <?php $no++;} ?>
                        <?php }else { ?> 
                            <h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>
                        <?php } ?>
                <?php } ?>
            <?php } ?>        
        </tbody>
    </table>                              
</body>
</html>
                       