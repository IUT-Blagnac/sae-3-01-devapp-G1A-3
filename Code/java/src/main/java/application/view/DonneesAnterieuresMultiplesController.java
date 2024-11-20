package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.stage.Stage;

public class DonneesAnterieuresMultiplesController {

	private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();

    @FXML
    private LineChart grapheCO2;

    @FXML
    private LineChart grapheHum;

    @FXML
    private LineChart grapheTemp;

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        lalala(grapheTemp);
        this.containingStage.show();
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

    public void lalala(LineChart<Number, Number> graph){
        //Définir l'axe X
        NumberAxis xAxis = new NumberAxis(0, 24, 1); 
        xAxis.setLabel("Heure de la journée"); 
                
        //Définir l'axe Y
        NumberAxis yAxis = new NumberAxis(0, 40, 5); 
        yAxis.setLabel("Température");
    
        //Assurez-vous que le graphique passé (graph) utilise les bons axes
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
    
        // Ajouter les séries de données au graphique passé en paramètre
        graph.getData().clear();  // Assurez-vous de vider les anciennes données si nécessaire
        graph.getData().add(series);
    }
    

    /*AlertUtilities.showAlert(this.containingStage, "Erreur clôture compte", null, "Le compte doit avoir un solde égal à 0 pour être clôturé",
	AlertType.WARNING);*/
}
