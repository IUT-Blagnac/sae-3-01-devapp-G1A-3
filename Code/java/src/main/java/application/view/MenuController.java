package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.stage.Stage;

public class MenuController {

	private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();


    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        this.containingStage.show();
    }

    @FXML
    private void ecranDirect(){
        main.changementActuel(containingStage);
    }

    @FXML
    private void ecranAnterieur(){
        main.changementAnterieur(containingStage);
    }

    @FXML
    private void fermer(){
        this.containingStage.close();
    }
}
