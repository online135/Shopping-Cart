重新 clone 流程

(windows) 安裝 xampp第8版 => 要調整 C:\xampp8\apache\conf\extra\httpd-vhosts.conf

指定位置 ( C:\xampp\htdocs\ )
git clone git@github.com:online135/Shopping-Cart.git

=> 會生成一個新的資料夾 Shopping-Cart

進去該資料夾內用 cmd 安裝及升級套件 (用 Visual Code 開該資料夾, 再開 Terminal )
npm install

npm update

composer install

=> 這裡可能會跳錯, 先用 php --ini 找出 php.ini 使用的位置
再去調整 

(詳細要去 ext 資料夾對照, 要完全相同)
1. extension=php_fileinfo.dll
2. extension=php_openssl.dll
3. extension=php_mbstring.dll

composer config -g -- disable-tls true

composer update

複製 .env.example 成 .env => 放在旁邊

生成新的 key

php artisan key:generate

(以上是開發狀態不用管 key 的時候的作法)

javascript 比較麻煩

如果有改動的話, 要記得重新

npm run watch

去啟動跟更新新的 node.js


-----

Email 要設定 smtp, 類似如下設定

1. 設定 gmail 兩步驟認證
(Password要去gmail設定"應用程式密碼", 下面的密碼是假的範例)

2. 切換到『應用程式密碼頁面/App-specific passwords』，點選『管理應用程式密碼/manage application-specific passwords』。

MAIL_MAILER=smtp

MAIL_HOST=smtp.gmail.com

MAIL_PORT=465 (用哪個 port 要查)

MAIL_USERNAME=b97b01067@gmail.com

MAIL_PASSWORD="abcdefg"

MAIL_ENCRYPTION=SSL

MAIL_FROM_ADDRESS=b97b01067@gmail.com

MAIL_FROM_NAME="${APP_NAME}"


----

watch 執行的時候出現 ERROR 就不會進行下去，也就是你的 css 沒有產出，自然不會有樣式出現。

但不是每個人都碰到表示應該是有一些 node module 出了版本上的問題

你執行

npm i html-webpack-plugin@next -D

後再執行 npm run watch 試試看

另外看到一個解決方案是

webpack-cli 降到 3.3.12 版 

1. 刪除 package.json 中的 webpack-cli

2. npm install webpack-cli@3.3.12
