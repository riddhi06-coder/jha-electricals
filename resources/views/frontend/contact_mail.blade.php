<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Details</title>
    <style>
        .header {
            text-align: center; /* Centers inline elements like img */
            margin-bottom: 20px;
        }

        .logo {
            width: 50%;
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto; /* Centers the image */
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #000;
        }
    </style>

</head>
<body>
    <div class="header">
        <img src="{{ asset('frontend/assets/img/logo/jha-electricals-logo.png') }}" alt="Jha Electricals" class="logo">
    </div>

    <h3>New Contact Form Details</h3>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone_number }}</p>
    <p><strong>Subject:</strong> {{ $msg_subject }}</p>
    <p><strong>Message:</strong> {{ $message_content }}</p><br>



    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Jha Electricals. All rights reserved.</div>
    </div>
</body>
</html>
