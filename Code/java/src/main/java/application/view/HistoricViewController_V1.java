package application.view;

import javafx.fxml.FXML;
import javafx.scene.control.Menu;
import javafx.scene.control.MenuItem;
import javafx.stage.Stage;

public class HistoricViewController_V1 {

    // Fenêtre physique ou est la scène contenant le fichier xml contrôlé par this
	private Stage containingStage;

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        this.containingStage.show();
    }

    @FXML
    private Menu menu1;
    @FXML
    private Menu menu2;
    @FXML
    private MenuItem item1;
    @FXML
    private MenuItem item2;
    @FXML
    private MenuItem item3;
    

    @FXML
    private void ecranPrincipal(){
        //redirige vers l'ecran principal
    }

    @FXML
    private void ecranDirect(){
        //redirige vers le javaFX de naria
    }

    @FXML
    private void fermer(){
        this.containingStage.close();
    }

    @FXML
    private void choisirDonnees(){
        //ouvre une fenêtre intermédiaire pour changer les données à afficher
    }

    /*AlertUtilities.showAlert(this.containingStage, "Erreur clôture compte", null, "Le compte doit avoir un solde égal à 0 pour être clôturé",
	AlertType.WARNING);*/
}
