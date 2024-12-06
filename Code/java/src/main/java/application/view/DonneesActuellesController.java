package application.view;

import application.control.IoTMainFrame;
import application.tools.DataReader;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.Node;
import javafx.scene.control.*;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import javafx.stage.Stage;

import java.io.File;
import java.io.IOException;
import java.net.URISyntaxException;
import java.nio.file.*;
import java.util.Arrays;
import java.util.Comparator;
import java.util.Map;
import java.util.Objects;

import netscape.javascript.JSObject;

public class DonneesActuellesController {
    private enum DATA {
        TEMP, CO2, HUM
    }

    private enum TEXTVALUES {
        TEMPTITLE("Température : "),
        TEMPID("Temp"),
        TEMPUNIT("°C"),
        CO2TITLE("Co2 : "),
        CO2ID("Co2"),
        CO2UNIT("ppm"),
        HUMIDITYTITLE("Humidité : "),
        HUMIDITYID("Hum"),
        HUMIDITYUNIT("%");

        private final String displayText;

        TEXTVALUES(String displayText) {
            this.displayText = displayText;
        }

        private String getDisplayText() {
            return displayText;
        }
    }

    public class JSBridge {
        public void handleClick(String room) {
            try {
                displayedListUpdate(room);
            } catch (Exception e) {
                System.out.println("Capteur introuvable.");
            }
        }
    }

    private Node webviewerMemory;
    private Node displayedDatasMemory;
    private TitledPane solarEdgeDataMemory;

    private Stage containingStage;
    @FXML
    private BorderPane mainContainer;
    @FXML
    private VBox displayedDatas;
    @FXML
    private VBox alerts;
    @FXML
    private VBox warnings;
    @FXML
    private CheckBox temp;
    @FXML
    private CheckBox co2;
    @FXML
    private CheckBox humidity;

    @FXML
    private RadioMenuItem am107;
    @FXML
    private RadioMenuItem solaredge;

    @FXML
    private void changeInterface() throws Exception {
        if (am107.isSelected()) {
            if (mainContainer.getCenter() instanceof TitledPane) {
                solarEdgeDataMemory = (TitledPane) mainContainer.getCenter();
                mainContainer.setCenter(webviewerMemory);
                mainContainer.setRight(displayedDatasMemory);
            }
        } else if (solaredge.isSelected()) {
            if (mainContainer.getCenter() instanceof ScrollPane) {
                webviewerMemory = mainContainer.getCenter();
                displayedDatasMemory = mainContainer.getRight();
                mainContainer.setCenter(solarEdgeDataMemory);
                mainContainer.setRight(null);
            }
        } else {
            throw new Exception("Une a été rencontrée lors de la séléction des capteurs.");
        }
    }

    @FXML
    private WebView iutschematics;
    private WebEngine webEngine;
    private final JSBridge jsBridge = new JSBridge();
    private IoTMainFrame main = new IoTMainFrame();

    public void initContext(Stage _containingStage) {
        this.containingStage = _containingStage;
        solarEdgeDataMemory = new TitledPane();
        setUpSolaredge();
        this.initWeb();
        controlUpdateThread checkingRunnable = new controlUpdateThread(this);
        Thread checkingThread = new Thread(checkingRunnable);
        checkingThread.start();
        containingStage.setOnCloseRequest(event -> checkingRunnable.stop());
        /*
         Test pour les notifications
         */
        newWarning("b113");
        newWarning("B113");
    }

