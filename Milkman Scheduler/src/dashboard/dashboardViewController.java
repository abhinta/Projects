/**
 * Sample Skeleton for 'dashboardView.fxml' Controller Class
 */

package dashboard;

import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.input.MouseEvent;
import javafx.scene.media.AudioClip;
import javafx.stage.Stage;

public class dashboardViewController {

    @FXML // ResourceBundle that was given to the FXMLLoader
    private ResourceBundle resources;

    @FXML // URL location of the FXML file that was given to the FXMLLoader
    private URL location;

    @FXML
    void doClose(ActionEvent event) {
    	playSound("Door.wav");
    	try {
    		//to hear a sound while exiting
			Thread.sleep(3000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    	System.exit(1);
    }
	URL url;
    AudioClip audio;

    void playSound(String snd)
    {
    	url=getClass().getResource(snd);
		audio=new AudioClip(url.toString());
		audio.play();
    }
    void openFile(String s)
    {
    	try {
    		playSound("Toggle.wav");
			Parent root=FXMLLoader.load(getClass().getClassLoader().getResource(s));
			Scene scene=new Scene(root);
			Stage stage=new Stage();
			stage.setScene(scene);
			stage.show();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    }
    @FXML
    void openAllCustomers(MouseEvent event) {
    	String s="allcustomers/allcustomersView.fxml";
    	openFile(s);
    }

    @FXML
    void openBillPanel(MouseEvent event) {
    	String s="billpanel/billpanelView.fxml";
    	openFile(s);
    }

    @FXML
    void openBillingHistory(MouseEvent event) {
    	String s="billinghistory/billinghistoryView.fxml";
    	openFile(s);
    }

    @FXML
    void openCustomerEntry(MouseEvent event) {
    	String s="customerentry/customerentryView.fxml";
    	openFile(s);
    }

    @FXML
    void openIncomeRecord(MouseEvent event) {
    	String s="incomerecord/incomerecordView.fxml";
    	openFile(s);
    }

    @FXML
    void openPaymentCollection(MouseEvent event) {
    	String s="paymentcollection/paymentcollectionView.fxml";
    	openFile(s);
    }

    @FXML
    void openVariationConsole(MouseEvent event) {
    	String s="variationconsole/variationconsoleView.fxml";
    	openFile(s);
    }

    @FXML
    void openVariationDisplay(MouseEvent event) {
    	String s="variationdisplay/variationdisplayView.fxml";
    	openFile(s);
    }

    @FXML // This method is called by the FXMLLoader when initialization is complete
    void initialize() {

    }
}
