/**
 * Sample Skeleton for 'incomerecordView.fxml' Controller Class
 */

package incomerecord;

import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;

public class incomerecordViewController {

    @FXML // ResourceBundle that was given to the FXMLLoader
    private ResourceBundle resources;

    @FXML // URL location of the FXML file that was given to the FXMLLoader
    private URL location;

    @FXML // fx:id="dtpDoF"
    private DatePicker dtpDoF; // Value injected by FXMLLoader

    @FXML // fx:id="dtpDoT"
    private DatePicker dtpDoT; // Value injected by FXMLLoader

    @FXML // fx:id="lblAmt"
    private Label lblAmt; // Value injected by FXMLLoader

    Connection con;
    @FXML
    void doTotal(ActionEvent event) 
    {
    	try {
			PreparedStatement pst=con.prepareStatement("select sum(amount) from billpanel where status=? and dos>=? and doe<=?");
			pst.setBoolean(1, true);
			pst.setDate(2, java.sql.Date.valueOf(dtpDoF.getValue()));
			pst.setDate(3, java.sql.Date.valueOf(dtpDoT.getValue()));
			ResultSet table=pst.executeQuery();table.next();
			lblAmt.setText(String.valueOf(table.getFloat("sum(amount)")));
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    }

    @FXML // This method is called by the FXMLLoader when initialization is complete
    void initialize() {
       con=DBConnection.doConnect();
    }
}