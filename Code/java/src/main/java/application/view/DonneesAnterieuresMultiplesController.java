package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.stage.Stage;

public class DonneesAnterieuresMultiplesController {

	private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
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

    /*AlertUtilities.showAlert(this.containingStage, "Erreur clôture compte", null, "Le compte doit avoir un solde égal à 0 pour être clôturé",
	AlertType.WARNING);*/
}
