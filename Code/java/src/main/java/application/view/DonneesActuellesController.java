package application.view;

import application.control.IoTMainFrame;
import application.tools.DataReader;
import javafx.fxml.FXML;
import javafx.scene.Node;
import javafx.scene.control.CheckBox;
import javafx.scene.control.TextField;
import javafx.scene.control.TitledPane;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import javafx.stage.Stage;

import java.io.File;
import java.io.IOException;
import java.net.URISyntaxException;
import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

import netscape.javascript.JSObject;

public class DonneesActuellesController {
    private enum DATA{
        TEMP, CO2, HUM
    }
    private enum TEXTVALUES{
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

        TEXTVALUES(String displayText){
            this.displayText = displayText;
        }

        private String getDisplayText(){
            return displayText;
        }
    }

    public class JSBridge {
        public void handleClick(String room) {
            System.out.println("Room clicked: " + room);
            try {
                displayedListUpdate(room);
            } catch (Exception e) {
                System.out.println("Capteur introuvable.");
            }
        }
    }

    private Stage containingStage;
    @FXML
    private VBox displayedDatas;
    @FXML
    private CheckBox temp;
    @FXML
    private CheckBox co2;
    @FXML
    private CheckBox humidity;

    @FXML
    private WebView iutschematics;
    private WebEngine webEngine;
    private final JSBridge jsBridge = new JSBridge();
    private IoTMainFrame main = new IoTMainFrame();

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
        this.initWeb();
        controlUpdateThread checkingRunnable = new controlUpdateThread();
        Thread checkingThread = new Thread(checkingRunnable);
        checkingThread.start();
	}

    private void initWeb(){
        String pathSvg = Objects.requireNonNull(DonneesActuellesController.class.getClassLoader().getResource("application/svg/demoSVG.html")).toString();

        webEngine = iutschematics.getEngine();
        webEngine.load(pathSvg);

        webEngine.documentProperty().addListener((observable, oldValue, newValue) -> {
            if(newValue != null){
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

    public void displayDialog(){
        this.containingStage.show();
    }

    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }

    @FXML
    private void ecranAnterieur(){
        main.choixTypeDonneesAnterieures(containingStage);
    }

    @FXML
    private void fermer(){
        this.containingStage.close();
    }

    @FXML
    private void updateDisplayedDatas(){
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
        for(Node n : displayedDatas.getChildren()){
            if(n instanceof TitledPane checking){
                if (checking.getText().equals(room)){
                    toDelete = n;
                    deleted = true;
                }
            }
            if(deleted) break;
        }
        if(!deleted) {
            updateRoom(room);
        }else displayedDatas.getChildren().remove(toDelete);
    }

    public void displayedListUpdateSoft(String room) throws Exception {
        updateRoom(room);
    }

    private void updateRoom(String room) throws Exception {
        TitledPane roomdatas = new TitledPane();
        roomdatas.setText(room);
        VBox datasStorage = new VBox();
        datasStorage.setSpacing(5);
        Text tempTitle = new Text(TEXTVALUES.TEMPTITLE.getDisplayText());
        tempTitle.setId(TEXTVALUES.TEMPID.getDisplayText());
        TextField tempRoom = new TextField(getCorrespondingData(room, DATA.TEMP)+ TEXTVALUES.TEMPUNIT.getDisplayText());
        tempRoom.setId(TEXTVALUES.TEMPID.getDisplayText());
        tempRoom.setEditable(false);
        if(!temp.isSelected()){
            tempTitle.setVisible(false);
            tempTitle.setManaged(false);
            tempRoom.setVisible(false);
            tempRoom.setManaged(false);
        }
        Text co2Title = new Text(TEXTVALUES.CO2TITLE.getDisplayText());
        co2Title.setId(TEXTVALUES.CO2ID.getDisplayText());
        TextField co2Room = new TextField(getCorrespondingData(room, DATA.CO2)+ TEXTVALUES.CO2UNIT.getDisplayText());
        co2Room.setId(TEXTVALUES.CO2ID.getDisplayText());
        co2Room.setEditable(false);
        if(!co2.isSelected()){
            co2Title.setVisible(false);
            co2Title.setManaged(false);
            co2Room.setVisible(false);
            co2Room.setManaged(false);
        }
        Text humTitle = new Text(TEXTVALUES.HUMIDITYTITLE.getDisplayText());
        humTitle.setId(TEXTVALUES.HUMIDITYID.getDisplayText());
        TextField humRoom = new TextField(getCorrespondingData(room, DATA.HUM)+ TEXTVALUES.HUMIDITYUNIT.getDisplayText());
        humRoom.setId(TEXTVALUES.HUMIDITYID.getDisplayText());
        humRoom.setEditable(false);
        if(!humidity.isSelected()){
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

    private float getCorrespondingData(String room, DATA toFetch) throws URISyntaxException, IOException, Exception {
        room=room.toUpperCase();
        File folder = new File(Objects.requireNonNull(DonneesActuellesController.class.getClassLoader().getResource("application/AM107/"+room)).toURI());
        if(folder.exists()) {
            File[] allDatas = folder.listFiles();
            assert allDatas != null;
            File captorData = allDatas[0];
            for(File current : allDatas){
                if(current.lastModified() > captorData.lastModified()){
                    captorData = current;
                }
            }
            return switch (toFetch) {
                case CO2 -> DataReader.getCo2(captorData);
                case HUM -> DataReader.getHumidities(captorData);
                case TEMP -> DataReader.getTemps(captorData);
                default -> throw new Exception("Type de donnée inconnue");
            };
        }
        throw new Exception("Erreur de lecture de fichier");
    }

    private class controlUpdateThread implements Runnable{
        boolean terminated;

        public controlUpdateThread(){
            terminated = false;
        }

        @Override
        public void run() {
            Map<File, Integer> fileAmount = new HashMap<>();
            File mainFolder = new File(Objects.requireNonNull(DonneesActuellesController.class.getClassLoader().getResource("application/AM107")).toString());
            for(File folder : Objects.requireNonNull(mainFolder.listFiles())){
                fileAmount.put(folder, Objects.requireNonNull(folder.listFiles()).length);
            }
            while(!terminated){
                for(File folder : Objects.requireNonNull(mainFolder.listFiles())){
                    if(Objects.requireNonNull(folder.listFiles()).length>fileAmount.get(folder)){
                        try {
                            displayedListUpdateSoft(folder.getName().toUpperCase());
                        } catch (Exception e) {
                            throw new RuntimeException(e);
                        }
                    }
                }
            }
        }

        public void stop(){
            this.terminated = true;
        }
    }
}
