package application.control;

import java.io.IOException;
import java.time.LocalDate;
import java.util.List;

import application.view.ChangementConfigController;
import application.view.ChoixTypeDonneesAnterieuresController;
import application.view.DonneesActuellesController;
import application.view.DonneesAnterieuresController;
import application.view.MenuController;
import application.view.SolaredgeAnterieurController;
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
	

	/**
	 * Méthode de lancement du programme Python
	 */
	public void lanceurPython(){
		PythonRunnable pRunnable = new PythonRunnable();
		Thread pythonThread = new Thread(pRunnable);
		pythonThread.start();
	}

	
	/**
	 * Méthode de lancement de la page des données actuelles
	 */
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


	/**
	 * Méthode de lancement de la page des données antérieures des capteurs
	 */
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


	/**
	 * Méthode de lancement de la page des données antérieures des panneaux solaires
	 */
	public void AnterieurSolaredge(Stage primaryStage, LocalDate dateDebut, LocalDate dateFin) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(SolaredgeAnterieurController.class.getResource("solaredgeAnterieur.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);
			this.stage.setTitle("Données anciennes");

			SolaredgeAnterieurController viewController = loader.getController();
			viewController.setMain(this);
			viewController.setDateDebut(dateDebut);
			viewController.setDateFin(dateFin);
			viewController.initContext(this.stage);

			viewController.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}


	/**
	 * Méthode de lancement de la page du choix des données antérieures à afficher
	 */
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


	/**
	 * Méthode de lancement de la page du changement du fichier de configuration
	 */
	public void changementConfig(Stage primaryStage) {
		this.stage = primaryStage;

		try {
			// Chargement du source fxml
			FXMLLoader loader = new FXMLLoader(ChangementConfigController.class.getResource("changementConfig.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root);

			this.stage.setScene(scene);

			ChangementConfigController viewController = loader.getController();
			viewController.setMain(this);
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



	public class PythonRunnable implements Runnable {
		@Override
		/**
		* Méthode définissant le travail du thread (exécuter le Python)
		*/
		public void run() {
			String chemin = "Code/Python/clientMQTT.py";
			ProcessBuilder processBuilder = new ProcessBuilder();
			processBuilder.command("python", chemin);

			Process p;
			try {
				p = processBuilder.start();
				p.getErrorStream().transferTo(System.out);
				p.getInputStream().transferTo(System.out);
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
}
