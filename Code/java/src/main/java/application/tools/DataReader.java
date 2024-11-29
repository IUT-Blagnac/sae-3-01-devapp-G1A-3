package application.tools;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.util.ArrayList;
import java.util.List;

public class DataReader {
    public static List<Float> getTemps(List<File> datasToFetch){
        List <Float> tempsToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            try {
                String data = Files.readString(currentFile.toPath());
                data = data.replace("{","").replace("}","");
                String[] splittedValues = data.split(", ");
                tempsToReturn.add(Float.parseFloat(splittedValues[0]));
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
        return tempsToReturn;
    }

    public static float getTemps(File datasToFetch){
        //-275 étant inférieur au 0 absolu, c'est une valeur absurde qui sera détectable de manière automatique
        float tempToReturn = -275;
        try {
            String data = Files.readString(datasToFetch.toPath());
            data = data.replace("{","").replace("}","");
            String[] splittedValues = data.split(", ");
            tempToReturn = Float.parseFloat(splittedValues[0]);
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return tempToReturn;
    }

    public static List<Float> getHumidities(List<File> datasToFetch){

        List <Float> humiditiesToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            try{
                String data = Files.readString(currentFile.toPath());
                data = data.replace("{","").replace("}","");
                String[] splittedValues = data.split(", ");
                humiditiesToReturn.add(Float.parseFloat(splittedValues[1]));
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
        return humiditiesToReturn;
    }

    public static float getHumidities(File datasToFetch){
        float humidityToReturn = -1;
        try {
            String data = Files.readString(datasToFetch.toPath());
            data = data.replace("{","").replace("}","");
            String[] splittedValues = data.split(", ");
            humidityToReturn = Float.parseFloat(splittedValues[1]);
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return humidityToReturn;
    }

    public static List<Float> getCo2(List<File> datasToFetch){
        List <Float> co2ToReturn = new ArrayList<>();
        for(File currentFile : datasToFetch){
            try{
                String data = Files.readString(currentFile.toPath());
                data = data.replace("{","").replace("}","");
                String[] splittedValues = data.split(", ");
                co2ToReturn.add(Float.parseFloat(splittedValues[2]));
            } catch(IOException e){
                throw new RuntimeException(e);
            }
        }
        return co2ToReturn;
    }

    public static float getCo2(File datasToFetch){
        float co2ToReturn = -1;
        try {
            String data = Files.readString(datasToFetch.toPath());
            data = data.replace("{","").replace("}","");
            String[] splittedValues = data.split(", ");
            co2ToReturn = Float.parseFloat(splittedValues[2]);
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
        return co2ToReturn;
    }
}
