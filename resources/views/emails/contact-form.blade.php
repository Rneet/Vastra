<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
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
            background-color: #212529;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .message-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    <div class="content">
        <p>You have received a new message from your website's contact form.</p>
        
        <div class="field">
            <span class="label">Name:</span>
            <span>{{ $formData['first_name'] }} {{ $formData['last_name'] }}</span>
        </div>
        
        <div class="field">
            <span class="label">Email:</span>
            <span>{{ $formData['email'] }}</span>
        </div>
        
        @if(isset($formData['phone']) && !empty($formData['phone']))
        <div class="field">
            <span class="label">Phone:</span>
            <span>{{ $formData['phone'] }}</span>
        </div>
        @endif
        
        <div class="field">
            <span class="label">Subject:</span>
            <span>{{ $formData['subject'] }}</span>
        </div>
        
        <div class="field">
            <span class="label">Message:</span>
            <div class="message-box">{{ $formData['message'] }}</div>
        </div>
        
        <p>This email was sent on {{ date('F j, Y, g:i a') }}</p>
    </div>
</body>
</html>
