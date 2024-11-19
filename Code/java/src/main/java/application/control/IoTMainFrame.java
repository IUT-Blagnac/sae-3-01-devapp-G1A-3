package application.control;

import application.view.HistoricViewController_V1;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

public class IoTMainFrame extends Application {

	private Stage stage;

	/**
	 * Méthode de démarrage (JavaFX).
	 */
	@Override
	public void start(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(
					HistoricViewController_V1.class.getResource("Affiche_Donnee_Seule.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Fenêtre Principale");

			HistoricViewController_V1 viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	/**
	 * Méthode principale de lancement de l'application.
	 */
	public static void runApp() {
		Application.launch();
	}
}
