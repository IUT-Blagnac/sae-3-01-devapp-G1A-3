package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.Node;
import javafx.scene.control.CheckBox;
import javafx.scene.control.TextField;
import javafx.scene.control.TitledPane;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.stage.Stage;
import javafx.scene.input.MouseEvent;


public class DonneesActuellesController {
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
    private Stage containingStage;
    @FXML
    private VBox buttonsHolder;
    @FXML
    private VBox displayedDatas;
    @FXML
    private CheckBox temp;
    @FXML
    private CheckBox co2;
    @FXML
    private CheckBox humidity;

    private IoTMainFrame main = new IoTMainFrame();

    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
        this.buttons_setup();
	}

    public void displayDialog(){
        this.containingStage.show();
    }

    @FXML
    private void menu(){
        main.start(containingStage);
    }

    @FXML
    private void ecranAnterieur(){
        main.changementAnterieur(containingStage);
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


    public void displayedListUpdate(String room){
        Boolean deleted = false;
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
            TitledPane roomdatas = new TitledPane();
            roomdatas.setText(room);
            VBox datasStorage = new VBox();
            datasStorage.setSpacing(5);
            Text tempTitle = new Text(TEXTVALUES.TEMPTITLE.getDisplayText());
            tempTitle.setId(TEXTVALUES.TEMPID.getDisplayText());
            TextField tempRoom = new TextField("Si vous voyez ça, j'ai mal fait mon boulot "+TEXTVALUES.TEMPUNIT.getDisplayText());
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
            TextField co2Room = new TextField("Si vous voyez ça, j'ai mal fait mon boulot "+TEXTVALUES.CO2UNIT.getDisplayText());
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
            TextField humRoom = new TextField("Si vous voyez ça, j'ai mal fait mon boulot "+TEXTVALUES.HUMIDITYUNIT.getDisplayText());
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
        }else displayedDatas.getChildren().remove(toDelete);
    }

    public void buttons_setup(){
        for (Node titledPaneNode : buttonsHolder.getChildren()) {
            if(titledPaneNode instanceof TitledPane titledPane) {
                GridPane gridPane = (GridPane) titledPane.getContent();
                for(Node buttonNode : gridPane.getChildren()){
                    if (buttonNode instanceof ToggleButton button){
                        button.addEventHandler(MouseEvent.MOUSE_CLICKED, event ->  {
                            displayedListUpdate(button.getText());
                        });
                    }
                }
            }
        }
    }
}
