<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>

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

    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    <p><strong>Position Applied For:</strong> {{ $position }}</p><br>

    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Jha Electricals. All rights reserved.</div>
    </div>
</body>
</html>
