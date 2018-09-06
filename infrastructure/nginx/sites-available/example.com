
server {


    server_name example.com   www.example.com;


    access_log /var/log/nginx/example.com.access.log rt_cache; 
    error_log /var/log/nginx/example.com.error.log;


    root /var/www/example.com/htdocs;
    
    

    index index.php index.html index.htm;


    include common/php.conf;      
    include common/wpcommon.conf;
    include common/locations.conf;
    include /var/www/example.com/conf/nginx/*.conf;
}
