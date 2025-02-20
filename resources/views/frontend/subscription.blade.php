<!DOCTYPE html>
<html>
<head>
    <title>New Subscription</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #333; }
        p { font-size: 16px; color: #555; }
        .footer { margin-top: 20px; font-size: 14px; color: #777; }

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


    <div class="container">
        <h2>New Subscription</h2>
        <p>A new user has subscribed to your newsletter.</p>
        <p><strong>Email:</strong> {{ $email }}</p><br>
        
        
    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Jha Electricals. All rights reserved.</div>
    </div>
    </div>
</body>
</html>
