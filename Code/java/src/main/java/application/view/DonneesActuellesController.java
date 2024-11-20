package application.view;

import application.control.IoTMainFrame;
import javafx.fxml.FXML;
import javafx.scene.Node;
import javafx.scene.control.TextField;
import javafx.scene.control.TitledPane;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.stage.Stage;
import javafx.scene.input.MouseEvent;


public class DonneesActuellesController {
    private Stage containingStage;
    @FXML
    private VBox buttonsHolder;
    @FXML
    private VBox displayedDatas;

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
            Text tempTitle = new Text("Température : ");
            TextField tempRoom = new TextField("Si vous voyez ça, j'ai mal fait mon boulot °C");
            tempRoom.setEditable(false);
            Text co2Title = new Text("Taux de Co2 : ");
            TextField co2Room = new TextField("Si vous voyez ça, j'ai mal fait mon boulot ppm");
            co2Room.setEditable(false);
            Text humTitle = new Text("Humidité : ");
            TextField humRoom = new TextField("Si vous voyez ça, j'ai mal fait mon boulot %");
            humRoom.setEditable(false);
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
