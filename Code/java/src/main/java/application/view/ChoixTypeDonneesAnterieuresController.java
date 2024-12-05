package application.view;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ToggleButton;
import javafx.stage.Stage;

public class ChoixTypeDonneesAnterieuresController {
    

    private Stage containingStage;
    private IoTMainFrame main;
    private List<String> donnees = new ArrayList<String>();
    private LocalDate dateDebut;
    private LocalDate dateFin;

    @FXML
    private DatePicker calendDebut;

    @FXML
    private DatePicker calendFin;

    @FXML
    private ToggleButton co2;
    @FXML
    private ToggleButton humidite;
    @FXML
    private ToggleButton temperature;
    @FXML
    private ToggleButton panneauxSolaires;
    

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
        if (co2.isSelected()){
            donnees.add("CO2");
            panneauxSolaires.setSelected(false);
            panneauxSolaires.setDisable(true);
        }
        else{
            donnees.remove("CO2"); 
        }
        if (!(co2.isSelected() || temperature.isSelected() || humidite.isSelected())){
            panneauxSolaires.setDisable(false); 
        }
    }

    @FXML
    private void choixHum(){
        if (humidite.isSelected()){
            donnees.add("Humidite");
            panneauxSolaires.setSelected(false);
            panneauxSolaires.setDisable(true);
        }
        else{
            donnees.remove("Humidite"); 
        }
        if (!(co2.isSelected() || temperature.isSelected() || humidite.isSelected())){
            panneauxSolaires.setDisable(false); 
        }
    }

    @FXML
    private void choixTemp(){
        if (temperature.isSelected()){
            donnees.add("Temperature");
            panneauxSolaires.setSelected(false);
            panneauxSolaires.setDisable(true);
        }
        else{
            donnees.remove("Temperature");
        }
        if (!(co2.isSelected() || temperature.isSelected() || humidite.isSelected())){
            panneauxSolaires.setDisable(false); 
        }
    }

    @FXML
    private void choixPanneaux(){
        if (panneauxSolaires.isSelected()){
            donnees.add("solaredge");

            donnees.remove("CO2");
            co2.setSelected(false);
            co2.setDisable(true);

            donnees.remove("Humidite");
            humidite.setSelected(false);
            humidite.setDisable(true);

            donnees.remove("Temperature");
            temperature.setSelected(false);
            temperature.setDisable(true);
        }
        else{
            donnees.remove("solaredge");

            co2.setDisable(false); 

            humidite.setDisable(false);
            
            temperature.setDisable(false);
        }
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
        if (donnees.contains("solaredge")){
            main.AnterieurSolaredge(containingStage, dateDebut, dateFin);
        }
        else{
            main.AnterieurDonneeUnique(containingStage, donnees, dateDebut, dateFin);
        }
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }
}
