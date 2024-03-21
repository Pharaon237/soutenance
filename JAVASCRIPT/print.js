

  function printContent(className) {
    var content = document.querySelector('.' + className); // Sélectionne l'élément par sa classe
    if (content === null) {
        console.error("L'élément avec la classe spécifiée n'existe pas.");
        return;
    }

    var originalContents = document.body.innerHTML; // Sauvegarde le contenu original de la page
    document.body.innerHTML = content.innerHTML; // Remplace le contenu de la page par le contenu de l'élément spécifié
    window.print(); // Appelle la fonction d'impression du navigateur
    document.body.innerHTML = originalContents; // Restaure le contenu original de la page
}
