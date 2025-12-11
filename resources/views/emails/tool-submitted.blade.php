<!DOCTYPE html>
<html>
<head>
    <title>New Tool Submission</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { background-color: #ffffff; margin: 20px auto; padding: 20px; border-radius: 8px; max-width: 600px; }
        .header { background-color: #AA661C; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { padding: 20px; }
        .detail { margin: 15px 0; }
        .label { font-weight: bold; color: #333; }
        .value { color: #666; margin-top: 5px; }
        .button { display: inline-block; background-color: #AA661C; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-top: 20px; }
        .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Tool Submission</h1>
        </div>
        
        <div class="content">
            <p>A new tool has been submitted and is waiting for your review.</p>
            
            <div class="detail">
                <div class="label">Tool Name:</div>
                <div class="value">{{ $product->name }}</div>
            </div>
            
            <div class="detail">
                <div class="label">Category:</div>
                <div class="value">{{ $product->category->name ?? 'N/A' }}</div>
            </div>
            
            <div class="detail">
                <div class="label">Version:</div>
                <div class="value">{{ $product->version }}</div>
            </div>
            
            <div class="detail">
                <div class="label">Description:</div>
                <div class="value">{{ $product->description }}</div>
            </div>
            
            <div class="detail">
                <div class="label">Installation Steps:</div>
                <div class="value">{{ $product->installation_steps }}</div>
            </div>
            
            <div class="detail">
                <div class="label">Submitted by:</div>
                <div class="value">{{ $product->user->username ?? 'Unknown' }}</div>
            </div>
            
            <a href="{{ route('admin.detail', $product->id) }}" class="button">Review Tool</a>
        </div>
        
        <div class="footer">
            <p>HackerShelf Admin Panel</p>
        </div>
    </div>
</body>
</html>
