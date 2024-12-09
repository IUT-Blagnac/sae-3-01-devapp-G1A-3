package application.tools;

import org.json.JSONObject;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class DataReader {
    /**
     * Récupère les températures des fichiers donnés.
     * @param datasToFetch Liste des fichiers contenant les données.
     * @return Une liste de valeurs float représentant les températures.
     */
    public static List<Float> getTemps(List<File> datasToFetch){
        List <Float> tempsToReturn = new ArrayList<>();
        for (File readData : datasToFetch) {
            tempsToReturn.add(getDict(readData).get("temperature"));
        }
        return tempsToReturn;
    }

    /**
     * Récupère la température d'un fichier donné.
     * Retourne -275 si la température n'est pas trouvée.
     * @param datasToFetch Le fichier contenant les données.
     * @return La valeur float de la température, ou -275 en cas d'erreur.
     */
    public static float getTemps(File datasToFetch){
        //-275 étant inférieur au 0 absolu, c'est une valeur absurde qui sera détectable de manière automatique
        float tempToReturn = -275;
        tempToReturn = getDict(datasToFetch).get("temperature");
        return tempToReturn;
    }

    /**
     * Récupère les valeurs d'humidité des fichiers donnés.
     * @param datasToFetch Liste des fichiers contenant les données.
     * @return Une liste de valeurs float représentant les humidités.
     */
    public static List<Float> getHumidities(List<File> datasToFetch){

        List <Float> humiditiesToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            humiditiesToReturn.add(getDict(currentFile).get("humidity"));
        }
        return humiditiesToReturn;
    }

    /**
     * Récupère la valeur d'humidité d'un fichier donné.
     * Retourne -1 si l'humidité n'est pas trouvée.
     * @param datasToFetch Le fichier contenant les données.
     * @return La valeur float de l'humidité, ou -1 en cas d'erreur.
     */
    public static float getHumidities(File datasToFetch){
        float humidityToReturn = -1;
        humidityToReturn = getDict(datasToFetch).get("humidity");
        return humidityToReturn;
    }

    /**
     * Récupère les niveaux de CO2 des fichiers donnés.
     * @param datasToFetch Liste des fichiers contenant les données.
     * @return Une liste de valeurs float représentant les niveaux de CO2.
     */
    public static List<Float> getCo2(List<File> datasToFetch){
        List <Float> co2ToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            co2ToReturn.add(getDict(currentFile).get("co2"));
        }
        return co2ToReturn;
    }

    /**
     * Récupère le niveau de CO2 d'un fichier donné.
     * Retourne -1 si le niveau de CO2 n'est pas trouvé.
     * @param datasToFetch Le fichier contenant les données.
     * @return La valeur float du CO2, ou -1 en cas d'erreur.
     */
    public static float getCo2(File datasToFetch){
        float co2ToReturn = -1;
        co2ToReturn = getDict(datasToFetch).get("co2");
        return co2ToReturn;
    }

    /**
     * Transforme le contenu d'un fichier en une carte (Map) de clés et de valeurs.
     * Les clés sont des chaînes de caractères, et les valeurs sont des nombres float.
     * Si une valeur ne peut pas être convertie, elle est ignorée.
     * @param datasToFetch Le fichier contenant les données à lire.
     * @return Une Map avec les données extraites du fichier.
     * @throws RuntimeException en cas d'erreur de lecture du fichier.
     */
    public static Map<String, Float> getDict(File datasToFetch){
        Map<String, Float> dictToReturn = new HashMap<>();
        try {
            String data = Files.readString(datasToFetch.toPath());
            data = data.replace("{","").replace("}","").replace("'","");
            String[] splittedValues = data.split(", |: ");
            for(int i = 0; i<splittedValues.length-1;i+=2){
                try {
                    dictToReturn.put(splittedValues[i], Float.parseFloat(splittedValues[i + 1]));
                } catch (NumberFormatException ignored) {}
            }
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return dictToReturn;
    }

    /**
     * Transforme le contenu d'un fichier JSON contenant des données SolarEdge
     * en une carte (Map) de clés et de valeurs imbriquées.
     * Les clés sont composées du chemin complet (e.g., "parent.enfant").
     * @param datasToFetch Le fichier JSON contenant les données SolarEdge.
     * @return Une Map avec les données extraites et transformées.
     * @throws RuntimeException en cas d'erreur de lecture du fichier.
     */
    public static Map<String, Float> getSolarDict (File datasToFetch){
        Map<String, Float> dictToReturn = new HashMap<>();
        try {
            JSONObject datas = new JSONObject(Files.readString(datasToFetch.toPath()));
            for (String firstKey : datas.keySet()) {
                Object firstValue = datas.get(firstKey);
                if(firstValue instanceof JSONObject currentData){
                    for(String secondKey : currentData.keySet()){
                        Object secondValue = currentData.get(secondKey);
                        dictToReturn.put(firstKey+"."+secondKey, Float.parseFloat(secondValue.toString()));
                    }
                }
            }
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return dictToReturn;
    }

    public static List<Float> getSolarData(List<File> datasToFetch){
        List <Float> dataToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            try {
                String data = Files.readString(currentFile.toPath());
                data = data.replace("{","").replace("}","");
                String[] preSplittedValues = data.split(", ");;
                String[] splittedValues = preSplittedValues[5].split(": ");
                dataToReturn.add(Float.parseFloat(splittedValues[2]));
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
        return dataToReturn;
    }



    public static List<List> getAlertes(List<File> datasToFetch){
        List<List> dataToReturn = new ArrayList<>();
        List<String> listeSalles = new ArrayList<>();
        List<Float> listeSeuil = new ArrayList<>();
        List<Float> listeVal = new ArrayList<>();

        for(File currentFile : datasToFetch){
            try {
                String data = Files.readString(currentFile.toPath());
                data = data.replace("{","").replace("}","");
                String[] splittedValues = data.split(", ");
                
                listeSalles.add(splittedValues[0].split(": ")[1]);
                listeSeuil.add(Float.parseFloat(splittedValues[1].split(": ")[1]));
                listeVal.add(Float.parseFloat(splittedValues[2].split(": ")[1]));

                dataToReturn.add(listeSalles);
                dataToReturn.add(listeSeuil);
                dataToReturn.add(listeVal);
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
        return dataToReturn;
    }
}
