package application.control;

import application.view.ChoixDonneesAnterieuresController;
import application.view.ChoixTypeDonneesAnterieuresController;
import application.view.DonneesActuellesController;
import application.view.DonneesAnterieuresMultiplesController;
import application.view.DonneesAnterieuresUniquesController;
import application.view.MenuController;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

public class IoTMainFrame extends Application {

	private Stage stage;
	private String typeDonnee = "";

	/**
	 * Méthode de démarrage (JavaFX).
	 */
	@Override
	public void start(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(MenuController.class.getResource("menu.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Fenêtre Principale");

			MenuController viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void changementAnterieur(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(ChoixDonneesAnterieuresController.class.getResource("choixDonneesAnterieures.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			ChoixDonneesAnterieuresController viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void changementActuel(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(DonneesActuellesController.class.getResource("affichageTpsReel.fxml"));
			VBox root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données actuelles");

			DonneesActuellesController viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void AnterieurDonneeUnique(Stage primaryStage, String choix) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(DonneesAnterieuresUniquesController.class.getResource("affichageDonneesSeules.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			DonneesAnterieuresUniquesController viewController = loader.getController();
			viewController.initContext(this.stage);
			typeDonnee = choix;

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void AnterieurDonneesMultiples(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(DonneesAnterieuresMultiplesController.class.getResource("affichageDonneesMultiples.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			DonneesAnterieuresMultiplesController viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void ChoixTypeDonneesAnterieures(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(ChoixTypeDonneesAnterieuresController.class.getResource("choixTypeDonneesAnterieures.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			ChoixTypeDonneesAnterieuresController viewController = loader.getController();
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void setDonnee(String choix){
		typeDonnee = choix;
	}

	public String getDonnee(){
		return typeDonnee;
	}

	/**
	 * Méthode principale de lancement de l'application.
	 */
	public static void runApp() {
		Application.launch();
	}
}
