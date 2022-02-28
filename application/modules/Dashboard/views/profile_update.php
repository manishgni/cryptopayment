<?php
include_once 'header.php';
$userinfo = userinfo();
?>
<style>

    .flg img{
        width: 23px;
        position: relative;
        top: -1px;
        left: 9px;
    }

    #txt{
        position: relative;
        left: 10px;
        top: 1px;
    }


    .bcmp{
        margin-left: 30px;
    }

    #ImgBANKP{
        width: 300px;
        box-shadow: 0 0 1px 1px #d8cccc;
    }
    .radio input + label:after, .radio-inline input + label:after {
        content: '';
        position: absolute;
        width: 6px !important;
        height: 6px !important;
        top: 4px !important;
        left: 4px !important;
    }
    .btn-group-xs > .btn, .btn-xs {
        padding: 5px 20px;
        font-size: .85rem;
        line-height: 1.5;
        border-radius: .1875rem;
    }

    .fff a {
        display: inline-block;
        margin-right: 34px;
        font-size: 14px;
        color: #7870f8;
        font-weight: 600;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 600;
    }

    .profile-info-list > li {
        padding: .625rem 0;
        display: -webkit-box;
    }

    .profile-info-list > li .field {
        font-weight: 700;
        width: 20%;
    }

    .input-group-addon {
        background-color: #01a9ac;
        color: #fff;
    }

    .input-group-addon {
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.25;
        color: #495057;
        text-align: center;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: .25rem;
    }

    .input-group-addon:not(:last-child) {
        border-right: 0;
    }

    .input-group .form-control:not(:last-child), .input-group-addon:not(:last-child), .input-group-btn:not(:first-child) > .btn-group:not(:last-child) > .btn, .input-group-btn:not(:first-child) > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:not(:last-child) > .btn, .input-group-btn:not(:last-child) > .btn-group > .btn, .input-group-btn:not(:last-child) > .dropdown-toggle {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }











    @media (max-width: 768px) {
        .profile-header .profile-header-tab > li > a {
            display: block;
            color: #000;
            line-height: 1.25rem;
            padding: .625rem 13px;
            text-decoration: none;
            font-weight: 700;
            font-size: .75rem;
            border: none;
        }



        .profile-info-list > li .field {
            font-weight: 700;
            width: 37%;
        }

        #KYC .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
            width: 100%;
        }
    }

    @media (max-width: 767px) {
        #to-res {
            padding: 40px 0 10px 5px;
        }
        .mm-c {
            padding-left: 95px!important;
        }
        .profile-info-list {

            padding-top: 12px;
        }
        .profile-header .profile-header-tab>li {

            width: 100%;
            text-align: center;
        }
        .pndstsp{
            position: relative!important;
            right: 0px!important;
        }
        .pndstsa{
            position: relative!important;
            right: 0px!important;
        }


        #KYC .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
            width: 100%;
        }

        .content, .page-header-fixed.page-sidebar-fixed .content {
            margin-left: 0;
            padding: .9375rem .9375rem 3.6875rem;
            overflow: initial;
            height: auto;
            margin-top: 16px;
        }

        .table.table-profile .field {
            color: #666;
            font-weight: 600;
            width: 10%;
            text-align: left;
            font-size: 12px;
        }

        .table.table-profile .value span {
            font-size: 10px;
        }

        .fff a {
            display: inline-block;
            margin-right: 0;
            font-size: 14px;
            color: #7870f8;
            font-weight: 600;
        }
    }
</style>
<style>
    #header {
        height: 72px;
    }

    .side-padding {
        padding: 30px 0 0 0;
    }

    #page-container {
        padding-top: 4.10rem;
    }

    #mobile-logo {
        display: none;
    }

    @media only screen and (max-width: 767px) {
        #screen-logo {
            display: none;
        }

        .navbar-nav-list .nav.navbar-nav>li, .navbar-xs-justified .nav.navbar-nav>li {
            width: auto;
        }

        .diamond {
            padding: 12px 5px!important;
        }




        #mobile-logo {
            display: block;
        }

        .vertical-middle.ng-binding {
            font-size: 7px;
        }

        .verification-img img {
            width: 50px;
            position: relative;
            right: 4px !important;
        }

        .document-verify-step1.lead.mb0 {

            font-size: 14px;
        }

        .gtdtf {
            padding: 0px;
        }
        .wanki{
            position: relative;
            right: 0px!important;
            top: 0px!important;

        }
    }
</style>
<style>
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: 0;
        background: #fff;
        cursor: inherit;
        display: block;
    }

    .w100pc {
        width: 100%;
    }

    .btn:after {
        content: "";
        position: absolute;
        z-index: -1;
    }

    .btn-icon, .btn:after {
        transition: all .3s ease 0s;
    }

    .btn {
        transition: all .3s ease 0s !important;
        background-image: none !important;
        box-shadow: none !important;
        position: relative;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        user-select: none;
        border: 1px solid transparent;
    }

    .table {
        width: 100%;
        max-width: 100%;
    }

    .verification-img img {
        width: 50px;
        position: relative;
        right: 52px;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        height: 34px;
    }

    .form-control-sm, .input-group-sm > .form-control, .input-group-sm > .input-group-addon, .input-group-sm > .input-group-btn > .btn, .input-sm, select.form-control-sm:not([size]):not([multiple]), select.input-sm:not([size]):not([multiple]) {
        line-height: 1.875rem;
        height: 2.125rem;
    }

    .radio-inline {
        margin-left: 0px;
        padding: 0 24px 0 24px;
    }

    .tyomy {
        margin-left: 12px;
        margin-right: 12px;
    }

    .neds {
        font-size: 18px;
        color: black;
        font-weight: 400;
        padding-left: 13px;
        padding-right: 13px;
    }

    .panel {
        margin-bottom: 0px;&lt;li class="diamond"&gt;
        &lt;span id="txt" style="font-size:14px;font-weight: 500; color:#9B59B6;"&gt;
        &lt;/span&gt;
        &lt;/li&gt;
    }




    #default-modal input{
        margin-top: 5px;
    }

    .diamond {
        margin: 5px 0;
        padding: 8px 5px;
        border-radius: 19px;
    }
    .pndstsp{
        position: relative;
        right: 50px;
        top: 2px;
        color: red;
        font-weight: 600;
    }
    .pndstsa{
        position: relative;
        right: 50px;
        top: 2px;
        color: red;
        font-weight: green;

    }
    .wanki{
        position: relative;
        right: 52px;
        color: red;
        top: 8px;
    }
