<?php include_once('header.php'); ?>

<div class="inner-banner inner-bg1">
<div class="container-fluid">
<div class="container-max">
<div class="inner-title">
 <span>CONTACT US</span>
<h2>We’re Always Helpful <br> To Lend A Hand</h2>
</div>
</div>
</div>
</div>


<div class="service-area-four pt-100 pb-70">
<div class="container">
<div class="row">
<div class="col-md-4 col-sm-6">
<div class="service-card service-card-bg-three section-bg">
<i class='flaticon-bankrupt'></i>
<a href="service-details.html">
<h1>Address</h1>
</a>

<p  style="font-size: 22px;">Rose Garden,Govind Singh Nagar,Bathinda (Punjab)</p>
</div>
</div>
<div class="col-md-4 col-sm-6">
<div class="service-card service-card-bg-three active">
<i class='flaticon-value'></i>
<a href="#" >
<h1 class="text-white">Phone</h1>
</a>
<a href="tel:<?php echo phone;?>" style="font-size: 22px;color: #fff;">
<?php echo phone;?>
</a>
</div>
</div>
<div class="col-md-4 col-sm-6">
<div class="service-card service-card-bg-three section-bg">
<i class='flaticon-time-management'></i>
<a href="service-details.html">
<h1>Email</h1>
</a>
<a href="mailto:<?php echo email;?>" style="font-size: 22px;">
<?php echo email;?>
</a>
</div>
</div>

</div>
</div>
</div>


<div class="map-area-two">
<div class="container-fluid m-0 p-0">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13788.620279759081!2d74.9395095!3d30.2326541!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x97cb83eaffb318fd!2sRose%20garden%20Bathinda!5e0!3m2!1sen!2sin!4v1620143336317!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
<div class="contact-wrap">
<div class="contact-form">
<span>SEND MESSAGE</span>
<h2>Contact With Us</h2>
<form id="contactForm">
<div class="row">
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<i class='bx bx-user'></i>
<input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name*">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<i class='bx bx-user'></i>
<input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email*">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<i class='bx bx-phone'></i>
<input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Your Phone">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<i class='bx bx-file'></i>
<input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Your Subject">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-12 col-md-12">
<div class="form-group">
<i class='bx bx-envelope'></i>
<textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-12 col-md-12">
<button type="submit" class="default-btn default-hot-toddy">
Send Message
<i class='bx bx-right-arrow-alt'></i>
</button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
<div class="clearfix"></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>


<div class="newsletter-area pt-100 pb-70">
<div class="container">
<div class="row">
<div class="col-lg-7">
<div class="newsletter-content">
<i class='flaticon-email'></i>
<h2>Join our weekly <b class="section-color2">Newsletter</b></h2>
</div>
</div>
<div class="col-lg-5">
<div class="newsletter-form-area">
<form class="newsletter-form" data-toggle="validator" method="POST">
<input type="email" class="form-control" placeholder="Your Email*" name="EMAIL" required autocomplete="off">
<button class="default-btn default-hot-toddy" type="submit">
Subscribe
<i class='bx bx-right-arrow-alt'></i>
</button>
<div id="validator-newsletter" class="form-result"></div>
</form>
</div>
</div>
</div>
</div>
</div>
<?php include_once('footer.php'); ?>
