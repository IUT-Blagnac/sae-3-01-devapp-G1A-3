package application.view;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ToggleButton;
import javafx.stage.Stage;

/**
 * Contrôleur pour la gestion de la sélection des types de données antérieures
 * et des plages de dates dans l'application.
 */
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
    

    /**
     * Initialise le contexte du contrôleur en définissant la fenêtre parente.
     * 
     * @param _containingStage la fenêtre parente.
     */
    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    /**
     * Affiche la boîte de dialogue pour la sélection des types de données antérieures.
     */
    public void displayDialog(){
        this.containingStage.show();
    }

    /**
     * Définit la référence à la classe principale de l'application.
     * 
     * @param newMain l'instance principale de l'application.
     */
    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }

    @FXML
    /**
     * Gère la sélection ou la désélection du bouton CO2.
     * Active ou désactive les options des panneaux solaires en conséquence.
     */
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
    /**
     * Gère la sélection ou la désélection du bouton Humidité.
     * Active ou désactive les options des panneaux solaires en conséquence.
     */
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
    /**
     * Gère la sélection ou la désélection du bouton Température.
     * Active ou désactive les options des panneaux solaires en conséquence.
     */
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
    /**
     * Gère la sélection ou la désélection du bouton Panneaux Solaires.
     * Active ou désactive les autres options en conséquence.
     */
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
    /**
     * Définit la date de début sélectionnée par l'utilisateur.
     */
    private void dateDebut(){
        dateDebut = calendDebut.getValue();
    }

    @FXML
    /**
     * Définit la date de fin sélectionnée par l'utilisateur.
     */
    private void dateFin(){
        dateFin = calendFin.getValue();
    }


    @FXML
    /**
     * Valide la sélection des données et des dates, et appelle les méthodes
     * correspondantes dans la classe principale.
     */
    private void valider(){
        if (donnees.contains("solaredge")){
            main.AnterieurSolaredge(containingStage, dateDebut, dateFin);
        }
        else{
            main.AnterieurDonneeUnique(containingStage, donnees, dateDebut, dateFin);
        }
    }

    @FXML
    /**
     * Retourne au menu principal de l'application.
     */
    private void menu(){
        main.start(containingStage);
    }
}
