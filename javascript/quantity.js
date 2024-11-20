function updateQuantity(change, element) {
    let input = element.parentNode.querySelector('input');
    let currentQuantity = parseInt(input.value);
    let newQuantity = currentQuantity + change;
    if (newQuantity > 0 && newQuantity <= 1000) {
        input.value = newQuantity;
    }
}