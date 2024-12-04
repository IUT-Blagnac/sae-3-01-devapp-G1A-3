package application.tools;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.util.List;
import java.util.Scanner;

public class FichierConfig {
    private List<String> lignes;

    public void setListeLignes(List<String> listeLignes){
        lignes = listeLignes;
    }

    public void replacePeriode(String newPeriode){
        actualiseLignes();
        String nouvLigne = lignes.get(9).split(" = ")[0] + " = ";
        nouvLigne += newPeriode;

        File aSuppr = new File("Code/Python/config.ini");
        aSuppr.delete();
        File nouveau = new File("Code/Python/config.ini");

        try {
            FileWriter wr = new FileWriter(nouveau, true);

            for (int i = 0; i < lignes.size() - 1; i++){
                wr.write(lignes.get(i)+ "\n");
            }
            wr.write(nouvLigne);
            wr.close();
        }
        catch (IOException e) {
            System.out.println("Erreur d'écriture");
        }
    }

    public void replaceDonneesCapteurs(String newTemp, String newHum, String newCo2, int nbValeurs){
        actualiseLignes();
        String nouvLigne = lignes.get(5).split(" = ")[0] + " = ";
        if (newTemp != null){
            nouvLigne += newTemp;
            if (nbValeurs > 1){
                nouvLigne += ", ";
                nbValeurs --;
            }
        }
        if (newHum != null){
            nouvLigne += newHum;
            if (nbValeurs > 1){
                nouvLigne += ", ";
            }
        }
        if (newCo2 != null){
            nouvLigne += newCo2;
        }

        File aSuppr = new File("Code/Python/config.ini");
        aSuppr.delete();
        File nouveau = new File("Code/Python/config.ini");

        try {
            FileWriter wr = new FileWriter(nouveau, true);

            for (int i = 0; i < 5; i++){
                wr.write(lignes.get(i)+ "\n");
            }
            wr.write(nouvLigne + "\n");
            for (int i = 6; i < 10; i ++){
                wr.write(lignes.get(i)+ "\n");
            }
            wr.close();
        }
        catch (IOException e) {
            System.out.println("Erreur d'écriture");
        }
    }



    public void replaceSeuils(String seuilTemp, String seuilHum, String seuilCo2, int nbValeurs){
        actualiseLignes();
        String nouvLigne = lignes.get(8).split(" = ")[0] + " = ";
        if (seuilTemp != null){
            nouvLigne += seuilTemp;
            if (nbValeurs > 1){
                nouvLigne += ", ";
                nbValeurs --;
            }
        }
        if (seuilHum != null){
            nouvLigne += seuilHum;
            if (nbValeurs > 1){
                nouvLigne += ", ";
            }
        }
        if (seuilCo2 != null){
            nouvLigne += seuilCo2;
        }

        File aSuppr = new File("Code/Python/config.ini");
        aSuppr.delete();
        File nouveau = new File("Code/Python/config.ini");

        try {
            FileWriter wr = new FileWriter(nouveau, true);

            for (int i = 0; i < 8; i++){
                wr.write(lignes.get(i)+ "\n");
            }
            wr.write(nouvLigne + "\n");
            wr.write(lignes.get(9)+ "\n");
            wr.close();
        }
        catch (IOException e) {
            System.out.println("Erreur d'écriture");
        }
    }



    public void actualiseLignes(){
        lignes.clear();
        try {
            File myObj = new File("Code/Python/config.ini");
            Scanner myReader = new Scanner(myObj);
            while (myReader.hasNextLine()) {
                String data = myReader.nextLine();
                lignes.add(data);
            }
            myReader.close();
        } catch (FileNotFoundException e) {
            System.out.println("An error occurred.");
            e.printStackTrace();
        }
    }
}
