重新 clone 流程

(windows) 安裝 xampp第8版 => 要調整 C:\xampp8\apache\conf\extra\httpd-vhosts.conf

指定位置 ( C:\xampp\htdocs\ )
git clone git@github.com:online135/Shopping-Cart.git

=> 會生成一個新的資料夾 Shopping-Cart

進去該資料夾內用 cmd 安裝及升級套件 (用 Visual Code 開該資料夾, 再開 Terminal )
npm install

npm update

composer install

composer update

複製 .env.example 成 .env => 放在旁邊

生成新的 key

php artisan key:generate

(以上是開發狀態不用管 key 的時候的作法)

php artisan migrate

javascript 比較麻煩

如果有改動的話, 要記得重新

npm run watch

去啟動跟更新新的 node.js