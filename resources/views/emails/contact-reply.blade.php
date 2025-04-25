<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $messageSubject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hello {{ $recipientName }},</h2>
    </div>
    
    <div class="content">
        {!! nl2br(e($messageContent)) !!}
    </div>
    
    <div class="footer">
        <p>Thank you for contacting us.</p>
        <p>© {{ date('Y') }} Wahyu Dedik. All rights reserved.</p>
    </div>
</body>
</html>