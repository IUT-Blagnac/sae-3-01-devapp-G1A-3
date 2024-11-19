package application.view;


import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;
import model.data.FormattageCellule;
import model.data.Simuler;
import java.util.List;

public class TabViewController {
    
    @FXML
    private TableView<Simuler> tabDonneesEmprunt;
    @FXML
    private TableColumn<Simuler, Integer> colonneMois;
    @FXML
    private TableColumn<Simuler, Double> colonneCapitalRes;
    @FXML
    private TableColumn<Simuler, Double> colonneInterets;
    @FXML
    private TableColumn<Simuler, Double> colonneCapitalRem;
    @FXML
    private TableColumn<Simuler, Double> colonneMensu;
    @FXML
    private TableColumn<Simuler, Double> colonneAssurance;
    @FXML
    private Button btnRetour;
    @FXML
    private Label labelTotalCapitalRem;

    private ObservableList<Simuler> simuler = FXCollections.observableArrayList();

    @FXML
    private void initialize(){

        colonneMois.setCellValueFactory(new PropertyValueFactory<>("duree"));
        colonneCapitalRes.setCellValueFactory(new PropertyValueFactory<>("montant"));
        colonneInterets.setCellValueFactory(new PropertyValueFactory<>("tauxEmprunt"));
        colonneCapitalRem.setCellValueFactory(new PropertyValueFactory<>("capitalRem"));
        colonneMensu.setCellValueFactory(new PropertyValueFactory<>("mensu"));
        colonneAssurance.setCellValueFactory(new PropertyValueFactory<>("tauxAssurance"));

        String pattern = "0.00";
        colonneCapitalRes.setCellFactory(column -> new FormattageCellule<>(pattern));
        colonneInterets.setCellFactory(column -> new FormattageCellule<>(pattern));
        colonneCapitalRem.setCellFactory(column -> new FormattageCellule<>(pattern));
        colonneMensu.setCellFactory(column -> new FormattageCellule<>(pattern));
        colonneAssurance.setCellFactory(column -> new FormattageCellule<>(pattern));
        
        tabDonneesEmprunt.setItems(simuler);
    }

    public void setDonneesEmprunt(List<Simuler> simulationList){
        simuler.clear();
        if (!simulationList.isEmpty()) {
            Simuler last = simulationList.get(simulationList.size() - 1);
            if (Math.abs(last.getMontant()) < 1e-10) {
                last = new Simuler(
                    last.getDuree(), 0, last.getTauxEmprunt(),
                    last.getMensu(), last.getCapitalRem(), last.getTauxAssurance()
                );
                simulationList.set(simulationList.size() - 1, last);
            }
        }
        simuler.addAll(simulationList);
        updateTotalCapitalRem();
    }

    private void updateTotalCapitalRem() {
        double total = simuler.stream().mapToDouble(Simuler::getMensu).sum();
        labelTotalCapitalRem.setText(String.format("Total Remboursé : %.2f €", total));
    }

    @FXML
	private void doCancel() {
		Stage stage = (Stage) btnRetour.getScene().getWindow();
        stage.close();
	}
}
