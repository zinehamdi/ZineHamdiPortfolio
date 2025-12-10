<?php
/**
 * GitHub Webhook for Auto-Deployment
 * URL: https://zindev.kairouanhub.com/webhook.php
 */

// Security: Verify GitHub signature (optional but recommended)
$secret = 'your_webhook_secret_here'; // Change this to match your GitHub webhook secret

// Get the payload
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature if secret is set
if ($secret && $signature) {
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        die('Invalid signature');
    }
}

// Decode payload
$data = json_decode($payload, true);

// Check if it's a push to main branch
if (isset($data['ref']) && $data['ref'] === 'refs/heads/main') {
    // Log the deployment
    $logFile = __DIR__ . '/../storage/logs/deployment.log';
    $timestamp = date('Y-m-d H:i:s');
    
    // Execute deployment commands
    $output = [];
    $commands = [
        'cd ' . dirname(__DIR__),
        'git pull origin main 2>&1',
        'php artisan config:clear 2>&1',
        'php artisan cache:clear 2>&1',
        'php artisan view:clear 2>&1',
        'php artisan optimize 2>&1'
    ];
    
    exec(implode(' && ', $commands), $output, $return);
    
    // Log the result
    $logMessage = sprintf(
        "[%s] Deployment triggered by %s\nCommit: %s\nOutput:\n%s\n\n",
        $timestamp,
        $data['pusher']['name'] ?? 'Unknown',
        $data['head_commit']['message'] ?? 'Unknown',
        implode("\n", $output)
    );
    
    file_put_contents($logFile, $logMessage, FILE_APPEND);
    
    // Return success
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Deployment completed',
        'timestamp' => $timestamp
    ]);
} else {
    http_response_code(200);
    echo json_encode([
        'status' => 'skipped',
        'message' => 'Not a push to main branch'
    ]);
}