.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 220px;
    height: 220px;
    z-index: 0;
    position: absolute;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    width: 60px;
    height: 60px;
    z-index: 1;
    display:none;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<style type="text/css">.at-icon{fill:#fff;border:0}.at-icon-wrapper{display:inline-block;overflow:hidden}a .at-icon-wrapper{cursor:pointer}.at-rounded,.at-rounded-element .at-icon-wrapper{border-radius:12%}.at-circular,.at-circular-element .at-icon-wrapper{border-radius:50%}.addthis_32x32_style .at-icon{width:2pc;height:2pc}.addthis_24x24_style .at-icon{width:24px;height:24px}.addthis_20x20_style .at-icon{width:20px;height:20px}.addthis_16x16_style .at-icon{width:1pc;height:1pc}#at16lb{display:none;position:absolute;top:0;left:0;width:100%;height:100%;z-index:1001;background-color:#000;opacity:.001}#at_complete,#at_error,#at_share,#at_success{position:static!important}.at15dn{display:none}#at15s,#at16p,#at16p form input,#at16p label,#at16p textarea,#at_share .at_item{font-family:arial,helvetica,tahoma,verdana,sans-serif!important;font-size:9pt!important;outline-style:none;outline-width:0;line-height:1em}* html #at15s.mmborder{position:absolute!important}#at15s.mmborder{position:fixed!important;width:250px!important}#at15s{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABtJREFUeNpiZGBgaGAgAjAxEAlGFVJHIUCAAQDcngCUgqGMqwAAAABJRU5ErkJggg==);float:none;line-height:1em;margin:0;overflow:visible;padding:5px;text-align:left;position:absolute}#at15s a,#at15s span{outline:0;direction:ltr;text-transform:none}#at15s .at-label{margin-left:5px}#at15s .at-icon-wrapper{width:1pc;height:1pc;vertical-align:middle}#at15s .at-icon{width:1pc;height:1pc}.at4-icon{display:inline-block;background-repeat:no-repeat;background-position:top left;margin:0;overflow:hidden;cursor:pointer}.addthis_16x16_style .at4-icon,.addthis_default_style .at4-icon,.at4-icon,.at-16x16{width:1pc;height:1pc;line-height:1pc;background-size:1pc!important}.addthis_32x32_style .at4-icon,.at-32x32{width:2pc;height:2pc;line-height:2pc;background-size:2pc!important}.addthis_24x24_style .at4-icon,.at-24x24{width:24px;height:24px;line-height:24px;background-size:24px!important}.addthis_20x20_style .at4-icon,.at-20x20{width:20px;height:20px;line-height:20px;background-size:20px!important}.at4-icon.circular,.circular .at4-icon,.circular.aticon{border-radius:50%}.at4-icon.rounded,.rounded .at4-icon{border-radius:4px}.at4-icon-left{float:left}#at15s .at4-icon{text-indent:20px;padding:0;overflow:visible;white-space:nowrap;background-size:1pc;width:1pc;height:1pc;background-position:top left;display:inline-block;line-height:1pc}.addthis_vertical_style .at4-icon,.at4-follow-container .at4-icon{margin-right:5px}html>body #at15s{width:250px!important}#at15s.atm{background:none!important;padding:0!important;width:10pc!important}#at15s_inner{background:#fff;border:1px solid #fff;margin:0}#at15s_head{position:relative;background:#f2f2f2;padding:4px;cursor:default;border-bottom:1px solid #e5e5e5}.at15s_head_success{background:#cafd99!important;border-bottom:1px solid #a9d582!important}.at15s_head_success a,.at15s_head_success span{color:#000!important;text-decoration:none}#at15s_brand,#at15sptx,#at16_brand{position:absolute}#at15s_brand{top:4px;right:4px}.at15s_brandx{right:20px!important}a#at15sptx{top:4px;right:4px;text-decoration:none;color:#4c4c4c;font-weight:700}#at15sptx:hover{text-decoration:underline}#at16_brand{top:5px;right:30px;cursor:default}#at_hover{padding:4px}#at_hover .at_item,#at_share .at_item{background:#fff!important;float:left!important;color:#4c4c4c!important}#at_share .at_item .at-icon-wrapper{margin-right:5px}#at_hover .at_bold{font-weight:700;color:#000!important}#at_hover .at_item{width:7pc!important;padding:2px 3px!important;margin:1px;text-decoration:none!important}#at_hover .at_item.athov,#at_hover .at_item:focus,#at_hover .at_item:hover{margin:0!important}#at_hover .at_item.athov,#at_hover .at_item:focus,#at_hover .at_item:hover,#at_share .at_item.athov,#at_share .at_item:hover{background:#f2f2f2!important;border:1px solid #e5e5e5;color:#000!important;text-decoration:none}.ipad #at_hover .at_item:focus{background:#fff!important;border:1px solid #fff}.at15t{display:block!important;height:1pc!important;line-height:1pc!important;padding-left:20px!important;background-position:0 0;text-align:left}.addthis_button,.at15t{cursor:pointer}.addthis_toolbox a.at300b,.addthis_toolbox a.at300m{width:auto}.addthis_toolbox a{margin-bottom:5px;line-height:initial}.addthis_toolbox.addthis_vertical_style{width:200px}.addthis_button_facebook_like .fb_iframe_widget{line-height:100%}.addthis_button_facebook_like iframe.fb_iframe_widget_lift{max-width:none}.addthis_toolbox a.addthis_button_counter,.addthis_toolbox a.addthis_button_facebook_like,.addthis_toolbox a.addthis_button_facebook_send,.addthis_toolbox a.addthis_button_facebook_share,.addthis_toolbox a.addthis_button_foursquare,.addthis_toolbox a.addthis_button_linkedin_counter,.addthis_toolbox a.addthis_button_pinterest_pinit,.addthis_toolbox a.addthis_button_tweet{display:inline-block}.addthis_toolbox span.addthis_follow_label{display:none}.addthis_toolbox.addthis_vertical_style span.addthis_follow_label{display:block;white-space:nowrap}.addthis_toolbox.addthis_vertical_style a{display:block}.addthis_toolbox.addthis_vertical_style.addthis_32x32_style a{line-height:2pc;height:2pc}.addthis_toolbox.addthis_vertical_style .at300bs{margin-right:4px;float:left}.addthis_toolbox.addthis_20x20_style span{line-height:20px}.addthis_toolbox.addthis_32x32_style span{line-height:2pc}.addthis_toolbox.addthis_pill_combo_style .addthis_button_compact .at15t_compact,.addthis_toolbox.addthis_pill_combo_style a{float:left}.addthis_toolbox.addthis_pill_combo_style a.addthis_button_tweet{margin-top:-2px}.addthis_toolbox.addthis_pill_combo_style .addthis_button_compact .at15t_compact{margin-right:4px}.addthis_default_style .addthis_separator{margin:0 5px;display:inline}div.atclear{clear:both}.addthis_default_style .addthis_separator,.addthis_default_style .at4-icon,.addthis_default_style .at300b,.addthis_default_style .at300bo,.addthis_default_style .at300bs,.addthis_default_style .at300m{float:left}.at300b img,.at300bo img{border:0}a.at300b .at4-icon,a.at300m .at4-icon{display:block}.addthis_default_style .at300b,.addthis_default_style .at300bo,.addthis_default_style .at300m{padding:0 2px}.at300b,.at300bo,.at300bs,.at300m{cursor:pointer}.addthis_button_facebook_like.at300b:hover,.addthis_button_facebook_like.at300bs:hover,.addthis_button_facebook_send.at300b:hover,.addthis_button_facebook_send.at300bs:hover{opacity:1}.addthis_20x20_style .at15t,.addthis_20x20_style .at300bs{overflow:hidden;display:block;height:20px!important;width:20px!important;line-height:20px!important}.addthis_32x32_style .at15t,.addthis_32x32_style .at300bs{overflow:hidden;display:block;height:2pc!important;width:2pc!important;line-height:2pc!important}.at300bs{overflow:hidden;display:block;background-position:0 0;height:1pc;width:1pc;line-height:1pc!important}.addthis_default_style .at15t_compact,.addthis_default_style .at15t_expanded{margin-right:4px}#at_share .at_item{width:123px!important;padding:4px;margin-right:2px;border:1px solid #fff}#at16p{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABtJREFUeNpiZGBgaGAgAjAxEAlGFVJHIUCAAQDcngCUgqGMqwAAAABJRU5ErkJggg==);z-index:10000001;position:absolute;top:50%;left:50%;width:300px;padding:10px;margin:0 auto;margin-top:-185px;margin-left:-155px;font-family:arial,helvetica,tahoma,verdana,sans-serif;font-size:9pt;color:#5e5e5e}#at_share{margin:0;padding:0}#at16pt{position:relative;background:#f2f2f2;height:13px;padding:5px 10px}#at16pt a,#at16pt h4{font-weight:700}#at16pt h4{display:inline;margin:0;padding:0;font-size:9pt;color:#4c4c4c;cursor:default}#at16pt a{position:absolute;top:5px;right:10px;color:#4c4c4c;text-decoration:none;padding:2px}#at15sptx:focus,#at16pt a:focus{outline:thin dotted}#at15s #at16pf a{top:1px}#_atssh{width:1px!important;height:1px!important;border:0!important}.atm{width:10pc!important;padding:0;margin:0;line-height:9pt;letter-spacing:normal;font-family:arial,helvetica,tahoma,verdana,sans-serif;font-size:9pt;color:#444;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABtJREFUeNpiZGBgaGAgAjAxEAlGFVJHIUCAAQDcngCUgqGMqwAAAABJRU5ErkJggg==);padding:4px}.atm-f{text-align:right;border-top:1px solid #ddd;padding:5px 8px}.atm-i{background:#fff;border:1px solid #d5d6d6;padding:0;margin:0;box-shadow:1px 1px 5px rgba(0,0,0,.15)}.atm-s{margin:0!important;padding:0!important}.atm-s a:focus{border:transparent;outline:0;transition:none}#at_hover.atm-s a,.atm-s a{display:block;text-decoration:none;padding:4px 10px;color:#235dab!important;font-weight:400;font-style:normal;transition:none}#at_hover.atm-s .at_bold{color:#235dab!important}#at_hover.atm-s a:hover,.atm-s a:hover{background:#2095f0;text-decoration:none;color:#fff!important}#at_hover.atm-s .at_bold{font-weight:700}#at_hover.atm-s a:hover .at_bold{color:#fff!important}.atm-s a .at-label{vertical-align:middle;margin-left:5px;direction:ltr}.at_PinItButton{display:block;width:40px;height:20px;padding:0;margin:0;background-image:url(//s7.addthis.com/static/t00/pinit00.png);background-repeat:no-repeat}.at_PinItButton:hover{background-position:0 -20px}.addthis_toolbox .addthis_button_pinterest_pinit{position:relative}.at-share-tbx-element .fb_iframe_widget span{vertical-align:baseline!important}#at16pf{height:auto;text-align:right;padding:4px 8px}.at-privacy-info{position:absolute;left:7px;bottom:7px;cursor:pointer;text-decoration:none;font-family:helvetica,arial,sans-serif;font-size:10px;line-height:9pt;letter-spacing:.2px;color:#666}.at-privacy-info:hover{color:#000}.body .wsb-social-share .wsb-social-share-button-vert{padding-top:0;padding-bottom:0}.body .wsb-social-share.addthis_counter_style .addthis_button_tweet.wsb-social-share-button{padding-top:40px}.body .wsb-social-share.addthis_counter_style .addthis_button_facebook_like.wsb-social-share-button{padding-top:21px}@media print{#at4-follow,#at4-share,#at4-thankyou,#at4-whatsnext,#at4m-mobile,#at15s,.at4,.at4-recommended{display:none!important}}@media screen and (max-width:400px){.at4win{width:100%}}@media screen and (max-height:700px) and (max-width:400px){.at4-thankyou-inner .at4-recommended-container{height:122px;overflow:hidden}.at4-thankyou-inner .at4-recommended .at4-recommended-item:first-child{border-bottom:1px solid #c5c5c5}}</style>
<style type="text/css">.at-branding-logo{font-family:helvetica,arial,sans-serif;text-decoration:none;font-size:10px;display:inline-block;margin:2px 0;letter-spacing:.2px}.at-branding-logo .at-branding-icon{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAMAAAC67D+PAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////+GlNUkcc1QAAAB1JREFUeNpiYIQDBjQmAwMmkwEM0JnY1WIxFyDAABGeAFEudiZsAAAAAElFTkSuQmCC")}.at-branding-logo .at-branding-icon,.at-branding-logo .at-privacy-icon{display:inline-block;height:10px;width:10px;margin-left:4px;margin-right:3px;margin-bottom:-1px;background-repeat:no-repeat}.at-branding-logo .at-privacy-icon{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAKCAMAAABR24SMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABhQTFRF8fr9ot/xXcfn2/P5AKva////////AKTWodjhjAAAAAd0Uk5T////////ABpLA0YAAAA6SURBVHjaJMzBDQAwCAJAQaj7b9xifV0kUKJ9ciWxlzWEWI5gMF65KUTv0VKkjVeTerqE/x7+9BVgAEXbAWI8QDcfAAAAAElFTkSuQmCC")}.at-branding-logo span{text-decoration:none}.at-branding-logo .at-branding-addthis,.at-branding-logo .at-branding-powered-by{color:#666}.at-branding-logo .at-branding-addthis:hover{color:#333}.at-cv-with-image .at-branding-addthis,.at-cv-with-image .at-branding-addthis:hover{color:#fff}a.at-branding-logo:visited{color:initial}.at-branding-info{display:inline-block;padding:0 5px;color:#666;border:1px solid #666;border-radius:50%;font-size:10px;line-height:9pt;opacity:.7;transition:all .3s ease;text-decoration:none}.at-branding-info span{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.at-branding-info:before{content:'i';font-family:Times New Roman}.at-branding-info:hover{color:#0780df;border-color:#0780df}</style>
<script type="text/javascript" charset="utf-8" async="" src="./My Profile_files/counter.1e8689847c822d3197cd.js.download"></script>
<style type="text/css">.addthis_counter{font-weight:700;display:inline-block;border:0;outline:0;cursor:pointer;color:#fff}.addthis_counter a{display:block;font-family:arial,helvetica,sans-serif!important;text-decoration:none!important;border:0}.addthis_counter{text-decoration:none!important;text-align:left}.addthis_counter .addthis_button_expanded{background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAACaCAMAAADcrusAAAAA21BMVEX////+bUznWjrnWjrBwcGJiYnm5ubFxcWMjIyRkZH39/f19fX////nWjr+bUzys6n+uq7/7+z87evqd2H+hm3/5+P+sKPxqJz65OH/9/b+el3paU//zcT2yMDshXH99vX+kXz+nIn/w7n0vrX30cz9bEv/3tn529f/1s/ukYH3aUn+ppbvnY/bUjTmWTn/3dX+9fP3aEj/9vT52NH/5d/aUTP9a0r74tzlWDjfWz386+f/7en4b1H/7uv4b1D/3db/9/X/7uraUjT+9vT87Oj87OnpZEb52dH+dlezszuQAAAABHRSTlMAExMAzBw6IQAAAnlJREFUeF6009eKKzEMBuBJriW5T2/pPdvbqb28/xMdGbOQiyxZZ9n/QnjAH8KWJxl8uqeI3H8ZJFcUmatkFktmCUXnXHIBIRevJ/AcBuUSQI0onZ8k1/QxkNqVJIvyNPl8S1/ZMFkuuYxtqhQoS2MA1RNIGKUArjwk/4Lk0jtXp0QpjEjJHiw5SbzZQlo6eUi+fafba0985LKwqSOqJdNaMdmQ5O+NOn6WYsNlPk7nnvRF6iF3lOBz/MZqZ6kvZCBS+bUn1h/MvTCXmumYArEKijlYJr6N6t8y/fcn5zz+dfwvNlhH9ZmtB8nw6REj8vg0TO4wMnfJPpbsE4zOueQGQm5eT+A5DKopgF5htjhJLvFDIE1eoeiq0+T3A/5lw2Q65TIxmdagDU4AdIsgYJUB5NUh+RMklzbPmwwxgxVq0YLBXCBvNpBVuTgkP3/hw6UnPmLamSxHbATTRjPZouDvrT5+lm7LZTHJFp60XeYhdxTgc/zGmtxg24lAhPZrT4w/WP7CXBqmEwzEaOgWYJj4Nrp9y/Tfn5zz+Hex5Ecy3EX12e+G/9mrQxUAYBgGooEFAm3//3snZmviJnL+6cMRrXSgHqsWOGb8iISEhISEqDxRAsSld5De/nLbr4MViEEYDMI5mFQ3ff/nXejx33YHcyqtc/8QQSXaRYfJZpAaFWx2FdwfMXyqYdYjp4punpP5fcgiiyyyyCKVl9+6nxQHCP+t20WHCTdIjQo2KjgDAT/Y7UQk/li1tkPtyaQlEhBARABBUV+lvhc1rz4w+FX4bKWLrA0cp7Ue+KhqnpA/mXggAQFEBBAU9VXqe1HzzgNTv2Iyx9Dc8gWOjkKMG1wfQQAAAABJRU5ErkJggg==");background-repeat:no-repeat;display:inline-block}.addthis_counter .atc_s{background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUBAMAAAB/pwA+AAAAFVBMVEUAAAD///////////////////////9Iz20EAAAABnRSTlMAwPm7kB4+mBDvAAAAP0lEQVQI12MIVksDgyRTBrM0KEhmAApChRnS4ACdKcCIl5ko6MAiKAZmJjAAARsKE6GAsGE43IBwJLLTER4CAHvvQkc3Hji8AAAAAElFTkSuQmCC");background-size:10px;background-repeat:no-repeat;background-color:#fe6d4c;background-position:5px 5px;display:inline-block;border-radius:2px;min-width:25px;text-decoration:none}.addthis_counter .atc_s:hover{background-color:#e75a3a}.addthis_counter.addthis_bubble_style{background-image:url("data:image/gif;base64,R0lGODlhUgBkAKIEAOrq6sLCwoWFhf///////wAAAAAAAAAAACH5BAEAAAQALAAAAABSAGQAAAP/SLoa/jDKSetkOGsdwPhgKI5kaYpAsK1sd75wPKZsjQVyrpuq7eO7YLDnqwGFyBixuDomn6UlkwOtkqTTm3ULwmYXTi7U+3WJreSp+VxNF9fs8ZcBjz/dRo8dPSfU90l4TXqAcn1/hTuCLYSJQ31gjY45i3mTipB0kpcnlTZhnDyZdKFKo2ClMJ5GqS+rLa2dpw2xorOgtR+vg7kou7y9AzSzYBbGx8gRxAwCzc7P0NHS09TSywoCm60AAsvZwSDcxALgId2z5OUf56fp6uyj7uXwmfLg9JD2wfh9+r38X76pGwBwisCBBYscRFhP2718Dh/OWThwXb+IEidi/New+SKIhD4ozmu3sRVIhSVLnVRYcWXIluNgopPZjmY8m/VwQlQnblxKRz29VRtKtCg0YsmSOsBgtGmzNz9zDCMgEkpQWGyI+KuyElebBVuhdI2jNc5JRF+pRtUBEu3XqlYSum0DNy6jPQHqcrVEVq2ds2spYQssY2xWsGZ/9MWW+NNiqo35cpmqV8jVFkqTMXVqlEnmz1I4i4Y3twplwjqCehVTthC71VxaA3qdSPYe2oVs/0WVG7HrBqgx+f1deouKylsEFDeOPPlyNM3tPpcTXSzw2oMT4QakOzJs475n8+Ye/vZ4vOV30+rN+Pf1PacBXQWdefPopgQSAAA7");background-repeat:no-repeat}.addthis_counter a.atc_s{font-size:11px;font-weight:100;color:#fff;padding:0 5px 0 20px;line-height:20px;overflow:hidden;cursor:pointer;transition:none}.addthis_counter .atc_s-span,.addthis_counter a.atc_s{display:block;height:20px}.addthis_counter .addthis_button_expanded.at300m .at4-icon{display:none!important}.addthis_counter a.addthis_button_expanded:hover,.addthis_counter.addthis_pill_style a.addthis_button_expanded:hover{text-decoration:none;color:#000}.addthis_counter .addthis_button_expanded{display:block;background-repeat:no-repeat;background-position:0 -40px;width:50px;height:33px;line-height:33px;padding-bottom:4px;margin-bottom:3px;text-align:center;text-decoration:none;font-size:1pc;font-weight:700;color:#333}.addthis_counter{vertical-align:top}.addthis_counter.addthis_native_counter .addthis_button_expanded{font-weight:400}* html .addthis_counter.compatmode0 .addthis_button_expanded{padding-bottom:0!important}* html .addthis_counter .addthis_button_expanded{height:37px}.addthis_counter .addthis_button_expanded:hover{background-position:0 -77px;cursor:pointer;color:#000}.addthis_counter .addthis_button_expanded .at300bs{display:none!important}.addthis_counter.addthis_pill_style{display:block;height:25px;overflow:hidden}.addthis_counter.addthis_pill_style a.atc_s{float:left}.addthis_counter.addthis_pill_style a.addthis_button_expanded{display:none;background-repeat:no-repeat;background-position:0 -114px;width:34px!important;height:20px;line-height:20px;margin:0 0 0 3px;padding:0 0 0 4px;float:left;text-align:center;text-decoration:none;font-family:arial,helvetica,sans-serif;font-weight:700;font-size:11px;color:#333;-ms-box-sizing:content-box;-o-box-sizing:content-box;box-sizing:content-box}.addthis_counter.addthis_pill_style.addthis_nonzero a.addthis_button_expanded{display:block!important;transition:none}.addthis_counter.addthis_pill_style a.addthis_button_expanded:hover{background-position:0 -134px!important}.addthis_counter.addthis_bubble_style{margin:0 0 0 -2px;text-align:center;font-weight:700;font-family:arial,helvetica,sans-serif;color:#000;background-repeat:no-repeat;background-position:0 -4pc;padding:0 0 0 4px;height:1pc;width:2pc!important;-ms-box-sizing:content-box;-o-box-sizing:content-box;box-sizing:content-box}.addthis_native_counter_parent .addthis_counter.addthis_bubble_style{background-position:0 -4pc!important}.addthis_counter.addthis_bubble_style.addthis_native_counter{margin:0 2px}.addthis_counter.addthis_bubble_style a.addthis_button_expanded{font-size:11px;height:1pc;line-height:1pc;width:34px;background:none}.addthis_counter.addthis_bubble_style:hover{background-position:-36px -4pc!important}.addthis_20x20_style .addthis_counter.addthis_bubble_style{background-repeat:no-repeat;background-position:0 -5pc!important;height:20px;width:35px!important;line-height:20px;padding:0 0 0 6px}.addthis_20x20_style .addthis_counter.addthis_bubble_style:hover{background-position:-41px -5pc!important}.addthis_20x20_style .addthis_counter.addthis_bubble_style a.addthis_button_expanded{background:none;font-size:9pt;line-height:20px;height:20px;margin:0;width:35px!important;padding:0!important}.addthis_20x20_style .addthis_counter.addthis_bubble_style.addthis_native_counter a.addthis_button_expanded{font-size:11px}.addthis_32x32_style .addthis_counter.addthis_bubble_style,.addthis_32x32_white_style .addthis_counter.addthis_bubble_style{background-repeat:no-repeat;background-position:0 0!important;height:2pc;width:56px!important;line-height:2pc;padding:0 0 0 6px}.addthis_32x32_style .addthis_counter.addthis_bubble_style a.addthis_button_expanded,.addthis_32x32_white_style .addthis_counter.addthis_bubble_style a.addthis_button_expanded{background:none;font-size:1pc;line-height:2pc;height:2pc;margin:0;width:56px!important;padding:0!important}.addthis_32x32_style .addthis_counter.addthis_bubble_style:hover,.addthis_32x32_white_style .addthis_counter.addthis_bubble_style:hover{background-position:0 -2pc!important}.addthis_counter.addthis_bubble_style .atc_s{display:none!important}* html .addthis_counter.addthis_bubble_style{width:36px!important;display:inline}* html .addthis_counter.bubblecompatmode0{width:2pc!important;display:block}* html .addthis_counter.addthis_bubble_style a.addthis_button_expanded{width:24px!important;height:14px!important;line-height:14px!important;padding:0;margin-top:1px!important;display:inline}* html .addthis_counter.bubblecompatmode0 a.addthis_button_expanded{width:36px}* html .addthis_32x32_style .addthis_counter.addthis_bubble_style{width:60px!important}* html .addthis_32x32_style .addthis_counter.addthis_bubble_style a.addthis_button_expanded{width:46px;height:26px!important;line-height:26px!important;margin-top:2px!important}* html .addthis_32x32_style .addthis_counter.bubblecompatmode0 a.addthis_button_expanded{height:2pc!important;line-height:2pc!important}</style>
<script charset="utf-8" src="./My Profile_files/button.550007e6cc79c00bac51111d8131d860.js.download"></script>
<style type="text/css">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
    .fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_button{text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
    .fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}</style>

    <style>
    .profile-header {
        position: relative;
        overflow: hidden;
    }
    .profile-header .profile-header-cover {
    background: url(../img/profile-cover.jpg) center no-repeat;
    background-size: 100% auto;

    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.profile-header .profile-header-cover:before {
    content: '';

    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, .25) 0, rgba(0, 0, 0, .85) 100%);
}
.profile-header .profile-header-content {
    color: #fff;
    padding: 1.25rem;
    background: darkcyan;
}
.profile-header-img {
    float: left;
    width: 7.5rem;
    height: 7.5rem;
    overflow: hidden;
    z-index: 10;
    margin: 0 1.25rem -1.25rem 0;
    padding: .1875rem;
    -webkit-border-radius: .25rem;
    -moz-border-radius: .25rem;
    border-radius: .25rem;
    background: #fff;
}
.profile-header-info h4 {
    font-weight: 500;
    margin-bottom: .3125rem;
}
.m-b-sm {
    margin-bottom: .625rem!important;
}
.profile-header .profile-header-tab {
    background: #fff;
    list-style-type: none;
    margin: -1.25rem 0 0;
    padding: 0 0 0 8.75rem;
    border-bottom: 1px solid #C8C7CC;
    white-space: nowrap;
}
.profile-header .profile-header-tab>li {
    display: inline-block;
    margin: 0;
}
.profile-header .profile-header-tab>li>a {
    display: block;
    color: #000;
    line-height: 1.25rem;
    padding: .625rem 1.25rem;
    text-decoration: none;
    font-weight: 700;
    font-size: 16px;
    border: none;
}
.profile-container {
    padding: 1.5625rem;
    background: #eaeaea;
}
.post {
    background: #fff;
    padding: .9375rem;
    -webkit-border-radius: .1875rem;
    -moz-border-radius: .1875rem;
    border-radius: .1875rem;
    margin: 0 auto .9375rem;
}
.tab-content>.tab-pane {

    background: #fff;
    padding: 20px;
}
.profile-header-img img{
max-width: 100%;


}
@media (max-width: 767px) {
.table.table-profile .value span {
    font-size: 14px;
}
.profile-header .profile-header-tab {

    margin: 0px;
    padding: 0px;

}
}
    </style>
<div class="content-wrapper">

  <div id="content" class="content p-0">
      <!-- BEGIN profile-header -->
      <div class="profile-header">
          <!-- BEGIN profile-header-cover -->
          <div class="profile-header-cover"></div>
          <!-- END profile-header-cover -->
          <!-- BEGIN profile-header-content -->
          <div class="profile-header-content" id="to-res">
              <!-- BEGIN profile-header-img -->
              <div class="profile-header-img" id="prof_pic">
                  <img src="https://previews.123rf.com/images/jly19/jly191704/jly19170400115/76875196-avatar-men-design-men-icon-vector-illustration.jpg" alt="user">
              </div>
              <!-- END profile-header-img -->
              <!-- BEGIN profile-header-info -->
              <div class="profile-header-info">
                  <h4 class="m-t-sm" id="txtFirstName">Name : <?php echo $userinfo->name;?></h4>
                  <p class="m-b-sm" id="txtEmailid">email : <?php echo $userinfo->email;?></p>
                  <!--	<a href="#" class="btn btn-xs btn-primary">Change Profile</a>-->
                  <a href="#" data-toggle="modal" class="btn btn-sm btn-primary">Change Picture</a>
              </div>
              <!-- END profile-header-info -->
          </div>
          <!-- END profile-header-content -->
          <!-- BEGIN profile-header-tab -->
          <ul class="profile-header-tab nav nav-tabs" role="tablist">
              <li class="nav-item" id="T1">
                  <a id="T21" class="nav-link active" data-toggle="tab" href="#ACCOUNT-DETAILS" role="tab">USER PROFILE</a>
              </li>
              <li class="nav-item" id="T2">
                  <a id="T22" class="nav-link" data-toggle="tab" href="#E-CURRENCY-ACCOUNT" role="tab">BTC ACCOUNT</a>
              </li>
              <li class="nav-item" id="T3">
                  <a id="T23" class="nav-link" data-toggle="tab" href="#RESET-PASSWORD" role="tab">RESET PASSWORD</a>
              </li>
              <li class="nav-item" id="T5">
                  <a id="T25" class="nav-link" data-toggle="tab" href="#KYC" role="tab"  style="display:none;">KYC VERIFICATION</a>
              </li>
              <li class="nav-item" id="T4">
                  <a id="T24" class="nav-link" data-toggle="tab" href="#REFERRAL-LINK" role="tab">REFERRAL LINK</a>
              </li>
          </ul>
          <!-- END profile-header-tab -->
      </div>
      <!-- END profile-header -->
      <!-- BEGIN profile-container -->
      <div class="profile-container">
          <!-- BEGIN row -->
          <div class="row row-space-20">
              <!-- BEGIN col-8 -->
              <div class="col-md-8">
                  <!-- BEGIN tab-content -->
                  <div class="tab-content p-0">
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane  " id="REFERRAL-LINK">
                          <div class="post">
                              <div class="post-content" id="sharethis">
                                  <!-- BEGIN panel -->
                                  <div class="panel panel-default">
                                      <!-- BEGIN panel-heading -->
                                      <div class="panel-heading">
                                          <h4 class="panel-title">Deal with us via given  below link </h4>
                                          <p class="desc" id="RefLink102">
                                              <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" target="_blank">Click Link</a>
                                          </p>
                                      </div>
                                      <!-- END panel-heading -->
                                      <!-- BEGIN panel-body -->
                                      <div class="panel-body">
                                          <div class="row">
                                              <!--  <p><span  id="ref_clickr" style="font-size: 15px;"></span></p> -->
                                              <!----------fb-links--------------->
                                              <div class="fb-section">
                                                  <div class="addthis_toolbox addthis_default_style" addthis:url="" addthis:title="We are professionally engaged in cryptocurrencies mining and trading and have a large experience of the investment industry.&quot; /">
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-12">
                                                              <a class="addthis_button_facebook_like  at300b" fb:''like:''layout="button_count">
                                                                 <div class="fb-like fb_iframe_widget" data-layout="button_count" data-show_faces="false" data-share="false" data-action="like" data-width="90" data-height="25" data-font="arial" data-href="" data-send="false" style="height: 25px;">
                                                                      <span style="vertical-align: bottom; width: 0px; height: 0px;">
                                                                          <iframe name="f35fe8d0ab72a28" width="90px" height="25px" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="./My Profile_files/like.html" class="" style="border: none; visibility: visible; width: 0px; height: 0px;"></iframe>
                                                                      </span>
                                                                  </div>
                                                              </a>
                                                              <a class="addthis_button_tweet at300b">
                                                                  <div class="tweet_iframe_widget" style="width: 62px; height: 25px;">
                                                                      <span>
                                                                          <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" title="Twitter Tweet Button" src="./My Profile_files/tweet_button.69e02060c7c44baddf1b5629549acc0c.en.html" data-url="" style="position: static; visibility: visible; width: 1px; height: 1px;"></iframe>
                                                                      </span>
                                                                  </div>
                                                              </a>
                                                          </div>
                                                          <div class="col-sm-6 col-md-12 fff">
                                                              <div class="row">
                                                                  <div class="col-sm-6 col-md-12">
                                                                        <input type="text" id="linkTxt" value="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" class="form-control">
                                                                        <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                                                            <i class="ti-export f-s-14 pull-left m-r-5"></i>Click here to copy referral link
                                                                        </button>
                                                                  </div>
                                                                  <div class="col-sm-6 col-md-12">
                                                                      <span id="addnewuser2">
                                                                          <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" target="_blank">
                                                                              <i class="ti-link"></i>Add one more user
                                                                          </a>
                                                                      </span>
                                                                      <!--<a href="#" target="_blank" id="ref_click"><i class="ti-link  f-s-14 pull-left m-r-5"></i><span id="RefLink1" >Add one more user </a></span>-->
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="atclear"></div>
                                                  </div>
                                                  <script type="text/javascript" src="./My Profile_files/addthis_widget.js.download"></script>
                                              </div>
                                              <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bb4c0eae2bd7243"></script>-->
                                              <!----------fb-links-ens--------------->
                                          </div>
                                      </div>
                                      <!-- END panel-body -->
                                  </div>
                                  <!-- end panel -->
                              </div>
                          </div>
                      </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                        <div class="tab-pane active" id="ACCOUNT-DETAILS">
                            <div class="post">
                                <?php echo form_open(base_url('Dashboard/User/Profile'),array('class' => 'pswrdrst'));?>
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan="2">MY PERSONAL INFORMATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Contact Number</td>
                                            <td class="value">
                                                <input type="number" class="form-control" value="<?php echo $userinfo->phone;?>" name="phone">
                                                <!-- <span id="txtMobileNo"></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Email</td>
                                            <td class="value">
                                                <input type="email" class="form-control" value="<?php echo $userinfo->email;?>" name="email">
                                                <!-- <span id="Emailid"><?php echo $userinfo->email;?></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">City</td>
                                            <td class="value">
                                                <input type="text" class="form-control" value="<?php echo $userinfo->city;?>" name="city">
                                                <!-- <span id="txtCity"></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Registration Date</td>
                                            <td class="value">
                                                <span id="signon"><?php echo $userinfo->created_at;?> </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Activation Date</td>
                                            <td class="value">
                                                <span id="Activeon"><?php echo $userinfo->topup_date;?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Status</td>
                                            <td class="value">
                                                <span id="sts">
                                                <?php echo $userinfo->package_id > 0 ? 'Active' : 'Free';?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field"></td><td class="value">
                                                <button class="btn btn-xs btn-primary" >Update</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <?php echo form_close();?>
                            </div>
                            <!--	 <div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title">2 FA Code</h4></div><div class="panel-body"><p class="desc"></p><form  action="#"><div class="input-group form-group"><span class="input-group-addon"><input type="checkbox" id="myCheck" onclick="getmsgbns()" ></span><input type="text" class="form-control" disabled="true" placeholder="Please click on check box for enable 2 factor athentication "></div><div id="fmsg"  style="display:none"><div class="alert alert-danger  m-b-10"><strong>Sorry !</strong> We are working on 2 factor athentication try later!</div></div></form></div></div>-->
                        </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                        <div class="tab-pane" id="E-CURRENCY-ACCOUNT">
                            <div class="panel panel-default">
                                <!-- BEGIN panel-heading -->
                                <div class="panel-heading">

                                    <div class="row">
                                        <select class="form-control" id="bnktoggle">
                                            <option>BTC</option>
                                            <!-- <option>Bank Details</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p class="desc"></p>
                                    <?php echo form_open_multipart(base_url('Dashboard/user/BankDetails'),array('id' =>'bankform','style' =>'display:none;'));?>
                                        <h4 class="panel-title text-center">BANK ACCOUNT</h4>
                                        <div class="card-block">
                                            <div id="edit-contact-info" class="row" style="">
                                                <div class="form-group col-md-12">
                                                    <label class="col-md-12">Choose Account Type
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <select class="form-control form-control-line" name="account_type" id="ddlAccType" required="">
                                                            <option value="">Choose Account Type</option>
                                                            <option value="saving"  <?php echo $user_bank->account_type == 'saving' ? 'selected' : '' ;?>>Saving Account</option>
                                                            <option value="current" <?php echo $user_bank->account_type == 'current' ? 'selected' : '' ;?>>Current Account</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-md-12">A/c Name
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-line"  value="<?php echo $user_bank->account_holder_name;?>" name="account_holder_name" placeholder="Account holder name" id="txtAccFName" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="example-email" class="col-md-12"> Bank Name
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-md-12">
                                                            <select class="form-control form-control-line" name="bank_name" id="txtBakName" required="">
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-md-12">A/c No
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control form-control-line"  value="<?php echo $user_bank->bank_account_number;?>" placeholder="Account number" name="bank_account_number" id="txtAccountNo" maxlength="16" required="" >
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-sm-12">IFSC Code
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control form-control-line" value="<?php echo $user_bank->ifsc_code;?>" name="ifsc_code" placeholder="Bank IFS Code" id="txtIFSCode" maxlength="11" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" >
                                                    <label class="col-sm-12">Pan Card
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control form-control-line" name="pan" placeholder="Update PAN Number from KYC Section" value="<?php echo $user_bank->pan;?>" id="txtPanCard" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div id="ifscdt"></div>
                                                </div>
                                                <!--<div class="form-group col-sm-11" style="margin-left:36px;border-top: 1px solid #ccc;"></div>-->
                                                <div class="form-group col-md-6">
                                                    <label class="col-sm-12">Upload Bank Account Proof
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="File" id="bankFileuplaod" name="userfile">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p style="    color: green;    font-size: 12px;    font-weight: 600;">
                                                                <i class="mdi mdi-arrow-right"></i>Maximum File size 500 KB.Only GIF,JPG, JPEG, PNG, files are allowed !
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <img id="ImgBANKP" src="<?php echo base_url('uploads/'.$user_bank->passbook_image)?>" alt="Bank Proof">
                                                    </div>
                                                </div>
                                                <div class=" form-group col-md-12 text-center m-t-20">
                                                    <div class="loader">
                                                    </div>
                                                    <?php
                                                    if($user_bank->kyc_status != 2)
                                                        echo'<button class="btn btn-primary active m-r-20">Save</button>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                    <?php echo form_open_multipart(base_url('Dashboard/user/btc_update'),array('id' =>'btcForm' ,'style' =>'display:block;','class' => 'pswrdrst'));?>
                                        <h4 class="panel-title text-center">BTC Account</h4>
                                        <div class="card-block">
                                            <div id="edit-contact-info" class="row" style="">
                                                <div class="form-group col-md-12">
                                                    <label class="col-md-12">BTC No
                                                        <span class="text-c-pink">*</span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-line"  value="<?php echo $user_bank->btc;?>" placeholder="BTC" name="btc" required="" >
                                                    </div>
                                                </div>
                                                <div class=" form-group col-md-12 text-center m-t-20">
                                                    <div class="loader">
                                                    </div>
                                                    <?php
                                                    if($user_bank->btc == '')
                                                        echo'<button class="btn btn-primary active m-r-20">Save</button>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                                <!-- END panel-body -->
                            </div>
                        </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane " id="RESET-PASSWORD">
                          <!-- BEGIN panel -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">LOGIN PASSWORD</h4>
                                </div>
                                <div class="panel-body">
                                    <p class="desc"></p>
                                        <?php echo form_open(base_url('Dashboard/User/password_reset'),array('class' => 'pswrdrst'));?>
                                        <div class="form-group">
                                            <label for="txtoldpass">Old Password</label>
                                            <input type="password" class="form-control" name="cpassword" autofocus="" maxlength="20" placeholder="Enter Your Old Password" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtnewpass">New Password</label>
                                            <input type="password" class="form-control" name="npassword" maxlength="20" required="" placeholder="Enter Your New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtnewpass">Confirm New Password</label>
                                            <input type="password" class="form-control"  name="vpassword" maxlength="20" required="" placeholder="Enter Your New Password">
                                        </div>
                                        <div id="SLgPWD"></div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        <?php echo form_close();?>
                                </div>
                            </div>
                          <!-- end panel -->
                          <div class="panel panel-default">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title">TRANSACTION PASSWORD</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body">
                                    <p class="desc"></p>
                                    <?php echo form_open(base_url('Dashboard/User/trans_password'),array( 'class' => 'pswrdrst'));?>
                                    <div class="form-group">
                                        <label for="txtoldpass">Old Password</label>
                                        <input type="password" class="form-control" name="cpassword" autofocus="" maxlength="20" placeholder="Enter Your Old Password" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtnewpass">New Password</label>
                                        <input type="password" class="form-control" name="npassword" maxlength="20" required="" placeholder="Enter Your New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtnewpass">Confirm New Password</label>
                                        <input type="password" class="form-control"  name="vpassword" maxlength="20" required="" placeholder="Enter Your New Password">
                                    </div>
                                    <div id="SLgPWD"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    <?php echo form_close();?>
                              </div>
                              <!-- END panel-body -->
                          </div>
                      </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane " id="KYC" style="display:none;">
                          <!-- BEGIN panel -->
                          <div class="panel panel-default">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title">KYC VERIFICATION</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body gtdtf">
                                  <!-- BEGIN file-upload-form -->
                                      <div ui-view="" class="">
                                          <!-- uiView:  -->
                                          <div ui-view="" class="fade-in-up ng-scope">
                                              <div class="container-fluid my-documents-page">
                                                  <div class="row">
                                                      <div class="col-sm-12">
                                                          <div class="lead">
                                                              Verify your Identity and Proof of Residence in order to activate your account and get access to all areas of Amoyo.
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="row ng-scope " data-ng-controller="VerifyProfileDocStatusCtrl">
                                                      <div class="col-xs-12">
                                                          <div class="panel-white panel">
                                                              <div class="panel-body pt5 pb5">
                                                                  <div class="row">
                                                                      <div class="col-xs-12">
                                                                            <?php echo form_open_multipart(base_url('Dashboard/User/UploadProof/'),array('method' => 'post', 'class' => 'proofForm'));?>
                                                                                <table class="table table-layout-fixed uploaded-docs-table" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="uploaded-docs-table-name">
                                                                                                <span class="document-verify-step1 lead mb0">
                                                                                                    <i class="ti-user color-light-blue" style="color: #007aff;"></i>
                                                                                                    Aadhar Card Front
                                                                                                </span>
                                                                                            </td>

                                                                                            <td class="uploaded-docs-table-status">
                                                                                                <div class="verification-img" id="ImgID">
                                                                                                    <input type="file" name="userfile" class="" placeholder=""/><br>
                                                                                                    <input type="hidden" name="proof_type" value="id_proof"/><br>
                                                                                                    <?php
                                                                                                    if($user_bank->id_proof != ''){
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof).'" class="img-responsive" style="max-width:200px;"><br>';
                                                                                                    }else{
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof).'" alt="no-image" class="img-responsive" style="max-width:20px;"><br>';
                                                                                                        echo'<span class="wanki">Not Uploaded</span>';
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="uploaded-docs-table-btn pr0">
                                                                                                <div class="loader"></div>
                                                                                                <?php
                                                                                                if($user_bank->kyc_status != 2)
                                                                                                    echo'<input type="submit" class="btn btn-primary thgy" value="upload"> ';
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            <?php echo form_close();?>
                                                                            <?php echo form_open_multipart(base_url('Dashboard/User/UploadProof/'),array('method' => 'post', 'class' => 'proofForm'));?>
                                                                                <table class="table table-layout-fixed uploaded-docs-table" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="uploaded-docs-table-name">
                                                                                                <span class="document-verify-step1 lead mb0">
                                                                                                    <i class="ti-user color-light-blue" style="color: #007aff;"></i>
                                                                                                    Aadhar Card Back
                                                                                                </span>
                                                                                            </td>

                                                                                            <td class="uploaded-docs-table-status">
                                                                                                <div class="verification-img" id="ImgID">
                                                                                                    <input type="file" name="userfile" class="" placeholder=""/><br>
                                                                                                    <input type="hidden" name="proof_type" value="id_proof2"/><br>
                                                                                                    <?php
                                                                                                    if($user_bank->id_proof2 != ''){
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof2).'" class="img-responsive" style="max-width:200px;"><br>';
                                                                                                    }else{
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof2).'" alt="no-image" class="img-responsive" style="max-width:20px;"><br>';
                                                                                                        echo'<span class="wanki">Not Uploaded</span>';
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="uploaded-docs-table-btn pr0">
                                                                                                <div class="loader"></div>
                                                                                                <?php
                                                                                                if($user_bank->kyc_status != 2)
                                                                                                    echo'<input type="submit" class="btn btn-primary thgy" value="upload"> ';
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            <?php echo form_close();?>
                                                                            <?php echo form_open_multipart(base_url('Dashboard/User/UploadProof/'),array('method' => 'post', 'class' => 'proofForm'));?>
                                                                                <table class="table table-layout-fixed uploaded-docs-table" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="uploaded-docs-table-name">
                                                                                                <span class="document-verify-step1 lead mb0">
                                                                                                    <i class="ti-user color-light-blue" style="color: #007aff;"></i>
                                                                                                    Pan Card
                                                                                                </span>
                                                                                            </td>

                                                                                            <td class="uploaded-docs-table-status">
                                                                                                <div class="verification-img" id="ImgID">
                                                                                                    <input type="file" name="userfile" class="" placeholder=""/><br>
                                                                                                    <input type="hidden" name="proof_type" value="id_proof3"/><br>
                                                                                                    <?php
                                                                                                    if($user_bank->id_proof3 != ''){
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof3).'" class="img-responsive" style="max-width:200px;"><br>';
                                                                                                    }else{
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof3).'" alt="no-image" class="img-responsive" style="max-width:20px;"><br>';
                                                                                                        echo'<span class="wanki">Not Uploaded</span>';
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="uploaded-docs-table-btn pr0">
                                                                                                <div class="loader"></div>
                                                                                                <?php
                                                                                                if($user_bank->kyc_status != 2)
                                                                                                    echo'<input type="submit" class="btn btn-primary thgy" value="upload"> ';
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                </table>
                                                                            <?php echo form_close();?>
                                                                            <?php echo form_open_multipart(base_url('Dashboard/User/UploadProof/'),array('method' => 'post', 'class' => 'proofForm'));?>
                                                                                <table class="table table-layout-fixed uploaded-docs-table" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="uploaded-docs-table-name">
                                                                                                <span class="document-verify-step1 lead mb0">
                                                                                                    <i class="ti-user color-light-blue" style="color: #007aff;"></i>
                                                                                                    Bank Passbook/Cancel Check
                                                                                                </span>
                                                                                            </td>

                                                                                            <td class="uploaded-docs-table-status">
                                                                                                <div class="verification-img" id="ImgID">
                                                                                                    <input type="file" name="userfile" class="" placeholder=""/><br>
                                                                                                    <input type="hidden" name="proof_type" value="id_proof4"/><br>
                                                                                                    <?php
                                                                                                    if($user_bank->id_proof4 != ''){
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof4).'" class="img-responsive" style="max-width:200px;"><br>';
                                                                                                    }else{
                                                                                                        echo'<img src="'.base_url('uploads/' . $user_bank->id_proof4).'" alt="no-image" class="img-responsive" style="max-width:20px;"><br>';
                                                                                                        echo'<span class="wanki">Not Uploaded</span>';
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="uploaded-docs-table-btn pr0">
                                                                                                <div class="loader"></div>
                                                                                                <?php
                                                                                                if($user_bank->kyc_status != 2)
                                                                                                    echo'<input type="submit" class="btn btn-primary thgy" value="upload"> ';
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            <?php echo form_close();?>

                                                                                  <!-- <tr style="    border-bottom: 1px solid #dee2e6;">
                                                                                      <td class="uploaded-docs-table-name">
                                                                                          <span class="document-verify-step1 lead mb0">
                                                                                              <i class="ti-location-pin pl5 color-light-blue" style="color: #007aff;"></i>
                                                                                              Bank Account Proof

                                                                                          </span>
                                                                                      </td>
                                                                                      <td class="uploaded-docs-table-status" style="position:relative;">
                                                                                          <div class="verification-img" id="ImgAddbnk">
                                                                                              <span class="wanki">Not Uploaded</span>
                                                                                          </div>
                                                                                      </td>
                                                                                      <td class="uploaded-docs-table-btn pr0">
                                                                                          <a class="btn btn-primary thgy" onclick="showd2()" href="#" style="box-shadow:none">Upload</a>
                                                                                      </td>
                                                                                  </tr> -->
                                                                                  <tr>
                                                                                      <td colspan="6">
                                                                                          <span id="sta">
                                                                                              <div class="alert alert-danger alert-rounded">Please Upload your Id &amp; Address Proof for Profile Documents Verification
                                                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                                      <span aria-hidden="true" style="position: relative;top: -5px;">×</span>
                                                                                                  </button>
                                                                                              </div>
                                                                                          </span>
                                                                                      </td>
                                                                                  </tr>
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
                                      </div>
                              </div>
                              <!-- END file-upload-form -->
                          </div>
                          <!-- BEGIN panel -->
                          <div class="panel panel-default" style="margin-top:20px;display:none;" id="pochanki">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title"> Identity Document (ID)</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body gtdtf">
                                  <!-- BEGIN file-upload-form -->
                              </div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div2">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              PAN CARD
                                          </div>
                                          <p>If your ID document also states your residential address, then an additional Proof of Address document may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <input type="radio" name="KYCTYPE" id="radio-option-1" value="PAN CARD">
                                                                          <label for="radio-option-1">PAN CARD</label>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" onchange="ShowImagePreview2(this);" id="IMGADDUPLOAD" multiple="">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtuserid" type="text" maxlength="20" id="KYCIdNo" placeholder="Enter Id Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SaveKYCInfo();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd789" alt="Identity Document (ID)" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- BEGIN panel -->
                          <div class="panel panel-default" style="margin-top:20px;display:none; " id="rozhok">
                              <div class="panel-heading">
                                  <h4 class="panel-title"> Proof of Residence (POR)</h4>
                              </div>
                              <div class="panel-body gtdtf"></div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div1">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              Aadhar Card
                                          </div>
                                          <p>If your ID document also states your residential address, then an additional Proof of Address document may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <input type="radio" name="KYCTYPE1" id="radio-option-4" value="Aadhar Card">
                                                                          <label for="radio-option-4">Aadhar Card</label>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" onchange="ShowImagePreview98(this);" id="IMGADDUPLOAD1">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtuserid" type="text" maxlength="20" id="KYCIdNo1" placeholder="Enter Id Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SavePorInfo();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate1"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd78985" alt="Identity Document (ID)" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                              <!-- END file-upload-form -->
                          </div>
                          <!-- BEGIN panel3 -->
                          <div class="panel panel-default" style="margin-top:20px;display:none;" id="ruins">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title">  Bank Account Proof</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body gtdtf">
                                  <!-- BEGIN file-upload-form -->
                              </div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div3">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              Cheque or Passbook
                                          </div>
                                          <p>If you already submited your bank account proof, then an additional Bank account proof may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <span>
                                                                              <input type="radio" name="BANKPROF2" id="radio-option-9" value="Cancel Cheque">
                                                                              <label for="radio-option-9">Cancel Cheque</label>
                                                                          </span>
                                                                          <span class="bcmp">
                                                                              <input type="radio" name="BANKPROF2" id="radio-option-10" value="Bank Passbook">
                                                                              <label for="radio-option-10">Bank Passbook</label>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" id="IMGADDUPLOAD5" onchange="ShowImagePreview9889(this);" multiple="">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtaccountnumber" type="text" maxlength="20" id="bankidNo2" placeholder="Enter Account Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SavePorInfo6();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate56"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd7898558" alt="Bank account proof" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- BEGIN pane3 -->
                      </div>
                  </div>
                  <!-- END panel-body -->
                  <!-- end panel -->
              </div>
              <!-- BEGIN col-4 -->
              <div class="col-md-4 ">
                  <!-- BEGIN profile-info-list -->
                  <ul class="profile-info-list">
                      <li class="title">UPLINE DETAIL</li>
                      <!-- <li><div class="field">Id:</div><div class="value" ><span   id="txtSPNameID"></span></div></li>-->
                      <?php
                      if(!empty($upline)){
                          echo'<li>
                                    <div class="field">Name:</div>
                                    <div class="value">
                                        <span id="SpName">'.$upline['name'].'</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="field">Email-Id:</div>
                                    <div class="value">
                                        <span id="txtSpeMail">'.$upline['email'].'</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="field">Country:</div>
                                    <div class="value">
                                        <span id="SpCountry">India</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="field">Phone no:</div>
                                    <div class="value">
                                        <span id="txtSpMob">'.$upline['phone'].'</span>
                                    </div>
                                </li>';
                      }
                      ?>

                  </ul>
                  <!-- END profile-info-list -->
              </div>
              <!-- END col-4 -->
          </div>
          <!-- END col-8 -->
      </div>
      <!-- END row -->
  </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Profile Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Genelogy View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">

            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('click','#btnCopy',function(){
        //linkTxt
        var copyText = document.getElementById("linkTxt");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        /* Copy the text inside the text field */
        document.execCommand("copy");
        /* Alert the copied text */
        alert("Link Copied : " + copyText.value);
    })
    $("form.proofForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var t = $(this);
        t.find('.loader').css('display','block');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                var res = JSON.parse(data)
                alert(res.message);
                $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                t.find('.loader').css('display','none');
                if(res.success == 1){
                    t.find('.verification-img img').attr('src',res.image)
                    t.find('span.wanki').remove();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    $("#bankform").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var t = $(this);
        t.find('.loader').css('display','block');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                var res = JSON.parse(data)
                alert(res.message);
                $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                t.find('.loader').css('display','none');
                if(res.success == 1){
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    $(document).on('submit','.pswrdrst',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var formData = $(this).serialize();
        $.post(url,formData,function(res){
            alert(res.message);
            $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            // if(res.success == 1){
            //     document.getElementById("pswrdrst").reset();
            // }
        },'json')
    })

$.get('<?php echo base_url("Assets/banks.json")?>',function(res){
    var html = '<option value="">Choose your bank</option>';
    var bank_name = '<?php echo $user_bank->bank_name;?>';
    $.each(res,function(key,value){
        html += '<option value="'+value+'" '+( value == bank_name ? 'selected' : '')+'>'+key+'</option>';
    })
    $("#txtBakName").html(html);
},'json')

$(document).on('change','#bnktoggle',function(){
    $('#bankform').toggle();
    $('#btcForm').toggle();
})
</script>
