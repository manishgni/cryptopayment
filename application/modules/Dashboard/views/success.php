
<div class="color-scheme-01">
    <!DOCTYPE HTML>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="HandheldFriendly" content="true" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo title; ?></title>
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <link href="<?php echo base_url('classic/register/'); ?>css/font-awesome.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url('classic/register/'); ?>css/all_Jworld.css?v=3.7" media="all">
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-1.12.1.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-migrate-1.4.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/CustomJScript.js?v=2.1"></script>
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
        color: #333;
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
        </head>
        <body>
            <div id="wrapper" class="joffice">

                <div id="main" >
                    <div class="">
                        <div class="row no-gutters">

                            <div class="col-12 col-md-6 columns" >
                                <div class="form-wrapper">
                                    <div class="page-header text-center">
                                        <img src="<?php echo base_url(logo); ?>" style="max-width: 160px;margin-bottom: 20px;padding: 15px;border-radius: 10px;margin: 0;">
                                        <h1 class="page-title">Thank you For Registration</h1>


                                        <?php
                                        echo'<h5 class="mainboxes" style="margin-top:15px">' . $message . '</h5>';
                                        ?>
                                        <div style="font-size:20px;font-weight: bold; margin-top:20px">Click Here to  <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"   style="color: #f95121;">Login</a></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.jqplot.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/excanvas.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.main.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/bootstrap.min.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/wz_tooltip.js"></script>
            </div>
        </body>
    </html>
</div>
