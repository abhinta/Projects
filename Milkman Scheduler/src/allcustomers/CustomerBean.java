package allcustomers;

public class CustomerBean 
{
	String name;
	float cprice;
	float cqty;
	float bprice;
	float bqty;
	String dos;
	
	public CustomerBean(){}
	public CustomerBean(String name, float cprice, float cqty, float bprice, float bqty, String dos) {
		super();
		this.name = name;
		this.cprice = cprice;
		this.cqty = cqty;
		this.bprice = bprice;
		this.bqty = bqty;
		this.dos = dos;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public float getCprice() {
		return cprice;
	}
	public void setCprice(float cprice) {
		this.cprice = cprice;
	}
	public float getCqty() {
		return cqty;
	}
	public void setCqty(float cqty) {
		this.cqty = cqty;
	}
	public float getBprice() {
		return bprice;
	}
	public void setBprice(float bprice) {
		this.bprice = bprice;
	}
	public float getBqty() {
		return bqty;
	}
	public void setBqty(float bqty) {
		this.bqty = bqty;
	}
	public String getDos() {
		return dos;
	}
	public void setDos(String dos) {
		this.dos = dos;
	}
}
