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
                                    <h4 class="mb-sm-0 font-size-18">User's Add</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <form id="userForm" enctype="multipart/form-data">
                                    <h4 class="card-title-desc">Add form</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">User id</label>
                                                    <input type="text" class="form-control"name="user_id" id="user_id" placeholder="Enter user id">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control"name="password" id="password" placeholder="Enter password">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control"name="full_name" id="full_name" placeholder="Enter full name">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control"name="email" id="email" placeholder="Enter email">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">User Type</label>
                                                    <select class="form-select" name="user_type" id="user_type">
                                                        <option value="0" disabled selected>Select</option>
                                                        <option value="1">Employee</option>
                                                        <option value="2">Customer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary w-md float-end">Submit</button>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <span style="color:red;" id="userForm_error"></span>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <?php include $script; ?>
        <script>
            $(document).ready(function(){
                $("#userForm").submit(function(e)
                {
                    var $this=$(this);
                    $this.find('button').attr('disabled',true);
                    e.preventDefault();
			        // $("#userForm_error").html('Please Wait......');
                    $("#userForm_error").html('<div class="alert alert-primary alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Please Wait......! </strong></div>');
                    $.ajax(
                    {
                        url: "<?=baseURLUSER?>/registeruser",
                        type: "POST",
                        data:  $(this).serialize(),success: function(response)
                        {
                            var result=JSON.parse(response);
                            if(result['status']=='success')
                            {
                                $("#userForm_error").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Success! </strong>'+ result['message'] + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						        // $('#userForm_error').html(result['message']);
						        window.setTimeout(function(){window.location.href = '<?=baseURLUSER?>/userlist.html';},2000)
                            }
                            else
                            {
                                $("#userForm_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Error! </strong>'+ result['message'] + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                // $('#userForm_error').html(result['message']);
                                $this.find('button').attr('disabled',false);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>