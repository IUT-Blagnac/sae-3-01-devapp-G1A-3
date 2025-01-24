package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.image.Image;
import javafx.stage.Stage;


/**
 * Contrôleur de la vue Menu. Gère les actions liées aux différents boutons dans l'interface utilisateur.
 */
public class MenuController {

	private Stage containingStage;
    private IoTMainFrame main = new IoTMainFrame();

    /**
     * Initialise le contexte avec le stage de la classe appelante.
     * Cette méthode est appelée pour transmettre l'objet Stage à ce contrôleur.
     * 
     * @param _containingStage Le stage initial de l'application.
     */
    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    /**
     * Affiche la fenêtre du menu et définit l'icône de l'application.
     * Cette méthode est appelée pour afficher le stage du menu à l'écran.
     */
    public void displayDialog(){
        this.containingStage.getIcons().add(new Image(this.getClass().getResourceAsStream("app_icon.jpg")));
        this.containingStage.show();
    }

    @FXML
    /**
     * Action liée au bouton pour afficher l'écran des données en direct.
     * Cette méthode appelle la fonction permettant de passer à l'écran des données en direct.
     */
    private void ecranDirect(){
        main.changementActuel(containingStage);
    }

    @FXML
    /**
     * Action liée au bouton pour afficher l'écran des données antérieures.
     * Cette méthode appelle la fonction permettant de passer à l'écran des données antérieures.
     */

    private void ecranAnterieur(){
        main.choixTypeDonneesAnterieures(containingStage);
    }

    @FXML
    /**
     * Action liée au bouton pour changer le fichier de configuration.
     * Cette méthode permet de modifier le fichier de configuration de l'application.
     */
    private void changerConfig(){
        main.changementConfig(containingStage);
    }

    @FXML
    /**
     * Action liée au bouton pour lancer le programme Python associé.
     * Cette méthode exécute un programme Python externe et affiche une alerte pour informer l'utilisateur.
     */
    private void lancerPython(){
        Alert alert = new Alert(AlertType.INFORMATION);
        alert.setTitle("Information");
        alert.setHeaderText("Python");
        alert.setContentText("Le programme Python est lancé");

        main.lanceurPython();
        alert.showAndWait();
    }

    @FXML
    /**
     * Action liée au bouton pour fermer l'application.
     * Cette méthode ferme le stage et termine l'exécution de l'application.
     */
    private void fermer(){
        this.containingStage.close();
    }
}
