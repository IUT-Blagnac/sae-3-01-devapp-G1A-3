package application.tools;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.util.List;
import java.util.Scanner;

/**
 * Classe pour gérer et modifier les fichiers de configuration.
 */
public class FichierConfig {
    private List<String> lignes;
    private String cheminConfig = "sae-3-01-devapp-G1A-3/Code/Python/config.ini";

    /**
     * Définit la liste des lignes du fichier de configuration.
     * 
     * @param listeLignes la liste des lignes à définir.
     */
    public void setListeLignes(List<String> listeLignes){
        lignes = listeLignes;
    }

    /**
     * Remplace la période dans le fichier de configuration.
     * 
     * @param newPeriode la nouvelle période à écrire dans le fichier.
     */
    public void replacePeriode(String newPeriode){
        actualiseLignes();
        String nouvLigne = lignes.get(9).split(" = ")[0] + " = ";
        nouvLigne += newPeriode;

        File aSuppr = new File(cheminConfig);
        aSuppr.delete();
        File nouveau = new File(cheminConfig);

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

    /**
     * Remplace les données des capteurs dans le fichier de configuration.
     * 
     * @param newTemp   la nouvelle température à enregistrer, ou null pour conserver l'ancienne.
     * @param newHum    la nouvelle humidité à enregistrer, ou null pour conserver l'ancienne.
     * @param newCo2    le nouveau niveau de CO2 à enregistrer, ou null pour conserver l'ancien.
     * @param nbValeurs le nombre total de valeurs (1 à 3) à insérer.
     */
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

        File aSuppr = new File(cheminConfig);
        aSuppr.delete();
        File nouveau = new File(cheminConfig);

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


    /**
     * Remplace les seuils des capteurs dans le fichier de configuration.
     * 
     * @param seuilTemp le seuil de température à enregistrer, ou null pour conserver l'ancienne valeur.
     * @param seuilHum  le seuil d'humidité à enregistrer, ou null pour conserver l'ancienne valeur.
     * @param seuilCo2  le seuil de CO2 à enregistrer, ou null pour conserver l'ancienne valeur.
     * @param nbValeurs le nombre total de valeurs (1 à 3) à insérer.
     */
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

        File aSuppr = new File(cheminConfig);
        aSuppr.delete();
        File nouveau = new File(cheminConfig);

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


    /**
     * Actualise la liste des lignes en lisant le fichier de configuration actuel.
     */
    public void actualiseLignes(){
        lignes.clear();
        try {
            File myObj = new File(cheminConfig);
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
