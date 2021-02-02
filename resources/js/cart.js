function initCart(){
    return getCart()
}

function getCart() {
    var cart = Cookies.get('cart')
    return (!cart) ? {} : JSON.parse(cart)
}

function saveCart(cart) {
    Cookies.set('cart', JSON.stringify(cart))
}

function addProductToCart(productId, quantity){
    var cart = getCart()
    var currentQuantity = parseInt(cart[productId]) || 0
    var addQuantity = parseInt(quantity) || 0
    var newQuantity = currentQuantity + addQuantity
    updateProductToCart(productId, newQuantity)
}

function updateProductToCart(productId, newQuantity){
    var cart = getCart()
    cart[productId] = newQuantity
    saveCart(cart)
}

function alertProductQuantity(productId) {
    var cart = getCart()
    var quantity = parseInt(cart[productId]) || 0
    alert(quantity)
}

function initAddToCart(productId) {
    var addToCartBtn = document.querySelector('#addToCart');

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(){ 
            var quantityInput = document.querySelector('input[name="quantity"]')
            if (quantityInput) {
                addProductToCart(productId, quantityInput.value)
                alertProductQuantity(productId)
            }
        })
    }
}

export {initAddToCart}