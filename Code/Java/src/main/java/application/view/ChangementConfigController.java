package application.view;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Scanner;

import application.control.IoTMainFrame;
import application.tools.FichierConfig;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.scene.control.CheckMenuItem;
import javafx.scene.control.MenuButton;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.stage.Stage;

public class ChangementConfigController {
    
    private int nbValeurs = 0;
    private String temp;
    private String hum;
    private String co2;

    private Stage containingStage;
    private IoTMainFrame main;
    private List<String> listeLignes =  new ArrayList<>();
    private FichierConfig file = new FichierConfig();
    private HashMap<String, String> seriesMap = new HashMap<>();

    @FXML
    private HBox dataSolaredge;
    
    @FXML
    private HBox dataCapteurs;

    @FXML
    private TextField periode;

    @FXML
    private TextField alerteHum;

    @FXML
    private TextField alerteTemp;

    @FXML
    private TextField alerteCO2;



    public void initContext(Stage _containingStage) {
		this.containingStage = _containingStage;
	}

    public void displayDialog(){
        lireConfig();
        menuDonneesPanneauxSolaires();
        menuDonneesCapteurs();
        file.setListeLignes(listeLignes);
        setValeurs();
        this.containingStage.show();
    }

    public void setMain(IoTMainFrame newMain){
        main = newMain;
    }



    public void lireConfig(){
        try {
            File myObj = new File("sae-3-01-devapp-G1A-3/Code/Python/config.ini");
            Scanner myReader = new Scanner(myObj);
            while (myReader.hasNextLine()) {
                String data = myReader.nextLine();
                listeLignes.add(data);
        }
        myReader.close();
        } catch (FileNotFoundException e) {
            System.out.println("An error occurred.");
            e.printStackTrace();
        }
    }



    public void menuDonneesPanneauxSolaires(){
        final String sMenuTextStart = "Panneaux solaires";
        final MenuButton choices = new MenuButton(sMenuTextStart);
        final List<CheckMenuItem> items = new ArrayList<>();

        
        String[] donnees = {"all"};

        for (String donnee : donnees){
            CheckMenuItem bouton = new CheckMenuItem(donnee);
            bouton.setOnAction(new EventHandler<ActionEvent>() {
                public void handle(ActionEvent e) {
                    if (bouton.isSelected()){
                        seriesMap.put(donnee + "Selected", donnee);
                    }
                    else{
                        seriesMap.remove(donnee + "Selected");
                    }
                }
            });
            items.add(bouton);
        }
        choices.getItems().addAll(items);
        dataSolaredge.getChildren().add(choices);
        HBox.setMargin(choices, new Insets(0,0,0,20));
    }



    public void menuDonneesCapteurs(){

        final String sMenuTextStart = "AM-107";
        final MenuButton choices = new MenuButton(sMenuTextStart);
        final List<CheckMenuItem> items = new ArrayList<>();

        String[] donnees = {"temperature", "humidity", "co2"};

        for (String donnee : donnees){
            CheckMenuItem bouton = new CheckMenuItem(donnee);
            bouton.setOnAction(new EventHandler<ActionEvent>() {
                public void handle(ActionEvent e) {
                    if (bouton.isSelected()){
                        seriesMap.put(donnee + "Selected", donnee);
                    }
                    else{
                        seriesMap.remove(donnee + "Selected");
                    }
                }
            });
            items.add(bouton);
        }
        choices.getItems().addAll(items);
        dataCapteurs.getChildren().add(choices);
        HBox.setMargin(choices, new Insets(0,0,0,20));
    }



    public void setValeurs(){
        String valeurs = listeLignes.get(8).split(" = ")[1];
        
        alerteTemp.setText(valeurs.split(", ")[0]);
        alerteHum.setText(valeurs.split(", ")[1]);
        alerteCO2.setText(valeurs.split(", ")[2]);
        periode.setText(listeLignes.get(9).split(" = ")[1]);
    }


    @FXML
    private void valider(){
        if (periode.getText() != listeLignes.get(9).split(" = ")[1]){
            file.replacePeriode(periode.getText());
        }

        temp = seriesMap.get("temperatureSelected");
        hum = seriesMap.get("humiditySelected");
        co2 = seriesMap.get("co2Selected");

        if (temp !=  null){
            nbValeurs ++;
        }
        if (hum !=  null){
            nbValeurs ++;
        }
        if (co2 !=  null){
            nbValeurs ++;
        }

        if (nbValeurs > 0){
            file.replaceDonneesCapteurs(temp, hum, co2, nbValeurs);
        }

        temp = alerteTemp.getText();
        hum = alerteHum.getText();
        co2 = alerteCO2.getText();

        if (temp !=  null){
            nbValeurs ++;
        }
        if (hum !=  null){
            nbValeurs ++;
        }
        if (co2 !=  null){
            nbValeurs ++;
        }

        if (nbValeurs > 0){
            file.replaceSeuils(temp, hum, co2, nbValeurs);
        }
        
        main.start(containingStage);
    }

    @FXML
    private void annuler(){
        main.start(containingStage);
    }
}
