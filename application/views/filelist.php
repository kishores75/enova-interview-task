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
                                    <h4 class="mb-sm-0 font-size-18">File's</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			            <div id="fileDelete_error"></div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#read" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Read File</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#write" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Write File</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#share" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Share File</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="read" role="tabpanel">
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>File</th>
                                                            <th>Share By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach ($readfile as $data){ ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="<?=baseURL?>/assets/uploads/<?php echo $data->file_path; ?>" target="_blank" class="btn btn-success waves-effect waves-light">View File</a></td>
                                                                <td><?php echo $data->full_name; ?></td>
                                                            </tr>
                                                        <?php $i++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="write" role="tabpanel">
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>File</th>
                                                            <th>Share By</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach ($writefile as $data){ ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="<?=baseURL?>/assets/uploads/<?php echo $data->file_path; ?>" target="_blank" class="btn btn-success waves-effect waves-light">View File</a></td>
                                                                <td><?php echo $data->full_name; ?></td>
                                                                <td>
                                                                    <button class="btn btn-danger waves-effect waves-light deletefile" type="button" data-id="<?php echo $data->file_id; ?>">
                                                                        <span class="fas fa-trash-alt"></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="share" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <form id="fileForm" enctype="multipart/form-data">
                                                            <h4 class="card-title-desc">Add form</h4>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4 mb-3">
                                                                            <label for="formFile" class="form-label">File</label>
                                                                            <input class="form-control" type="file" name="file" id="file">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label class="form-label">Share To</label><br>
                                                                            <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." name="shareto[]" id="shareto" style="width: 200px;">
                                                                                <?php foreach ($sharefileto as $index => $data){ ?>
                                                                                    <option value="<?php echo $data->id ?>"><?php echo $data->full_name ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-primary w-md float-end">Submit</button>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
			                                                        <div id="fileForm_error"></div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                $("#fileForm").submit(function(e)
                {
                    var $this=$(this);
                    $this.find('button').attr('disabled',true);
                    e.preventDefault();
                    $("#fileForm_error").html('<div class="alert alert-primary alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Please Wait......! </strong></div>');
                    $.ajax(
                    {
                        url: "<?=baseURLFILE?>/registerfile",
                        type: "POST",
                        data:  new FormData(this),contentType: false,cache: false,processData:false,success: function(data)
                        {
                            var result=JSON.parse(data);
                            if(result['status']=='success')
                            {
                                $("#fileForm_error").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Success! </strong>'+ result['message'] + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                window.setTimeout(function(){window.location.href = '<?=baseURLFILE?>/filelist.html';},2000)
                            }
                            else{
                                $("#fileForm_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Error! </strong>'+ result['message'] + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                $this.find('button').attr('disabled',false);
                            }
                        }
                    });
                });
            });
            $(document).on("click", ".deletefile", function(e)
			{
                e.preventDefault();
				$('#fileDelete_error').html('');
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
                            url:"<?=baseURLFILE?>/deletefile",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id":Id
                            },
                            success: function(response)
                            {
                                var result=JSON.parse(response);
                                if(result){
                                    if(result['status']=='success'){
										$("#fileDelete_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i><strong>Success! </strong> Your Data has been deleted <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						                window.setTimeout(function(){window.location.href = '<?=baseURLFILE?>/filelist.html';},2000)
                                    }else{
                                        $("#fileDelete_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Error! </strong> Something went wrong try again later <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                    }
                                }else{
									$("#fileDelete_error").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Error! </strong> Something went wrong try again later <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                }
                            }
                        });
					}else{
						$("#form_status").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="mdi mdi-alert-outline me-2"></i><strong>Cancelled! </strong> Your data is safe <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					}
                });
            });
        </script>
    </body>
</html>