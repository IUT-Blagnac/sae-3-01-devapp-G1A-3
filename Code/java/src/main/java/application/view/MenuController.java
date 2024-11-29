package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.image.Image;
import javafx.stage.Stage;

public class MenuController {

	private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();


    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        this.containingStage.getIcons().add(new Image(this.getClass().getResourceAsStream("app_icon.jpg")));
        this.containingStage.show();
    }

    @FXML
    private void ecranDirect(){
        main.changementActuel(containingStage);
    }

    @FXML
    private void ecranAnterieur(){
        main.choixTypeDonneesAnterieures(containingStage);
    }

    @FXML
    private void changerConfig(){
        
    }

    @FXML
    private void fermer(){
        this.containingStage.close();
    }
}
