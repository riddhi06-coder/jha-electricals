<!DOCTYPE html>
<html>
<head>
    <title>New Product Enquiry</title>
</head>
<body>
    <h2>New Product Enquiry</h2>
    <p><strong>Name:</strong> {{ $emailData['name'] }}</p>
    <p><strong>Phone:</strong> {{ $emailData['phone'] }}</p>
    <p><strong>Email:</strong> {{ $emailData['email'] }}</p>
    <p><strong>Product:</strong> {{ $emailData['product'] }}</p>
    <p><strong>Quantity:</strong> {{ $emailData['quantity'] }}</p>
    <p><strong>Location:</strong> {{ $emailData['location'] }}</p>
    <p><strong>Message:</strong> {{ $emailData['message'] }}</p><br>


    <p>Thanks & Regards</p>
</body>
</html>
