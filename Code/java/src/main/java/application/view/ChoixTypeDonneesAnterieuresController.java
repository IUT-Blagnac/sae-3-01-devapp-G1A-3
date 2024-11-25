package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.stage.Stage;

public class ChoixTypeDonneesAnterieuresController {
    

    private Stage containingStage;
    private IoTMainFrame main;

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        this.containingStage.show();
    }

    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }

    @FXML
    private void choixCO2(){
        main.AnterieurDonneeUnique(containingStage, "CO2");
    }

    @FXML
    private void choixHum(){
        main.AnterieurDonneeUnique(containingStage, "Humidite");
    }

    @FXML
    private void choixTemp(){
        main.AnterieurDonneeUnique(containingStage, "Temperature");
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }
}
