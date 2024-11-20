
function updateQuantity(element, index, change) {
    var quantityInput = element.parentElement.querySelector('input[type="number"]');
    var newQuantity = parseInt(quantityInput.value) + change;
    if (newQuantity >= 1 && newQuantity <= 1000) {
        quantityInput.value = newQuantity;
        var form = element.parentElement;
        form.querySelector('input[name="quantity"]').value = newQuantity;
        form.submit();
    }
}
