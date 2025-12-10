#!/bin/bash
# Quick deployment script for Hostinger

echo "🚀 Deploying to Hostinger..."

# SSH into server and pull latest changes
ssh -p 65002 u346640129@147.93.54.167 << 'ENDSSH'
cd /home/u346640129/domains/zindev.kairouanhub.com
echo "📦 Pulling latest changes from GitHub..."
git pull origin main
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize
echo "✅ Deployment complete!"
ENDSSH

echo "🌐 Testing site..."
curl -I https://zindev.kairouanhub.com | head -5
echo ""
echo "✅ Deployment finished! Visit: https://zindev.kairouanhub.com"
