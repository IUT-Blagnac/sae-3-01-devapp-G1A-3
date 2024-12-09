package application.view;

import java.io.File;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import application.control.IoTMainFrame;
import application.tools.DataReader;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.geometry.Orientation;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.chart.XYChart.Data;
import javafx.scene.control.Alert;
import javafx.scene.control.CheckMenuItem;
import javafx.scene.control.ListView;
import javafx.scene.control.MenuButton;
import javafx.scene.control.ScrollBar;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

/**
 * Contrôleur pour la gestion de la visualisation et des interactions avec les données historiques de l'application.
 * Cette classe permet de charger des données, créer des graphiques, gérer des alertes et traiter les interactions utilisateur.
 */
public class DonneesAnterieuresController {

    private Stage containingStage;
    private IoTMainFrame main;

    private List<String> choix = new ArrayList<String>();
    private ListView<String> listeVue = new ListView<>();

    private LocalDate dateDebut;
    private LocalDate dateFin;
    private int compteNbSalles = 0;
    private int ancienNbSalles = 0;

    private LineChart<Number, Number> graphCO2;
    private LineChart<Number, Number> graphTemp;
    private LineChart<Number, Number> graphHum;

    private HashMap<String, XYChart.Series<Number, Number>> seriesMap = new HashMap<>();
    private HashMap<String, List<String>> alertesMap = new HashMap<>();

    @FXML
    private VBox contenu;

    private HBox alertes;
    ScrollBar scroll;

    /**
     * Initialise le contrôleur avec la fenêtre donnée.
     *
     * @param _containingStage la fenêtre gérée par le contrôleur.
     */
    public void initContext(Stage _containingStage) {
        this.containingStage = _containingStage;
    }

