FROM ubuntu:20.04
RUN apt-get update 
RUN apt install -y nano
RUN  apt install -y net-tools
RUN mkdir -p /var/www/html
RUN apt install -y subversion
ENV TZ=Asia/Ho_Chi_Minh
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt install -y php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath
## for apt to be noninteractive
ENV DEBIAN_FRONTEND noninteractive
ENV DEBCONF_NONINTERACTIVE_SEEN true

RUN apt-get install -y curl
# cài wp cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp
RUN apt install mysql-client -y
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apt-get install mysql-client -y

# cài node 16
RUN cd ~
RUN curl -sL https://deb.nodesource.com/setup_16.x -o /tmp/nodesource_setup.sh
RUN bash /tmp/nodesource_setup.sh
RUN apt-get install -y nodejs
RUN apt-get install -y build-essential
RUN npm install -g typescript


# cài require cho chrome webdriver để chạy headless chrome
# 1. Cài driver
RUN apt-get install -y libnss3 chromium-browser
# 2. Cài chrome
RUN apt-get -y install libgconf-2-4 unzip xvfb libxi6 
RUN curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add 
RUN bash -c "echo 'deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main' >> /etc/apt/sources.list.d/google-chrome.list"
RUN apt-get -y update 
RUN apt-get -y install google-chrome-stable 
# fonts for the browser
# sudo apt-get -y install xfonts-cyrillic xfonts-100dpi xfonts-75dpi xfonts-base         xfontsf-scalable
# support for screenshot capturing
# sudo apt-get -y install imagemagick x11-apps

WORKDIR /var/www/html

ENTRYPOINT tail -F anything