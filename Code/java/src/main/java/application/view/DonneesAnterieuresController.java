package application.view;

import java.io.File;
import java.time.LocalDate;
import java.util.ArrayList;
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
            affichage(choix, dateDebut, dateFin);
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

    private void actualisationData(LocalDate dateDebut, LocalDate dateFin, String nomFichier, List<String> choix){
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
        List<Float> listeVal = DataReader.getCo2(listeFichiersBonnesDates);
        List<XYChart.Data<Number, Number>> listeData = new ArrayList<>();

        XYChart.Series<Number, Number> series = new XYChart.Series<>();
        for (i = 0; i < listeVal.size(); i ++){
            float heure = Integer.parseInt(listeFichiersBonnesDates.get(i).getName().split("_")[1].split("-")[0]);
            float minute = Integer.parseInt(listeFichiersBonnesDates.get(i).getName().split("_")[1].split("-")[1]);
            listeData.add(new Data<Number,Number>(heure + minute/60, listeVal.get(i)));
        }
        series.getData().addAll(listeData);
        affichage(choix, dateDebut, dateFin);
    }



    public void affichage(List<String> choix, LocalDate dateDebut, LocalDate dateFin){
        File dossier = new File("Code/Java/src/main/resources/application/capteur/AM107");

        final String sMenuTextStart = "Salle";
        final MenuButton choices = new MenuButton(sMenuTextStart);
        final List<CheckMenuItem> items = new ArrayList<>();

        for (String name : dossier.list()){
            CheckMenuItem bouton = new CheckMenuItem(name);
            bouton.setOnAction(new EventHandler<ActionEvent>() {
                public void handle(ActionEvent e) {
                    actualisationData(dateDebut, dateFin, name, choix);
                }
            });
            items.add(bouton);
        }

        choices.getItems().addAll(items);
        contenu.getChildren().add(choices);
        
        NumberAxis xAxis = new NumberAxis(0, 24, 1); 
        
        if (choix.contains("CO2")){
            NumberAxis yAxis = new NumberAxis(0, 1500, 100); 
            yAxis.setLabel("CO2");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            graph.getData().clear();
            contenu.getChildren().add(graph);
        }
        if (choix.contains("Temperature")){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("Température");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            graph.getData().clear();
            contenu.getChildren().add(graph);
        }
        if (choix.contains("Humidite")){
            NumberAxis yAxis = new NumberAxis(0, 100, 10); 
            yAxis.setLabel("Humidité");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            graph.getData().clear();
            contenu.getChildren().add(graph);
        }
    }
}