    /**
     * Affiche la boîte de dialogue pour la gestion de la visualisation des données historiques.
     * Vérifie que les dates de début et de fin, ainsi que les choix de données, sont correctement définis.
     *
     * @throws Exception en cas de problème lors de l'affichage.
     */
    public void displayDialog() throws Exception {
        if (dateDebut == null || dateFin == null || dateDebut.isAfter(dateFin)) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Manque de saisie");
            alert.setHeaderText("Problème dans la saisie des dates");
            alert.show();
            main.choixTypeDonneesAnterieures(containingStage);
        } else if (choix.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Manque de choix");
            alert.setHeaderText("Aucune valeur n'a été demandée");
            alert.show();
            main.choixTypeDonneesAnterieures(containingStage);
        } else {
            menu(choix, dateDebut, dateFin);
            creerGraphiques(choix);
            creerListeVue();
            this.containingStage.show();
        }
    }

    /**
     * Définit la référence principale pour l'application.
     *
     * @param newMain l'instance principale de l'application.
     */
    public void setMain(IoTMainFrame newMain) {
        main = newMain;
    }

    /**
     * Définit les choix de données sélectionnés.
     *
     * @param listVal la liste des types de données sélectionnés.
     */
    public void setDonnees(List<String> listVal) {
        choix = listVal;
    }

    /**
     * Définit la date de début pour la plage de données à afficher.
     *
     * @param date la date de début.
     */
    public void setDateDebut(LocalDate date) {
        dateDebut = date;
    }

    /**
     * Définit la date de fin pour la plage de données à afficher.
     *
     * @param date la date de fin.
     */
    public void setDateFin(LocalDate date) {
        dateFin = date;
    }

    @FXML
    /**
     * Retourne à l'écran principal de l'application.
     */
    private void ecranPrincipal() {
        main.start(containingStage);
    }

    @FXML
    /**
     * Ouvre l'écran des données en direct.
     */
    private void ecranDirect() {
        main.changementActuel(containingStage);
    }

    @FXML
    /**
     * Ferme la fenêtre courante.
     */
    private void fermer() {
        this.containingStage.close();
    }

    @FXML
    /**
     * Permet de choisir les données à afficher.
     */
    private void choisirDonnees() {
        main.choixTypeDonneesAnterieures(containingStage);
    }


    /**
     * Crée et affiche un menu permettant de sélectionner des salles pour les données.
     *
     * @param choix     la liste des types de données choisis (CO2, Température, Humidité, etc.).
     * @param dateDebut la date de début des données.
     * @param dateFin   la date de fin des données.
     */
    public void menu(List<String> choix, LocalDate dateDebut, LocalDate dateFin){

        String chemin = "Code/Java/src/main/resources/application/capteur/AM107";
        File dossier = new File(chemin);

        final String sMenuTextStart = "Salle";
        final MenuButton choices = new MenuButton(sMenuTextStart);

        final List<CheckMenuItem> items = new ArrayList<>();
        
        for (String name : dossier.list()){
            CheckMenuItem bouton = new CheckMenuItem(name);
            bouton.setOnAction(new EventHandler<ActionEvent>() {
                public void handle(ActionEvent e) {
                    if (bouton.isSelected()) {
                        ajouteData(dateDebut, dateFin, name, choix);
                        ancienNbSalles = compteNbSalles;
                        compteNbSalles ++;
                        if (compteNbSalles == 1 && ancienNbSalles == 0){
                            ajouteGraphiques(choix);
                        }



                        creerAlertes(name);
                        if (listeVue.getItems().size() > 0 && !(contenu.getChildren().contains(alertes))){
                            ajouteAlertes();
                        }
                    }
                    else{
                        supprData(choix, name);
                        ancienNbSalles = compteNbSalles;
                        compteNbSalles --;

                        if (compteNbSalles == 0){
                            retireGraphiques();
                        }
                        


                        if (listeVue.getItems().size() > 0 && alertesMap.containsKey(name)){
                            supprAlertes(name);
                        }
                        if (listeVue.getItems().size() == 0 && contenu.getChildren().contains(alertes)){
                            retireAlertes();
                        }
                    }
                }
            });
            items.add(bouton);
        }
        choices.getItems().addAll(items);
        contenu.getChildren().add(choices);
    }


    /**
     * Crée les graphiques pour les données choisies (CO2, Température, Humidité) avec des axes définis.
     * 
     * @param choix La liste des types de données à afficher dans les graphiques (CO2, Température, Humidité).
     */
    private void creerGraphiques(List<String> choix){

        NumberAxis xAxis = new NumberAxis(0, 24, 1);

        if (choix.contains("CO2")){
            NumberAxis yAxis = new NumberAxis(0, 5000, 250); 
            yAxis.setLabel("CO2");
            graphCO2 = new LineChart<>(xAxis, yAxis);
        }
        if (choix.contains("Temperature")){
            NumberAxis yAxis = new NumberAxis(0, 100, 10); 
            yAxis.setLabel("Température");
            graphTemp = new LineChart<>(xAxis, yAxis);
        }
        if (choix.contains("Humidite")){
            NumberAxis yAxis = new NumberAxis(0, 100, 10); 
            yAxis.setLabel("Humidité");
            graphHum = new LineChart<>(xAxis, yAxis);
        }
    }


    /**
     * Trouve les fichiers de capteur AM107 correspondant à un fichier spécifié et dans la plage de dates donnée.
     *
     * @param nomFichier Le nom du fichier à rechercher.
     * @return Une liste de fichiers correspondant à la date et au nom spécifiés.
     */
    private List<File> trouveFichiersAM107(String nomFichier){
        int i = 0;
        boolean fini = false;
        String chemin = "Code/Java/src/main/resources/application/capteur/AM107/" + nomFichier;
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
                System.out.println("Fichier ajouté");
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
     * Ajoute les données des fichiers de capteur aux graphiques, selon le type de données choisi.
     *
     * @param dateDebut La date de début pour la période des données à afficher.
     * @param dateFin La date de fin pour la période des données à afficher.
     * @param nomFichier Le nom du fichier des données à ajouter.
     * @param choix La liste des types de données à afficher (CO2, Température, Humidité).
     */
    private void ajouteData(LocalDate dateDebut, LocalDate dateFin, String nomFichier, List<String> choix){

        List<File> listeCapteurs = trouveFichiersAM107(nomFichier);

        List<Float> listeVal;

        List<LineChart.Data<Number, Number>> listeData = new ArrayList<>();
        List<LineChart.Series<Number, Number>> listeSeries = new ArrayList<>();

        if (choix.contains("CO2")){
            listeData.clear();
            listeVal = DataReader.getCo2(listeCapteurs);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[1]);
                float valY = heure + minute/60;
                listeData.add(new Data<Number,Number>(valY, listeVal.get(i)));
            }

            LineChart.Series<Number,Number> serie = new LineChart.Series<>();
            serie.setName(nomFichier);
            serie.getData().addAll(listeData);
            listeSeries.add(serie);

            seriesMap.put(nomFichier + "-CO2", serie);
        }
        if (choix.contains("Temperature")){
            listeData.clear();
            listeVal = DataReader.getTemps(listeCapteurs);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[1]);
                listeData.add(new Data<Number,Number>(heure + minute/60, listeVal.get(i)));
            }

            LineChart.Series<Number,Number> serie = new LineChart.Series<>();
            serie.setName(nomFichier);
            serie.getData().addAll(listeData);
            listeSeries.add(serie);
            seriesMap.put(nomFichier + "-Temp", serie);
        }
        if (choix.contains("Humidite")){
            listeData.clear();
          
            listeVal = DataReader.getHumidities(listeCapteurs);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeCapteurs.get(i).getName().split("_")[1].split("-")[1]);
                listeData.add(new Data<Number,Number>(heure + minute/60, listeVal.get(i)));
            }

            LineChart.Series<Number,Number> serie = new LineChart.Series<>();
            serie.setName(nomFichier);
            serie.getData().addAll(listeData);
            listeSeries.add(serie);

            seriesMap.put(nomFichier + "-Hum", serie);
        }
        ajouteValgraphiques(choix, dateDebut, dateFin, listeSeries);
    }


    /**
     * Supprime les données d'un fichier spécifique des graphiques pour les types de données choisis.
     *
     * @param choix La liste des types de données dont les données doivent être supprimées.
     * @param nomFichier Le nom du fichier des données à supprimer.
     */
    private void supprData(List<String> choix, String nomFichier){
        if (choix.contains("CO2")){
            graphCO2.getData().remove(seriesMap.get(nomFichier + "-CO2"));
            seriesMap.remove(nomFichier + "-CO2");
        }
        if (choix.contains("Temperature")){
            graphTemp.getData().remove(seriesMap.get(nomFichier + "-Temp"));
            seriesMap.remove(nomFichier + "-Temp");
        }
        if (choix.contains("Humidite")){
            graphHum.getData().remove(seriesMap.get(nomFichier + "-Hum"));
            seriesMap.remove(nomFichier + "-Hum");
        }
        if (choix.contains("solaredge")){
            graphHum.getData().remove(seriesMap.get(nomFichier + "-solaredge"));
            seriesMap.remove(nomFichier + "-solaredge");
        }
    }


    /**
     * Ajoute les séries de données aux graphiques pour les types de données choisis dans la période spécifiée.
     *
     * @param choix La liste des types de données à ajouter aux graphiques (CO2, Température, Humidité).
     * @param dateDebut La date de début pour la période des données à ajouter.
     * @param dateFin La date de fin pour la période des données à ajouter.
     * @param listeSeries La liste des séries de données à ajouter.
     */
    private void ajouteValgraphiques(List<String> choix, LocalDate dateDebut, LocalDate dateFin, List<LineChart.Series<Number, Number>> listeSeries){
        int parcoursSerie = 0;
        
        if (choix.contains("CO2")){
            graphCO2.getData().add(listeSeries.get(parcoursSerie));
            parcoursSerie ++;
        }
        if (choix.contains("Temperature")){
            graphTemp.getData().add(listeSeries.get(parcoursSerie));
            parcoursSerie ++;
        }
        if (choix.contains("Humidite")){
            graphHum.getData().add(listeSeries.get(parcoursSerie));
            parcoursSerie ++;
        }
    }


    /**
     * Ajoute les graphiques pour les types de données spécifiés à l'interface utilisateur.
     *
     * @param choix La liste des types de données à ajouter aux graphiques (CO2, Température, Humidité).
     */
    private void ajouteGraphiques(List<String> choix){
        if (choix.contains("CO2")){
            contenu.getChildren().add(graphCO2);
        }
        if (choix.contains("Temperature")){
            contenu.getChildren().add(graphTemp);
        }
        if (choix.contains("Humidite")){
            contenu.getChildren().add(graphHum);
        }
    }


    /**
     * Retire tous les graphiques affichés dans l'interface utilisateur.
     */
    public void retireGraphiques(){
        int taille = contenu.getChildren().size();
        if (taille > 1){
            for (int i = 1; i < taille; i++){
                contenu.getChildren().remove(1);
            }
        }
    }


    /**
     * Trouve les alertes correspondant à un fichier spécifique et dans la plage de dates donnée.
     *
     * @param nomFichier Le nom du fichier des alertes à rechercher.
     * @return Une liste de fichiers d'alertes correspondant à la date et au nom spécifiés.
     */
    private List<File> trouveAlertes(String nomFichier){
        int i = 0;
        boolean fini = false;
        String chemin = "Code/Java/src/main/resources/application/capteur/alerte/" + nomFichier;
        File dossier = new File(chemin);
        LocalDate datePrecedente = null;

        List<File> listeFichiersBonnesDates = new ArrayList<>();

        if (dossier.list() != null){
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
        }
        return listeFichiersBonnesDates;
    }


    /**
     * Crée et affiche les alertes à partir des fichiers trouvés pour le fichier spécifié.
     *
     * @param nomFichier Le nom du fichier d'alertes à traiter.
     */
    private void creerAlertes(String nomFichier){
        List<File> listeAlertes =  trouveAlertes(nomFichier);
        List<String> listeAffichages = new ArrayList<>();
        
        if (listeAlertes.size() > 0){
            List<List> donnees = DataReader.getAlertes(listeAlertes);

            for (int i = 0; i < donnees.get(0).size(); i++){
                String affichageAlerte = "Valeur détectée : " + donnees.get(1).get(i) + ", seuil d'alerte : " + donnees.get(1).get(i) + " dans la salle " + donnees.get(0).get(i) + " à ";
                affichageAlerte += Integer.parseInt(listeAlertes.get(i).getName().split("_")[1].split("-")[0]) + "h" + Integer.parseInt(listeAlertes.get(i).getName().split("_")[1].split("-")[1]);
                affichageAlerte += " le " + Integer.parseInt(listeAlertes.get(i).getName().split("_")[0].split("-")[2]) + "/";
                affichageAlerte += Integer.parseInt(listeAlertes.get(i).getName().split("_")[0].split("-")[1]) + "/";
                affichageAlerte += Integer.parseInt(listeAlertes.get(i).getName().split("_")[0].split("-")[0]);
                listeVue.getItems().add(affichageAlerte);
                listeAffichages.add(affichageAlerte);
                alertesMap.put(nomFichier, listeAffichages);
            }
        }
    }


    /**
     * Supprime les alertes affichées pour un fichier spécifique.
     *
     * @param nomFichier Le nom du fichier d'alertes à supprimer.
     */
    private void supprAlertes(String nomFichier){
        listeVue.getItems().removeAll(alertesMap.get(nomFichier));
        alertes.getChildren().remove(0);
        alertes.getChildren().add(0, listeVue);
        alertesMap.remove(nomFichier);
    }


    /**
     * Crée la vue contenant les alertes à afficher dans l'interface utilisateur.
     */
    private void creerListeVue(){
        alertes = new HBox();
        scroll = new ScrollBar();
        scroll.setOrientation(Orientation.VERTICAL);
        listeVue.setPrefWidth(2000);
        alertes.getChildren().add(0, listeVue);
        alertes.getChildren().add(scroll);
    }


    /**
     * Ajoute la section des alertes à l'interface utilisateur.
     */
    private void ajouteAlertes(){
        contenu.getChildren().add(alertes);   
    }


    /**
     * Retire la section des alertes de l'interface utilisateur.
     */
    public void retireAlertes(){
        contenu.getChildren().removeLast();
    }
}