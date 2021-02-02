重新 clone 流程

1. 指定位置 ( C:\xampp\htdocs\)

git clone git@github.com:online135/Shopping-Cart.git

2. 安裝及升級套件

npm install

npm update

composer install

composer update

3. 複製 .env.example 成 .env  => 放在旁邊

4. 生成新的 key

php artisan key:generate


(以上是開發狀態不用管 key 的時候的作法)



javascript 比較麻煩

如果有改動的話, 要記得重新

npm run watch

去啟動跟更新新的 node.js