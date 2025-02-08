<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Details</title>
</head>
<body>
    <h3>New Contact Form Details</h3>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone_number }}</p>
    <p><strong>Subject:</strong> {{ $msg_subject }}</p>
    <p><strong>Message:</strong> {{ $message_content }}</p><br>

    <p>Thanks & Regards</p>
</body>
</html>
