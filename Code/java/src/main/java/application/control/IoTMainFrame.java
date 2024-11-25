package application.control;

import java.time.LocalDate;
import java.util.List;

import application.view.ChoixTypeDonneesAnterieuresController;
import application.view.DonneesActuellesController;
import application.view.DonneesAnterieuresController;
import application.view.MenuController;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
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

	public void changementActuel(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(DonneesActuellesController.class.getResource("affichageTpsReel.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données actuelles");

			DonneesActuellesController viewController = loader.getController();
			viewController.setMain(this);
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void AnterieurDonneeUnique(Stage primaryStage, List<String> choix, LocalDate dateDebut, LocalDate dateFin) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(DonneesAnterieuresController.class.getResource("affichageDonneesAnterieures.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			DonneesAnterieuresController viewController = loader.getController();
			viewController.setMain(this);
			viewController.setDonnees(choix);
			viewController.setDateDebut(dateDebut);
			viewController.setDateFin(dateFin);
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	public void choixTypeDonneesAnterieures(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(ChoixTypeDonneesAnterieuresController.class.getResource("choixTypeDonneesAnterieures.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			ChoixTypeDonneesAnterieuresController viewController = loader.getController();
			viewController.setMain(this);
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
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
