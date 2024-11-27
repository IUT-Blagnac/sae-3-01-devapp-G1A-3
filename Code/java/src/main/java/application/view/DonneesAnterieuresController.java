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
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.chart.XYChart.Data;
import javafx.scene.control.Alert;
import javafx.scene.control.CheckMenuItem;
import javafx.scene.control.MenuButton;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

public class DonneesAnterieuresController {

    private Stage containingStage;
    private IoTMainFrame main;

    private List<String> choix = new ArrayList<String>();
    private LocalDate dateDebut;
    private LocalDate dateFin;

    private int compteNbSalles = 0;
    private int ancienNbSalles = 0;
    private LineChart<Number, Number> graphCO2;
    private LineChart<Number, Number> graphTemp;
    private LineChart<Number, Number> graphHum;

    private HashMap<String, XYChart.Series<Number, Number>> seriesMap = new HashMap<>();

    @FXML
    VBox contenu;

    public void initContext(Stage _containingStage) {
        this.containingStage = _containingStage;
    }

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
            this.containingStage.show();
        }
    }

    public void setMain(IoTMainFrame newMain) {
        main = newMain;
    }

    public void setDonnees(List<String> listVal) {
        choix = listVal;
    }

    public void setDateDebut(LocalDate date) {
        dateDebut = date;
    }

    public void setDateFin(LocalDate date) {
        dateFin = date;
    }

    @FXML
    private void ecranPrincipal() {
        main.start(containingStage);
    }

    @FXML
    private void ecranDirect() {
        main.changementActuel(containingStage);
    }

    @FXML
    private void fermer() {
        this.containingStage.close();
    }

    @FXML
    private void choisirDonnees() {
        main.choixTypeDonneesAnterieures(containingStage);
    }



    public void menu(List<String> choix, LocalDate dateDebut, LocalDate dateFin){

        File dossier = new File("Code/Java/src/main/resources/application/capteur/AM107");

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
                    }
                    else{
                        supprData(choix, name);
                        ancienNbSalles = compteNbSalles;
                        compteNbSalles --;
                    }
                    if (compteNbSalles == 0){
                        retireGraphiques();
                    }
                    if (compteNbSalles == 1 && ancienNbSalles == 0){
                        ajouteGraphiques(choix);
                    }
                }
            });
            items.add(bouton);
        }
        choices.getItems().addAll(items);
        contenu.getChildren().add(choices);
    }



    public void creerGraphiques(List<String> choix){

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



    public void retireGraphiques(){
        int taille = contenu.getChildren().size();
        if (taille > 1){
            for (int i = 1; i < taille; i++){
                contenu.getChildren().remove(1);
            }
        }
    }



    private List<File> trouveFichiers(String nomFichier){
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

    

    private void ajouteData(LocalDate dateDebut, LocalDate dateFin, String nomFichier, List<String> choix){

        List<File> listeFichiers = trouveFichiers(nomFichier);

        List<Float> listeVal = new ArrayList<>();

        List<LineChart.Data<Number, Number>> listeData = new ArrayList<>();
        List<LineChart.Series<Number,    Number>> listeSeries = new ArrayList<>();

        if (choix.contains("CO2")){
            listeData.clear();
            listeVal = DataReader.getCo2(listeFichiers);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[1]);
                listeData.add(new Data<Number,Number>(heure + minute/60, listeVal.get(i)));
            }

            LineChart.Series<Number,Number> serie = new LineChart.Series<>();
            serie.setName(nomFichier);
            serie.getData().addAll(listeData);
            listeSeries.add(serie);

            seriesMap.put(nomFichier + "-CO2", serie);
        }
        if (choix.contains("Temperature")){
            listeData.clear();
            listeVal = DataReader.getTemps(listeFichiers);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[1]);
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
            listeVal = DataReader.getHumidites(listeFichiers);

            for (int i = 0; i < listeVal.size(); i ++){
                float heure = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[0]);
                float minute = Integer.parseInt(listeFichiers.get(i).getName().split("_")[1].split("-")[1]);
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



    private void supprData(List<String> choix, String nomFichier){
        System.out.println(seriesMap);
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
    }



    public void ajouteValgraphiques(List<String> choix, LocalDate dateDebut, LocalDate dateFin, List<LineChart.Series<Number, Number>> listeSeries){
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


    
    public void ajouteGraphiques(List<String> choix){
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
}