    private void setUpSolaredge() {
        System.out.println("set up...");
        solarEdgeDataMemory.setText("Solaredge");
        solarEdgeDataMemory.setCollapsible(false);
        solarEdgeDataMemory.setExpanded(true);
        solarEdgeDataMemory.setId("solaredge");

        if (solarEdgeDataMemory.getContent() == null) {
            solarEdgeDataMemory.setContent(new VBox());
        }

        try {
            File solarEdgefolder = new File(Objects.requireNonNull(DonneesActuellesController.class.getClassLoader()
                    .getResource("application/capteur/solaredge")).toURI());
            File[] files = Objects.requireNonNull(solarEdgefolder.listFiles());

            // Identify the latest file
            File latestFile = Arrays.stream(files)
                    .max(Comparator.comparing(File::lastModified))
                    .orElseThrow(() -> new RuntimeException("No files found in directory"));

            Map<String, Float> solarDatas = DataReader.getSolarDict(latestFile);

            // Update the UI
            Platform.runLater(() -> {
                VBox container = (VBox) solarEdgeDataMemory.getContent();
                container.getChildren().clear(); // Clear old elements

                // Add new elements
                Text powerLabel = new Text("Puissance actuelle");
                TextField powerValue = new TextField(solarDatas.get("currentPower.power") + " Watts");
                powerValue.setEditable(false);
                container.getChildren().addAll(powerLabel, powerValue);
            });

        } catch (Exception e) {
            System.out.println("Error in setUpSolaredge: " + e.getMessage());
        }
    }

    private void initWeb() {
        String pathSvg = Objects.requireNonNull(DonneesActuellesController.class.getClassLoader().getResource("application/svg/demoSVG.html")).toString();

        webEngine = iutschematics.getEngine();
        webEngine.load(pathSvg);

        webEngine.documentProperty().addListener((observable, oldValue, newValue) -> {
            if (newValue != null) {
                JSObject window = (JSObject) webEngine.executeScript("window");
                window.setMember("javaBridge", jsBridge);

                webEngine.executeScript("""
                            document.querySelectorAll('g').forEach(function(element) {
                                element.addEventListener('click', function(event) {
                                    // Get the id of the <g> element itself
                                    var id = element.getAttribute('id');
                                    // Pass the id to the Java method
                                    javaBridge.handleClick(id);
                                });
                            });
                        """);
            }
        });
    }

    public void displayDialog() {
        this.containingStage.show();
    }

    public void setMain(IoTMainFrame newMain) {
        main = newMain;
    }

    @FXML
    private void menu() {
        main.start(containingStage);
    }

    @FXML
    private void ecranAnterieur() {
        main.choixTypeDonneesAnterieures(containingStage);
    }

    @FXML
    private void fermer() {
        this.containingStage.close();
    }

    @FXML
    private void updateDisplayedDatas() {
        for (Node titledPaneNode : displayedDatas.getChildren()) {
            if (titledPaneNode instanceof TitledPane titledPane) {
                VBox container = (VBox) titledPane.getContent();
                for (Node textualNode : container.getChildren()) {
                    if (textualNode instanceof Text text) {
                        if (text.getId().equals(TEXTVALUES.TEMPID.getDisplayText())) {
                            text.setVisible(temp.isSelected());
                            text.setManaged(temp.isSelected());
                        }
                        if (text.getId().equals(TEXTVALUES.CO2ID.getDisplayText())) {
                            text.setVisible(co2.isSelected());
                            text.setManaged(co2.isSelected());
                        }
                        if (text.getId().equals(TEXTVALUES.HUMIDITYID.getDisplayText())) {
                            text.setVisible(humidity.isSelected());
                            text.setManaged(humidity.isSelected());
                        }
                    } else if (textualNode instanceof TextField field) {
                        if (field.getId().equals("Temp")) {
                            field.setVisible(temp.isSelected());
                            field.setManaged(temp.isSelected());
                        }
                        if (field.getId().equals("Co2")) {
                            field.setVisible(co2.isSelected());
                            field.setManaged(co2.isSelected());
                        }
                        if (field.getId().equals("Hum")) {
                            field.setVisible(humidity.isSelected());
                            field.setManaged(humidity.isSelected());
                        }
                    }
                }
            }
        }
    }


