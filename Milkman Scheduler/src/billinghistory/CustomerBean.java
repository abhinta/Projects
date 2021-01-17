package billinghistory;

public class CustomerBean {
	String name;
	String Bdos;
	String Bdoe;
	float Bamt;
	float Bcqty;
	float Bbqty;
	String Bstatus;
	
	public CustomerBean(){}

	public CustomerBean(String name, String bdos, String bdoe, float bamt, float bcqty, float bbqty, String bstatus) {
		super();
		this.name = name;
		Bdos = bdos;
		Bdoe = bdoe;
		Bamt = bamt;
		Bcqty = bcqty;
		Bbqty = bbqty;
		Bstatus = bstatus;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getBdos() {
		return Bdos;
	}

	public void setBdos(String bdos) {
		Bdos = bdos;
	}

	public String getBdoe() {
		return Bdoe;
	}

	public void setBdoe(String bdoe) {
		Bdoe = bdoe;
	}

	public float getBamt() {
		return Bamt;
	}

	public void setBamt(float bamt) {
		Bamt = bamt;
	}

	public float getBcqty() {
		return Bcqty;
	}

	public void setBcqty(float bcqty) {
		Bcqty = bcqty;
	}

	public float getBbqty() {
		return Bbqty;
	}

	public void setBbqty(float bbqty) {
		Bbqty = bbqty;
	}

	public String getBstatus() {
		return Bstatus;
	}

	public void setBstatus(String bstatus) {
		Bstatus = bstatus;
	}
	
}
