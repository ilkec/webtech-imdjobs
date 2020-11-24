@server( ['production' => 'interact.crabdance.com@172.104.151.134', 'staging' => 'interact.crabdance.com@172.104.151.134'])

@task('deploy-production', ['on' => 'production'])
cd /home/interact.crabdance.com/production/webtech-imdjobs
php artisan down
git reset --hard HEAD 
git pull origin master 
php composer.phar dump-autoload
php artisan migrate --force 
php artisan up
@endtask

@task('deploy-staging', ['on' => 'staging'])
cd /home/interact.crabdance.com/staging/webtech-imdjobs
php artisan down
git reset --hard HEAD 
git pull origin master 
php composer.phar dump-autoload
php artisan migrate --force 
php artisan up
@endtask