    public void displayedListUpdate(String room) throws Exception {
        boolean deleted = false;
        Node toDelete = null;
        for (Node n : displayedDatas.getChildren()) {
            if (n instanceof TitledPane checking) {
                if (checking.getText().equals(room.toUpperCase())) {
                    toDelete = n;
                    deleted = true;
                }
            }
            if (deleted) break;
        }
        if (!deleted) {
            updateRoom(room);
        } else displayedDatas.getChildren().remove(toDelete);
    }

    public void displayedListUpdateSoft(String room) throws Exception {
        updateRoom(room);
    }

    private void updateRoom(String room) throws Exception {
        TitledPane roomdatas = new TitledPane();
        roomdatas.setText(room.toUpperCase());
        VBox datasStorage = new VBox();
        datasStorage.setSpacing(5);
        Text tempTitle = new Text(TEXTVALUES.TEMPTITLE.getDisplayText());
        tempTitle.setId(TEXTVALUES.TEMPID.getDisplayText());
        TextField tempRoom = new TextField(getCorrespondingData(room, DATA.TEMP) + TEXTVALUES.TEMPUNIT.getDisplayText());
        tempRoom.setId(TEXTVALUES.TEMPID.getDisplayText());
        tempRoom.setEditable(false);
        if (!temp.isSelected()) {
            tempTitle.setVisible(false);
            tempTitle.setManaged(false);
            tempRoom.setVisible(false);
            tempRoom.setManaged(false);
        }
        Text co2Title = new Text(TEXTVALUES.CO2TITLE.getDisplayText());
        co2Title.setId(TEXTVALUES.CO2ID.getDisplayText());
        TextField co2Room = new TextField(getCorrespondingData(room, DATA.CO2) + TEXTVALUES.CO2UNIT.getDisplayText());
        co2Room.setId(TEXTVALUES.CO2ID.getDisplayText());
        co2Room.setEditable(false);
        if (!co2.isSelected()) {
            co2Title.setVisible(false);
            co2Title.setManaged(false);
            co2Room.setVisible(false);
            co2Room.setManaged(false);
        }
        Text humTitle = new Text(TEXTVALUES.HUMIDITYTITLE.getDisplayText());
        humTitle.setId(TEXTVALUES.HUMIDITYID.getDisplayText());
        TextField humRoom = new TextField(getCorrespondingData(room, DATA.HUM) + TEXTVALUES.HUMIDITYUNIT.getDisplayText());
        humRoom.setId(TEXTVALUES.HUMIDITYID.getDisplayText());
        humRoom.setEditable(false);
        if (!humidity.isSelected()) {
            humTitle.setVisible(false);
            humTitle.setManaged(false);
            humRoom.setVisible(false);
            humRoom.setManaged(false);
        }
        datasStorage.getChildren().addAll(tempTitle, tempRoom, co2Title, co2Room, humTitle, humRoom);
        roomdatas.setContent(datasStorage);
        displayedDatas.getChildren().add(roomdatas);
        roomdatas.setExpanded(true);
    }

    private float getCorrespondingData(String room, DATA toFetch) throws Exception {
        room = room.toUpperCase();
        File folder = new File(Objects.requireNonNull(DonneesActuellesController.class.getClassLoader().getResource("application/capteur/AM107/" + room)).toURI());
        if (folder.exists()) {
            File[] allDatas = folder.listFiles();
            assert allDatas != null;
            File captorData = allDatas[0];
            for (File current : allDatas) {
                if (current.lastModified() > captorData.lastModified()) {
                    captorData = current;
                }
            }
            return switch (toFetch) {
                case CO2 -> DataReader.getCo2(captorData);
                case HUM -> DataReader.getHumidities(captorData);
                case TEMP -> DataReader.getTemps(captorData);
            };
        }
        throw new Exception("Erreur de lecture de fichier");
    }

    private void newWarning(String room) {
        boolean exists = false;
        for (Node existingrooms : warnings.getChildren()) {
            if (existingrooms instanceof Button) {
                if (existingrooms.getId().equals(room.toLowerCase())) {
                    exists = true;
                }
            }
        }
        if (!exists) {
            Button warningRoom = notificationHandle(room);
            this.warnings.getChildren().add(warningRoom);
        }
    }

