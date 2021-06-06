<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>eNova Interview Task</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=baseURLASSETS?>/images/favicon.ico">
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="<?=baseURLASSETS?>/libs/owl.carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?=baseURLASSETS?>/libs/owl.carousel/assets/owl.theme.default.min.css">
        <!-- Bootstrap Css -->
        <link href="<?=baseURLASSETS?>/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=baseURLASSETS?>/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=baseURLASSETS?>/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>
    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xl-4"></div>
                    <div class="col-xl-4">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="my-auto">
                                        <div>
                                            <h5 class="text-primary text-center">Welcome Back !</h5>
                                            <p class="text-muted text-center">Sign in to continue..</p>
                                        </div>
                                        <div class="mt-4">
                                            <form id="loginForm">
                                                <div class="mb-3">
                                                    <label for="user_id" class="form-label">User id</label>
                                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter user id">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>
                                                <div class="mt-3 d-grid">
										            <span style="color:red" id="login_error"></span>
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
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
        <!-- JAVASCRIPT -->
        <script src="<?=baseURLASSETS?>/libs/jquery/jquery.min.js"></script>
        <script src="<?=baseURLASSETS?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=baseURLASSETS?>/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=baseURLASSETS?>/libs/simplebar/simplebar.min.js"></script>
        <script src="<?=baseURLASSETS?>/libs/node-waves/waves.min.js"></script>
        <!-- owl.carousel js -->
        <script src="<?=baseURLASSETS?>/libs/owl.carousel/owl.carousel.min.js"></script>
        <!-- auth-2-carousel init -->
        <script src="<?=baseURLASSETS?>/js/pages/auth-2-carousel.init.js"></script>
        <!-- App js -->
        <script src="<?=baseURLASSETS?>/js/app.js"></script>
        <script>
            $(document).ready(function(){
                $("#loginForm").submit(function(e)
                {
                    var $this=$(this);
                    $this.find('button').attr('disabled',true);
                    e.preventDefault();
                    $.ajax(
                    {
                        url: "<?=baseURLUSER?>/login",
                        type: "POST",
                        data:  $(this).serialize(),success: function(response)
                        {
                            var result=JSON.parse(response);
                            if(result['status']=='success')
                            {
                                window.location=result['redirect_url'];
                            }
                            else
                            {
                                $('#login_error').html(result['message']);
                                $this.find('button').attr('disabled',false);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>