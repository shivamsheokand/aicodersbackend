# AI Coders Backend API

## Deployment Guide for Hostinger

### Prerequisites

-   PHP 8.1+
-   MySQL 5.7+
-   Composer
-   Node.js & npm
-   Git

### Initial Server Setup

1. Login to Hostinger control panel
2. Create a new subdomain: `backaicoders.aicoders.in`
3. Create a new MySQL database and user
4. Enable SSH access if not already enabled

### Deployment Steps

1. **Clone the Repository**

```bash
cd /home/u143511568/domains/backaicoders.aicoders.in
git clone <repository-url> .
```

2. **Configure Environment**

-   Copy `.env.production` to `.env`
-   Update database credentials and other settings
-   Generate application key if needed: `php artisan key:generate`

3. **Install Dependencies**

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

4. **Set Permissions**

```bash
chmod -R 755 .
chmod -R 777 storage bootstrap/cache
```

5. **Setup Database**

```bash
php artisan migrate --force
php artisan db:seed
```

6. **Create Storage Link**

```bash
php artisan storage:link
```

7. **Configure Web Server**

-   Copy `nginx.conf` to the appropriate Hostinger configuration directory
-   Update paths in the configuration file if needed
-   Restart Nginx if required

8. **SSL Configuration**

-   Install SSL certificate through Hostinger control panel
-   Update SSL certificate paths in nginx configuration

### Automatic Deployment

You can use the included `deploy.sh` script for automated deployments:

```bash
chmod +x deploy.sh
./deploy.sh
```

### Post-Deployment Verification

1. Check application logs: `storage/logs/laravel.log`
2. Verify the API endpoints are accessible
3. Confirm CORS is working with the frontend
4. Test file uploads and storage
5. Verify database connections and migrations

### Maintenance

-   Regular backups are configured through Hostinger panel
-   Monitor logs in `storage/logs/`
-   Use `php artisan down` for maintenance mode

### Security Notes

-   Keep `.env` secure and never commit it
-   Regularly update dependencies
-   Monitor access logs
-   Enable rate limiting if needed
-   Keep SSL certificates up to date

### Troubleshooting

1. **Permission Issues**

    - Check storage and cache directory permissions
    - Verify PHP-FPM user permissions

2. **Database Connection**

    - Verify credentials in `.env`
    - Check database server status
    - Confirm firewall settings

3. **CORS Issues**

    - Verify CORS headers in nginx config
    - Check allowed origins configuration

4. **File Upload Problems**
    - Check PHP upload limits
    - Verify storage directory permissions
    - Confirm symbolic links

### Contact

For support, contact the development team at support@aicoders.in
