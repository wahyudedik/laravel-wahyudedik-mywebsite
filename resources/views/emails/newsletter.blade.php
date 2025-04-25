<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter</title>
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
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            font-size: 12px;
            text-align: center;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .unsubscribe {
            color: #777;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Wahyu Dedik Newsletter</h1>
    </div>
    
    <div class="content">
        {!! $content !!}
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Wahyu Dedik. All rights reserved.</p>
        <p>
            <a href="{{ url('/unsubscribe') }}" class="unsubscribe">Unsubscribe</a>
        </p>
    </div>
</body>
</html>