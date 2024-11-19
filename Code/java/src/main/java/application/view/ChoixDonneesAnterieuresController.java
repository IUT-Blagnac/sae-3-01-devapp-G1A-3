package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.stage.Stage;

public class ChoixDonneesAnterieuresController {
    
    private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        this.containingStage.show();
    }

    @FXML
    private void donneeUnique(){
        main.AnterieurDonneeUnique(containingStage);
    }

    @FXML
    private void multiDonnee(){
        main.AnterieurDonneesMultiples(containingStage);
    }

}