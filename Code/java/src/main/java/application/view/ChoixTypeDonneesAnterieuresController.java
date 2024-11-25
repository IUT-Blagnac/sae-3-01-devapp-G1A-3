package application.view;

import java.time.LocalDate;
import java.util.Date;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.stage.Stage;

public class ChoixTypeDonneesAnterieuresController {
    

    private Stage containingStage;
    private IoTMainFrame main;
    private String donnee = "";
    private LocalDate dateDebut;
    private LocalDate dateFin;

    @FXML
    DatePicker calendDebut;

    @FXML
    DatePicker calendFin;
    

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
        donnee = "CO2";
    }

    @FXML
    private void choixHum(){
        donnee = "Humidite";
    }

    @FXML
    private void choixTemp(){
        donnee = "Temperature";
    }

    @FXML
    private void dateDebut(){
        dateDebut = calendDebut.getValue();
    }

    @FXML
    private void dateFin(){
        dateFin = calendFin.getValue();
    }


    @FXML
    private void valider(){
        main.AnterieurDonneeUnique(containingStage, donnee, dateDebut, dateFin);
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }
}
