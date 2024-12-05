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

public class SolaredgeAnterieurController {

    private Stage containingStage;
    private IoTMainFrame main;

    private LocalDate dateDebut;
    private LocalDate dateFin;

    private LineChart<Number, Number> graphSolar;

    @FXML
    private VBox contenu;

    public void initContext(Stage _containingStage) {
        this.containingStage = _containingStage;
    }

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

    public void setMain(IoTMainFrame newMain) {
        main = newMain;
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



    public void creerGraphique(){
        NumberAxis xAxis = new NumberAxis(0, 24, 1);
        NumberAxis yAxis = new NumberAxis(0, 5000, 500); 
        yAxis.setLabel("Energie courante");
        graphSolar = new LineChart<>(xAxis, yAxis);
    }



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