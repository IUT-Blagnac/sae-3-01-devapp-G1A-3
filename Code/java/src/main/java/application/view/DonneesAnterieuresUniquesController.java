package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.stage.Stage;

public class DonneesAnterieuresUniquesController {

	private Stage containingStage;
    private IoTMainFrame main;
    private String choix = "";

    @FXML 
    private LineChart<Number, Number> graphique;

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        ajoutDonnees(graphique, choix);
        this.containingStage.show();
    }

    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }

    public void setDonnee(String val){
        choix = val;
    }

    public String getDonnee(){
       return choix;
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
        main.changementAnterieur(containingStage);
    }

    public void ajoutDonnees(LineChart<Number, Number> graph, String choix){
        //Définir l'axe X
        NumberAxis xAxis = new NumberAxis(0, 24, 1); 
        xAxis.setLabel("Heure de la journée"); 
        
        if (choix == "CO2"){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("CO2");

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Taux de CO2 en fonction de l'heure de la journée");

            // Ajouter des données au graphique
            series.getData().add(new XYChart.Data<>(3, 15));
            series.getData().add(new XYChart.Data<>(6, 17));
            series.getData().add(new XYChart.Data<>(9, 20));
            series.getData().add(new XYChart.Data<>(12, 26));
            series.getData().add(new XYChart.Data<>(15, 28));
            series.getData().add(new XYChart.Data<>(18, 27));
            series.getData().add(new XYChart.Data<>(21, 24));

            graph.getData().clear();
            graph.getData().add(series);
        }
        else if (choix == "Temperature"){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("Température");

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Température en fonction de l'heure de la journée");

            // Ajouter des données au graphique
            series.getData().add(new XYChart.Data<>(3, 15));
            series.getData().add(new XYChart.Data<>(6, 17));
            series.getData().add(new XYChart.Data<>(9, 20));
            series.getData().add(new XYChart.Data<>(12, 26));
            series.getData().add(new XYChart.Data<>(15, 28));
            series.getData().add(new XYChart.Data<>(18, 27));
            series.getData().add(new XYChart.Data<>(21, 24));

            graph.getData().clear();
            graph.getData().add(series);
        }
        else if (choix == "Humidite"){
            NumberAxis yAxis = new NumberAxis(0, 40, 5); 
            yAxis.setLabel("Humidité");

            graph.getXAxis().setLabel(xAxis.getLabel());
            graph.getYAxis().setLabel(yAxis.getLabel());

            XYChart.Series<Number, Number> series = new XYChart.Series<>();
            series.setName("Pourcentage d'humidité en fonction de l'heure de la journée");

            // Ajouter des données au graphique
            series.getData().add(new XYChart.Data<>(3, 15));
            series.getData().add(new XYChart.Data<>(6, 17));
            series.getData().add(new XYChart.Data<>(9, 20));
            series.getData().add(new XYChart.Data<>(12, 26));
            series.getData().add(new XYChart.Data<>(15, 28));
            series.getData().add(new XYChart.Data<>(18, 27));
            series.getData().add(new XYChart.Data<>(21, 24));

            graph.getData().clear();
            graph.getData().add(series);
        }
        else{
            //throw une page d'alerte avec un probleme
        }
    }
}