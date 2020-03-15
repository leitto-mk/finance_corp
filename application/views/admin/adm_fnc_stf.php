<?php $this->load->view('admin/navbar/adm_navbar'); ?>
<div class="container-fluid">
    <div class="page-content">

        <div class="page-content-col">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 page-404">
                    <div class="number font-green"> 404 </div>
                    <div class="details">
                        <h3>Oops! You're lost.</h3>
                        <p> We can not find the page you're looking for.
                            <br>
                            <a href="index.html"> Return home </a> or try the search bar below. </p>
                        <form action="#">
                            <div class="input-group input-medium">
                                <input type="text" class="form-control" placeholder="keyword...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>

    </div>
    <?php $this->load->view('_partials/_foot'); ?>