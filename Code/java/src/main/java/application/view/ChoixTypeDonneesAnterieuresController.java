package application.view;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.stage.Stage;

public class ChoixTypeDonneesAnterieuresController {
    

    private Stage containingStage;
    private IoTMainFrame main;
    private List<String> donnees = new ArrayList<String>();
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
        donnees.add("CO2");
    }

    @FXML
    private void choixHum(){
        donnees.add("Humidite");
    }

    @FXML
    private void choixTemp(){
        donnees.add("Temperature");
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
        main.AnterieurDonneeUnique(containingStage, donnees, dateDebut, dateFin);
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }
}
