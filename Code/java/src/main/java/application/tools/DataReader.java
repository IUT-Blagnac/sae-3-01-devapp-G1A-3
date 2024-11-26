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

    public static List<Float> getHumidites(List<File> datasToFetch){
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
}
