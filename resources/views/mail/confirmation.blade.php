<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Email Address</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #444;">
    <h1 style="font-size: 24px;">Confirm Your Email Address</h1>
    <p>Dear {{ $name }},</p>
    <p>Thank you for registering with My Website. Before you can start using our services, we need to verify that you are the owner of this email address.</p>
    <p>Please click on the following link to confirm your email address:</p>
    <p><a href="{{ $verificationUrl }}" style="color: #2d3748; text-decoration: none;">{{ $verificationUrl }}</a></p>
    <p>If you did not sign up for My Website, please ignore this email.</p>
    <p>Best regards,</p>
    <p>The My Website Team</p>
</body>
</html>