    private void newAlert(String room) {
        boolean exists = false;
        for (Node existingrooms : alerts.getChildren()) {
            if (existingrooms instanceof Button) {
                if (existingrooms.getId().equals(room.toLowerCase())) {
                    exists = true;
                }
            }
        }
        if (!exists) {
            Button alertButton = notificationHandle(room);
            this.alerts.getChildren().add(alertButton);
        }
    }

    private Button notificationHandle(String room) {
        Button newButton = new Button();
        newButton.setText(room.toUpperCase());
        newButton.setId(room.toLowerCase());
        newButton.setMaxHeight(Double.MAX_VALUE);
        newButton.setMaxWidth(Double.MAX_VALUE);
        newButton.addEventHandler(MouseEvent.MOUSE_CLICKED, event -> {
                    try {
                        displayedListUpdate(room);
                    } catch (Exception e) {
                        throw new RuntimeException(e);
                    }
                }
        );
        return newButton;
    }

    private static class controlUpdateThread implements Runnable {
        boolean terminated;
        DonneesActuellesController controller;

        controlUpdateThread(DonneesActuellesController controller) {
            this.terminated = false;
            this.controller = controller;
        }

        public void run() {
            // Récupérer le chemin du dossier dans les ressources
            Path resourcePath;
            try {
                resourcePath = Path.of(DonneesActuellesController.class.getClassLoader().getResource("application/capteur/solaredge").toURI());
            } catch (URISyntaxException e) {
                throw new RuntimeException(e);
            }

            // Vérifier que le dossier existe
            if (!Files.exists(resourcePath) || !Files.isDirectory(resourcePath)) {
                System.out.println("Le dossier n'existe pas : " + resourcePath);
                return;
            }

            // Initialiser le WatchService
            WatchService watchService;
            try {
                watchService = FileSystems.getDefault().newWatchService();
                resourcePath.register(watchService, StandardWatchEventKinds.ENTRY_CREATE,
                        StandardWatchEventKinds.ENTRY_DELETE, StandardWatchEventKinds.ENTRY_MODIFY);
            } catch (IOException e) {
                throw new RuntimeException(e);
            }

            // Compter initialement les fichiers
            int previousFileCount = countFilesInDirectory(resourcePath);
            System.out.println("Nombre initial de fichiers : " + previousFileCount);

            System.out.println("Surveillance du dossier : " + resourcePath);

            while (true) {
                try {
                    // Attendre un événement
                    WatchKey key = watchService.take();
                    for (WatchEvent<?> event : key.pollEvents()) {
                        // Type de changement
                        WatchEvent.Kind<?> kind = event.kind();

                        // Nom du fichier modifié
                        Path changedFile = (Path) event.context();
                        System.out.println("Changement détecté : " + kind.name() + " -> " + changedFile);
                        Platform.runLater(() -> controller.setUpSolaredge());
                        // Recompter les fichiers
                        int currentFileCount = countFilesInDirectory(resourcePath);
                        if (currentFileCount != previousFileCount) {
                            System.out.println("Le nombre de fichiers a changé ! Nouveau nombre : " + currentFileCount);
                            previousFileCount = currentFileCount;
                        }
                    }
                    // Réinitialiser la clé
                    boolean valid = key.reset();
                    if (!valid) {
                        System.out.println("La clé WatchService n'est plus valide. Arrêt.");
                        break;
                    }
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                    System.out.println("Surveillance interrompue.");
                    break;
                }
            }

        }
        // Méthode pour compter les fichiers dans un dossier
        private static int countFilesInDirectory(Path path) {
            try {
                return (int) Files.list(path).filter(Files::isRegularFile).count();
            } catch (IOException e) {
                System.out.println("Erreur lors du comptage des fichiers : " + e.getMessage());
                return -1;
            }
        }

        public void stop() {
            this.terminated = true;
        }
    }
}

