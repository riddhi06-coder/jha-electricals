<!DOCTYPE html>
<html>
<head>
    <title>New Product Enquiry</title>
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

    <h2>New Product Enquiry</h2>
    <p><strong>Name:</strong> {{ $emailData['name'] }}</p>
    <p><strong>Phone:</strong> {{ $emailData['phone'] }}</p>
    <p><strong>Email:</strong> {{ $emailData['email'] }}</p>
    <p><strong>Product:</strong> {{ $emailData['product'] }}</p>
    <p><strong>Quantity:</strong> {{ $emailData['quantity'] }}</p>
    <p><strong>Location:</strong> {{ $emailData['location'] }}</p>
    <p><strong>Message:</strong> {{ $emailData['message'] }}</p><br>


    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Jha Electricals. All rights reserved.</div>
    </div>
</body>
</html>
