package application.tools;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class DataReader {
    public static List<Float> getTemps(List<File> datasToFetch){
        List <Float> tempsToReturn = new ArrayList<>();
        for (File readData : datasToFetch) {
            tempsToReturn.add(getDict(readData).get("temperature"));
        }
        return tempsToReturn;
    }

    public static float getTemps(File datasToFetch){
        //-275 étant inférieur au 0 absolu, c'est une valeur absurde qui sera détectable de manière automatique
        float tempToReturn = -275;
        tempToReturn = getDict(datasToFetch).get("temperature");
        return tempToReturn;
    }

    public static List<Float> getHumidities(List<File> datasToFetch){

        List <Float> humiditiesToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            humiditiesToReturn.add(getDict(currentFile).get("humidity"));
        }
        return humiditiesToReturn;
    }

    public static float getHumidities(File datasToFetch){
        float humidityToReturn = -1;
        humidityToReturn = getDict(datasToFetch).get("humidity");
        return humidityToReturn;
    }

    public static List<Float> getCo2(List<File> datasToFetch){
        List <Float> co2ToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            co2ToReturn.add(getDict(currentFile).get("co2"));
        }
        return co2ToReturn;
    }

    public static float getCo2(File datasToFetch){
        float co2ToReturn = -1;
        co2ToReturn = getDict(datasToFetch).get("co2");
        return co2ToReturn;
    }

    private static Map<String, Float> getDict(File datasToFetch){
        Map<String, Float> dictToReturn = new HashMap<>();
        try {
            String data = Files.readString(datasToFetch.toPath());
            data = data.replace("{","").replace("}","").replace("'","");
            String[] splittedValues = data.split(", |: ");
            for(int i = 0; i<splittedValues.length;i+=2){
                dictToReturn.put(splittedValues[i], Float.parseFloat(splittedValues[i+1]));
            }
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return dictToReturn;
    }
}
