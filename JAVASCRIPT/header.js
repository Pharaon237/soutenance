 // dropdown
  function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.classList.toggle("show");
  }
  
// toggle-button
document.getElementById('sidebarToggle').addEventListener('click', function() {
document.querySelector('.sidebar').classList.toggle('sidebar-open');
    });

// search-bar
function searchFunction() {
    var input, filter, products, product, title, i;
    input = document.getElementById("search-bar");
    filter = input.value.toUpperCase();
    products = document.getElementsByClassName("product");
  
    for (i = 0; i < products.length; i++) {
      product = products[i];
      title = product.getElementsByClassName("product-title")[0];
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
        product.style.display = "";
      } else {
        product.style.display = "none";
      }
    }
  }
  
  document.getElementById("search-bar").addEventListener("keyup", function(event) {
    // Vérifier si la touche pressée est la touche Entrée (code 13)
    if (event.key === "Enter") {
      // Appeler la fonction de recherche lorsque la touche Entrée est pressée
      searchFunction();
    }
  });    

 
  