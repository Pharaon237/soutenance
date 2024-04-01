// Récupération de l'élément formulaire
const addToCartForm = document.getElementById('add-to-cart-form');

// Ajoutez un gestionnaire d'événements pour l'événement de soumission du formulaire
addToCartForm.addEventListener('submit', function(event) {
    // Empêchez le comportement par défaut du formulaire
    event.preventDefault();

    // Récupérez la valeur de la quantité saisie
    const quantityInput = document.getElementById('qant');
    const quantity = parseInt(quantityInput.value);

    // Récupérez l'ID du produit
    const productId = event.target.querySelector('button').value;

    // Vérifiez si une quantité valide a été saisie
    if (!isNaN(quantity) && quantity > 0) {
        // Création de l'objet product en JavaScript
        const product = {
            id: productId,
            quantity: quantity
        };

        // Ajoutez le produit au panier
        addToCart(product);
    } else {
        // Sinon, affichez un message d'erreur ou effectuez toute autre action souhaitée
        alert('Veuillez saisir une quantité valide.');
    }
});
