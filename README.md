### Prerequisites:
1. PHP >=7.4 + Composer
2. Symfony CLI

* Command to install the necessary php extensions
```bash
   sudo apt -y install php7.4 php7.4-cli php7.4-fpm php7.4-json php7.4-pdo php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php-pear php7.4-bcmath php7.4-apcu php7.4-intl
```

### Start up
1. Generate new GTP api key https://platform.openai.com/account/api-keys
2. Rename .env.local.dist to .env.local
3. In .env.local set GPT_AUTH_TOKEN 

```bash
composer install
symfony serve -d 
```

Now you could open project on https://127.0.0.1:8000

### Troubles
If you get ```HTTP/2 401  returned for "https://api.openai.com/v1/chat/completions"``` response, than regenerate GPT token and reset it in .env.local
