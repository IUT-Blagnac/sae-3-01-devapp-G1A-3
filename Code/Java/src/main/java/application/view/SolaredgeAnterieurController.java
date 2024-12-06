package application.view;

import java.io.File;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import application.control.IoTMainFrame;
import application.tools.DataReader;
import javafx.fxml.FXML;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart.Data;
import javafx.scene.control.Alert;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;


/**
 * Contrôleur de la vue des données solaires antérieures.
 * Cette classe gère l'affichage des graphiques des données solaires pour une période spécifiée
 * ainsi que la gestion des interactions avec l'utilisateur dans l'interface.
 */
public class SolaredgeAnterieurController {

    private Stage containingStage;
    private IoTMainFrame main;

    private LocalDate dateDebut;
    private LocalDate dateFin;

    private LineChart<Number, Number> graphSolar;

    @FXML
    private VBox contenu;

    /**
     * Initialise le contexte du contrôleur avec le stage de la classe appelante.
     * 
     * @param _containingStage Le stage principal de l'application.
     */
    public void initContext(Stage _containingStage) {
        this.containingStage = _containingStage;
    }

    /**
     * Affiche la fenêtre du graphique des données solaires pour la période sélectionnée.
     * Si les dates sont invalides ou manquantes, un message d'erreur est affiché.
     */
    public void displayDialog() {
        if (dateDebut == null || dateFin == null || dateDebut.isAfter(dateFin)) {
            main.choixTypeDonneesAnterieures(containingStage);
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Manque de saisie");
            alert.setHeaderText("Problème dans la saisie des dates");
            alert.show();
        } else {
            creerGraphique();
            ajouteData();
            this.containingStage.show();
        }
    }

    /**
     * Définit l'objet principal de l'application (IoTMainFrame) pour ce contrôleur.
     * 
     * @param newMain L'objet principal de l'application.
     */
    public void setMain(IoTMainFrame newMain) {
        main = newMain;
    }

    /**
     * Définit la date de début pour la période des données à afficher.
     * 
     * @param date La date de début de la période.
     */
    public void setDateDebut(LocalDate date) {
        dateDebut = date;
    }

    /**
     * Définit la date de fin pour la période des données à afficher.
     * 
     * @param date La date de fin de la période.
     */
    public void setDateFin(LocalDate date) {
        dateFin = date;
    }

    @FXML
    /**
     * Action liée au bouton permettant de revenir à l'écran principal de l'application.
     */
    private void ecranPrincipal() {
        main.start(containingStage);
    }

    @FXML
    /**
     * Action liée au bouton permettant de passer à l'écran des données en direct.
     */
    private void ecranDirect() {
        main.changementActuel(containingStage);
    }

    @FXML
    /**
     * Action liée au bouton permettant de fermer l'application.
     */
    private void fermer() {
        this.containingStage.close();
    }

    @FXML
    /**
     * Action liée au bouton permettant de choisir un autre type de données antérieures.
     */
    private void choisirDonnees() {
        main.choixTypeDonneesAnterieures(containingStage);
    }


    /**
     * Crée le graphique des données solaires en configurant les axes X et Y.
     * L'axe X représente les heures et minutes, l'axe Y représente l'énergie mesurée.
     */
    public void creerGraphique(){
        NumberAxis xAxis = new NumberAxis(0, 24, 1);
        NumberAxis yAxis = new NumberAxis(0, 2000, 200); 
        yAxis.setLabel("Energie courante");
        graphSolar = new LineChart<>(xAxis, yAxis);
    }



    /**
     * Recherche les fichiers correspondant aux données solaires pour la période spécifiée.
     * 
     * @return Liste des fichiers correspondant aux données de la période spécifiée.
     */
    private List<File> trouveFichiers(){
        int i = 0;
        boolean fini = false;
        String chemin = "sae-3-01-devapp-G1A-3/Code/Java/src/main/resources/application/capteur/solaredge";
        File dossier = new File(chemin);
        LocalDate datePrecedente = null;

        List<File> listeFichiersBonnesDates = new ArrayList<>();

        while (i < dossier.list().length && fini == false){
            int annee = Integer.parseInt(dossier.list()[i].split("_")[0].split("-")[0]);
            int mois = Integer.parseInt(dossier.list()[i].split("_")[0].split("-")[1]);
            int jour = Integer.parseInt(dossier.list()[i].split("_")[0].split("-")[2]);
            LocalDate date = LocalDate.of(annee, mois, jour);
            if (date == datePrecedente){
                listeFichiersBonnesDates.add(new File(chemin + "/" + dossier.list()[i]));
            }
            else{
                if (date.isBefore(dateFin)){
                    if (date.isAfter(dateDebut)){
                        listeFichiersBonnesDates.add(new File(chemin + "/" + dossier.list()[i]));
                        datePrecedente = date;
                    }
                    else{
                        fini = true;
                    }
                }
            }
            i++;
        }
        return listeFichiersBonnesDates;
    }

    
    /**
     * Ajoute les données des panneaux solaires dans le graphique créé.
     * Les données sont extraites des fichiers et ajoutées en tant que séries dans le graphique.
     */
    private void ajouteData(){
        List<File> listePanneauxSolaires = trouveFichiers();

        List<LineChart.Data<Number, Number>> listeData = new ArrayList<>();
        List<Float> listeVal;

        listeVal = DataReader.getSolarData(listePanneauxSolaires);

        for (int i = 0; i < listeVal.size(); i ++){
            float heure = Integer.parseInt(listePanneauxSolaires.get(i).getName().split("_")[1].split("-")[0]);
            float minute = Integer.parseInt(listePanneauxSolaires.get(i).getName().split("_")[1].split("-")[1]);
            float valY = heure + minute/60;
            listeData.add(new Data<Number,Number>(valY, listeVal.get(i)));
        }

        LineChart.Series<Number,Number> serie = new LineChart.Series<>();
        serie.setName("Panneaux solaires");
        serie.getData().addAll(listeData);
        graphSolar.getData().add(serie);
        contenu.getChildren().add(graphSolar);
    }
}