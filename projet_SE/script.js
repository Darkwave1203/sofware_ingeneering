function getGrades() {
    $.ajax({
        url: 'get_grades.php', // Le fichier PHP qui récupère les notes
        type: 'GET',
        success: function(data) {
            // Remplacer le contenu de la section avec les notes récupérées
            $('#gradesSection').html(data);
        },
        error: function(error) {
            console.log('Erreur lors de la récupération des notes :', error);
        }
    });
}

// Appeler getGrades() au chargement de la page pour afficher les notes initiales
$(document).ready(function() {
    getGrades();
});
