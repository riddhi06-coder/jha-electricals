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
    </style>
</head>
<body>
    <div class="container">
        <h2>New Subscription</h2>
        <p>A new user has subscribed to your newsletter.</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        
        <p class="footer">This is an automated email. Please do not reply.</p>
    </div>
</body>
</html>
