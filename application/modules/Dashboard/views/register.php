<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="<?php echo base_url('Assets/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <style>

        .form-wrapper {
            max-width: 520px;
            margin: 0 auto;
            padding: 20px 40px;
            background: #fff;
            box-shadow: 0px 0px 250px 0px rgba(69, 81, 100, 0.1);
        }

        .form-control {
            padding: 12px 20px;
            background-color: #f3f6ff;
            border: 0;
        }
        .form-group label {
            color: #354045;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 13px;
        }
        .btn {
            padding: 10px 15px;

        }
        .btn-gredient{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 0;
            color: #fff;
            padding: 15px 15px;
            font-size: 18px;
            line-height: 1.5;
            border-radius: 50px;
        }
        .btn-gredient:focus,
        .btn-gredient:active,
        .btn-gredient:hover{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 0;
        }
        .forgot-password{
            color: #575f84;
            font-weight: 600;
        }
        .columns{
            min-height: 100vh;display: flex;align-items: center;justify-content: center;
        }
        .page-title {
        background: #00B4DB;
        background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
        background: linear-gradient(to right, #d1373e, #d33b40);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
        .main-gredient{
            background: #00B4DB;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .book-content {
            position: absolute;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            align-content: center;
            display: flex;
            background: rgba(53, 169, 157,0.2);
        }
        .book-content-inner{
            padding: 30px;
            background: #fff;
            max-width: 450px;
        }

        .book-content-inner img {
            max-width: 100%;
            height: auto;
        }

        .clients-wrapper span{
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            height: 100px;
            border-radius: 10px;
            box-shadow: 0 0 2px rgba(0,0,0,0.14), 0 0 2px rgba(0,0,0,0.06);
            margin-bottom: 30px;
        }
        div#wrapper
        {

          background: url(https://s.marketwatch.com/public/resources/images/MW-GQ074_bitcoi_ZH_20180914072229.jpg);
          background-size:cover;
        }
        .small, small {
font-size: 80%;
font-weight: 400;
color: red;
}
.text-center {
text-align: center!important;
color: #fff;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
    color: #000000;
}
.Accept {
    color: #000;
    font-size: 12px;
}
select.form-control:not([size]):not([multiple]) {
    height: 45px;

}
    </style>

    <body>
        <div id="wrapper" class="joffice">
            <div id="main" class="main">
                <div class="">


                    <div class="row no-gutters">

                        <div class="col-12 col-md-12 columns">
                            <div class="form-wrapper">
                                <div class="page-header text-center">
                                    <img src="<?php echo base_url(logo); ?>" style="max-width: 160px;margin-bottom: 20px;padding: 15px;border-radius: 10px;margin: 0;">
                                    <h1 class="page-title">Registration Form</h1>
                                    <p class="small">You must be a Network member to be able to login!</p>
                                </div>

                                <div class="panel panel-primary">
                                    <!-- <h5><?php //echo title;   ?></h5> -->
                                    <span class="text-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </span>
                                    <?php echo form_open('Dashboard/User/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>
                                    <div class="form-group">
                                        <label for="Sponser ID">Sponser ID:</label>
                                        <input type="text" class="form-control" id="sponser_id" placeholder="Enter Sponser ID" value="<?php echo $sponser_id; ?>" name="sponser_id" required>
                                        <span class="text-danger"> <?php echo form_error('sponser_id'); ?></span>
                                        <span id="errorMessage" class="text-danger"> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Email:</label>
                                        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('email'); ?></span>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="pwd">Position:</label>
                                        <select class="form-control" name="position">
                                            <option value="L">LEFT</option>
                                            <option value="R">RIGHT</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="country">Country:</label>
                                        <select class="form-control" name="country" id="country">
                                            <?php
                                            foreach($countries as $key => $country)
                                                echo'<option value="'.$country['id'].'" '.(($country['id'] == 231) ? 'selected' : '').' data-countryCode="'.$country['phonecode'].'">'.$country['name'].'</option>';
                                            ?>
                                        </select>
                                    </div>
                                    <script>
                                        $(document).on('change','#country',function(){
                                            var countryCode = '+'+$("#country option:selected").attr('data-countryCode');
                                            $('#countryCode').val(countryCode)
                                        })
                                    </script>
                                    <div class="form-group">
                                        <label for="pwd">Phone:</label>
                                        <div class="row">
                                          <div class="col-md-4 col-xs-4">
                                        <input type="text" class="form-control" id="countryCode"  value="+1" readonly></div>
                                          <div class="col-md-8 col-xs-8"><input type="phone" class="form-control"  placeholder="Enter Phone" name="phone" value="<?php echo set_value('phone'); ?>" required></div>
                                        <span class="text-danger"> <?php echo form_error('phone'); ?></span>
                                      </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="pwd">PAN card:</label>
                                        <input type="text" class="form-control" placeholder="Enter Pan Card" name="pan" value="<?php echo set_value('pan'); ?>" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}"  required>
                                        <span class="text-danger"> <?php echo form_error('pan'); ?></span>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="text" class="form-control" placeholder="Enter Passowrd" name="password" value="<?php echo set_value('password'); ?>" required>
                                        <span class="text-danger"> <?php echo form_error('password'); ?></span>
                                    </div> -->
                                    <div class="Accept">
                                        <span>
                                            <input id="chTerms" name="chTerms" type="checkbox" required="required">
                                        </span>&nbsp;
                                        I have read the   <a style="cursor:pointer;color:red; font-size:16px" target="_blank" href="<?php echo base_url('Site/Main/content/terms');?>" target="_blank">Terms &amp; Conditions</a>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-gredient btn-block">Submit</button>
                                    </div>

                                    <?php echo form_close(); ?>
                                    <p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>
                                    <p>Have Account? <a href="<?php echo base_url('Dashboard/User/login'); ?>">Login Now</a></p>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <script>
            $(document).on('blur', '#sponser_id', function () {
                check_sponser();
            })
            function check_sponser() {
                var user_id = $('#sponser_id').val();
                if (user_id != '') {
                    var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
                    $.get(url, function (res) {
                        $('#errorMessage').html(res);
                    })
                }
            }
            check_sponser();
            $(document).on('submit', '#RegisterForm', function () {
                if (confirm('Please Check All The Fields Before Submit')) {
                    yourformelement.submit();
                } else {
                    return false;
                }
            })
        </script>
    </body>
</html>
