<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">Password Reset Request</h2>
        <p>Hello,</p>

        <p>You're receiving this email because we received a password reset request for your account.</p>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ $link }}?email={{ $email }}"
                style="background-color: #219652; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px;">
                Reset Password
            </a>
        </p>

        <p>If you didn’t request a password reset, no further action is required.</p>

        <p>Thank you</p>
    </div>
</body>

</html>