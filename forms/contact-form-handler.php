<?php

$errors = '';

//<-----Put Your email address here.
// $myemail = 'icc.sumit@gmail.com';

// Define multiple admin emails
$myemail = [ 'icc.sumit@gmail.com', 'naititechnologies@gmail.com' ];

// Convert the array to a string with comma-separated emails
// $to = implode( ',', $myemail );

if (
    empty( $_POST[ 'name' ] ) ||
    empty( $_POST[ 'email' ] ) ||
    empty( $_POST[ 'contact_number' ] ) ||
    empty( $_POST[ 'message' ] )
) {
    $errors .= '\n Error: all fields are required';
}

$name = $_POST[ 'name' ];

$email_address = $_POST[ 'email' ];

$contact_number = $_POST[ 'contact_number' ];

$message = $_POST[ 'message' ];

if (
    !preg_match(
        "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",

        $email_address
    )
) {
    $errors .= '\n Error: Invalid email address';
}

// Validate international mobile number format
if (!preg_match("/^\+?[0-9]{1,4}?[-. \s]?([0-9]{10,15})$/", $contact_number))
{
    $errors .= "\n Error: Invalid mobile number format. It should be a valid Contry Code + phone number.";
}

if ( empty( $errors ) ) {
    // 	$to = $myemail;
    $to = implode( ',', $myemail );

    $email_subject = "Contact form submission: $name";

    $email_body =
    'You have received a new message. ' .
    " Here are the details:\n Name: $name \n Email: $email_address\n Mobile No: $contact_number \n Message \n $message";

    // 	$headers = "From: $myemail\n";
    $headers = 'From: info@naititechnologies.com';

    $headers .= "Reply-To: $email_address";

    mail( $to, $email_subject, $email_body, $headers );

    //redirect to the 'thank you' page

    header( 'Location: /contact-form-thank-you.html' );
}
?>

<!--////////////-->

<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>Naiti Technologies</title>
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<!-- This page is displayed only if there is some error -->
<p style="color: red;margin: 15px;text-align: center;"><?php echo nl2br( $errors );?></p>
  <section id="contact" class="contact">
      <div class="container">

        <div class="section-title aos-init aos-animate" data-aos="zoom-out">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4 aos-init aos-animate" data-aos="fade-right">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>108 apollo front of 56 bazar indore madhya pradesh</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>naititechnologies@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+91 9630 100 560</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0 aos-init aos-animate" data-aos="fade-left">

            <form action="./contact-form-handler.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" for="name" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                  <span style="color:red;" id="nameError"></span>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" for="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                  <span style="color:red;" id="emailError"></span>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="contact_number" for="contact_number" id="subject" placeholder="Contact No. (with country code)" data-rule="minlen:10" data-msg="Please enter at least 8 chars of subject">
                <span style="color:red;" id="mobileError"></span>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" for="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <span style="color:red;" id="messageError"></span>
              </div>
              <!-- <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div> -->
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>
</body>
</html>