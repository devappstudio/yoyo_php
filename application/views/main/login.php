<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/19/16
 * Time: 8:10 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forms</title>

    <link href="<?php echo $assets ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?php echo $assets ?>css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form role="form" class="register_form" id="register_form">
                    <div class="ajax_message">

                    </div>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="autofocus">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <a href="#" onclick="login();" class="btn btn-primary">Login</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->



<script src="<?php echo $assets ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $assets ?>js/bootstrap.min.js"></script>
<script src="<?php echo $assets ?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url().'assets/' ?>jq/jquery-form.js"></script>
<script src="<?php echo base_url().'assets/' ?>jq/jquery.validate.min.js"></script>
<script src="<?php echo base_url().'assets/' ?>jq/form-validation-script.js"></script>
<script src="<?php echo base_url().'assets/' ?>jq/bootstrapValidator.js"></script>

<script>

    function  login()
    {

        var options = {
            target: '.ajax_message',
            type: "post",
            url: "<?php echo base_url();?>index.php/site/register",
            dataType: "json",
            cache: false,
            data: $('#register_form').serialize(),
            beforeSend: function () {
                $('.ajax_message').html('<div class="alert alert-success"><i class="fa fa-spinner fa-spin"></i><span>Please wait ... </span></div>');
            },
            success: function (data) {
                $('.ajax_message').empty();
                if (data.status == 'success') {
                    $(".ajax_message").html('');
                    $(".ajax_message").html('<div class="alert alert-success"><p><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Thank you, we will be in touch with you </p></div>').show().addClass('ajax_success');
                    console.log(data);

                } else if (data.status == 'error') {
                    console.log(data);
                    $(".ajax_message").html('<br/><div class=" alert alert-error "><p>' + data.error + "</p></div><br/>");
                }
            },
            error: function () {
                $(".ajax_message").html('<div class="alert alert-danger"><p><i class="fa fa-exclamation-circle"></i> Sorry An Error Occurred</p></div>');
            }

        };

        $('.register_form').ajaxSubmit(options);

    }

</script>
</body>

</html>

