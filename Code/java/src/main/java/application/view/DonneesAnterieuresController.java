package application.view;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Alert;
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

    public void displayDialog() throws Exception{
        if (dateDebut == null || dateFin == null){
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Manque de saisie");
            alert.setHeaderText("Problème dans la saisie des dates");
            alert.show();
            main.choixTypeDonneesAnterieures(containingStage);
        }
        else if (choix.isEmpty()){
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Manque de choix");
            alert.setHeaderText("Aucune valeur n'a été demandée");
            alert.show();
            main.choixTypeDonneesAnterieures(containingStage);
        }
        else{
            ajoutDonnees(choix, dateDebut, dateFin);
            this.containingStage.show();
        }
    }

    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }

    public void setDonnees(List<String> listVal){
        choix = listVal;
    }

    public void setDateDebut(LocalDate date){
        dateDebut = date;
    }

    public void setDateFin(LocalDate date){
        dateFin = date;
    }

    @FXML
    private void ecranPrincipal(){
        main.start(containingStage);
    }

    @FXML
    private void ecranDirect(){
        main.changementActuel(containingStage);
    }

    @FXML
    private void fermer(){
        this.containingStage.close();
    }

    @FXML
    private void choisirDonnees(){
        main.choixTypeDonneesAnterieures(containingStage);
    }

    public void ajoutDonnees(List<String> choix, LocalDate dateDebut, LocalDate dateFin){
        System.out.println(choix);
        //Définir l'axe X
        NumberAxis xAxis = new NumberAxis(0, 24, 1); 
        xAxis.setLabel("Heure de la journée"); 
        
        if (choix.contains("CO2")){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("CO2");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Taux de CO2 en fonction de l'heure de la journée");

            for (LocalDate date = dateDebut; date.isBefore(dateFin); date = date.plusDays(1)){
                
            }

            graph.getData().clear();
            graph.getData().add(series);
            contenu.getChildren().add(graph);
        }
        if (choix.contains("Temperature")){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("Température");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Température en fonction de l'heure de la journée");

            for (LocalDate date = dateDebut; date.isBefore(dateFin); date = date.plusDays(1)){
                
            }

            graph.getData().clear();
            graph.getData().add(series);
            contenu.getChildren().add(graph);
        }
        if (choix.contains("Humidite")){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("Humidité");
            LineChart<Number, Number> graph = new LineChart<>(xAxis, yAxis);

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Pourcentage d'humidité en fonction de l'heure de la journée");

            for (LocalDate date = dateDebut; date.isBefore(dateFin); date = date.plusDays(1)){
                
            }

            graph.getData().clear();
            graph.getData().add(series);
            contenu.getChildren().add(graph);
        }
    }
}