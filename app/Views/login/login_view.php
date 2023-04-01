
<body>
<div class="container">
    <div class="jumbotron">
        <?= session('username') ?>
        <div class="row">
          
			
            <div class="col-md-4">
                <div class="well">
                    <h1 class="text-center login-title">Sign In</h1>

                    <div class="account-wall">
                        <form action="<?=base_url()?>/Login/login_submit" method="post" class="form-horizontal" name="save-team-form">
							<?= csrf_field() ?>
                            <input type="text" class="form-control" name="username" placeholder="User" required
                                   autofocus>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <br>

                            <div class="">
                                <input class="btn btn-primary btn-block" type="submit" value="submit" name="submit"/>
                                  
                            </div>

                            <a href="#" class="pull-right need-help well-sm">Need help? </a><span
                                class="clearfix"></span>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="well">
                    <br>
                    
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
