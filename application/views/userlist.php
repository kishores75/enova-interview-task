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
                                    <h4 class="mb-sm-0 font-size-18">User's list</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			            <div id="form_status"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="float: right">
                                            <a href="<?=baseURLUSER?>/useradd.html" class="btn btn-dark"><span class="fas fa-plus"></span> Add User</a>
                                        </h4>
                                        <h4 class="card-title-desc">List</h4>
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; foreach ($user_data as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $data->full_name; ?></td>
                                                        <td><?php echo $data->email; ?></td>
                                                        <td>
                                                            <?php if($data->user_type == 1) echo "Employee";
                                                                elseif($data->user_type == 2) echo "Customer";
                                                                else{} ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger waves-effect waves-light deleteuser" type="button" data-id="<?php echo $data->id; ?>">
                                                                <span class="fas fa-trash-alt"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php $i++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <?php include $script; ?>
        <script>
            $(document).ready(function(){
                $(document).on("click", ".deleteuser", function(e)
                {
                    e.preventDefault();
                    $('#form_status').html('');
                    Id = $(this).attr("data-id");
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ms-2 mt-2",
                        buttonsStyling: !1
                    }).then(function (t) {
                        if(t.value){
                            $.ajax(
                            {
                                url:"<?=baseURLUSER?>/deleteuser",
                                type: "POST",
                                data: { "id":Id },
                                success: function(response)
                                {
                                    var result=JSON.parse(response);
                                    if(result){
                                        if(result['status']=='success'){
                                            $("#form_status").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Success! </strong> Your Data has been deleted <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						                    window.setTimeout(function(){window.location.href = '<?=baseURLUSER?>/userlist.html';},2000)
                                        }else{
                                            $("#form_status").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Error! </strong> Something went wrong try again later <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                        }
                                    }else{
                                        $("#form_status").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Error! </strong> Something went wrong try again later <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                    }
                                }
                            });
                        }else{
                            $("#form_status").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Cancelled! </strong> Your data is safe <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        }
                    });
                });
            });
        </script>
    </body>
</html>