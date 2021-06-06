<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>eNova</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include $links; ?>
    </head>
    <body data-sidebar="dark">
        <div id="layout-wrapper">
            <?php include $nav; ?>
            <?php include $left_nav; ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">File's list</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			            <div id="form_status"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title-desc">List</h4>
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>File</th>
                                                            <th>Share By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach ($file_data as $data){ ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="<?=baseURL?>/assets/uploads/<?php echo $data->file_path; ?>" target="_blank" class="btn btn-success waves-effect waves-light">View File</a></td>
                                                                <td><?php echo $data->full_name; ?></td>
                                                            </tr>
                                                        <?php $i++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <?php include $script; ?>
    </body>
</html>