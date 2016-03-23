/**
 * Created by Kenny on 23/03/2016.
 */

<!-- Script récupérant le titre de la page et le mettant dans la balise <title> -->
function titre() {
    // Récupère toutes les balises <h1>, ... <h6> de la page
    var titres = $(":header");
    // Garde uniquement le troisième titre (car les deux premiers sont le "Bienvenue" du menu latéral)
    var titre = titres[2].textContent;
    // Affecte ce titre à la balise <title> de la page
    document.getElementsByTagName("title")[0].innerHTML = titre;
}