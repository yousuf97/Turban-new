<?php
class Frontend extends Admin_Controller
{
    public function __construct()
    {
        parent ::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_getrows');
		$this->load->model('Model_products');
        $this->load->library('Cart');
        $this->load->library('session');
      // error_reporting(0);
    }
    function index()
    {
       // $user_data=$this->session->all_userdata(); 
    // print_r($user_data);
        $this->template->load('main_view','home');
    }
	function about() {
		$this->template->load('main2','front_end/about');
	}
	function chefs() {
		$this->template->load('main2','front_end/chefs');
	}
	function blog() {
		$this->template->load('main2','front_end/blog');
	}
	function login() {
		$this->template->load('main2','front_end/login_form');
	}
	function register() {
        $this->template->load('main2','front_end/create_account');
    }
    function res() {
        $this->template->load('main2','front_end/res');
    }
	/*function single_blog() {
		$this->template->load('main2','front_end/single_blog');
	}*/
    function menu()
    {
        $fields='*';
        $tablename='products';
        $prod['prods'] = $this->Model_getrows->get_items($fields,$tablename);
        $fields='*';
        $tablename='category';
        $prod['categs'] = $this->Model_getrows->get_items($fields,$tablename);
        $this->template->load('main2','front_end/menu.php',$prod);
        // print_r($this->session->userdata());  
    }
	
	function nizami_menu() {
		//echo $this->uri->segment(2);
		$output['id'] = $this->uri->segment(2);
		$this->template->load('main2','front_end/products',$output);
		
	}
    function contact()
    {
        $this->template->load('main2','front_end/contact');
    }
    function get_menu_by_id()
    {
        $pass_values['id']=$this->input->post('id');
        $this->load->view('front_end/get_menus',$pass_values);
    }
    // add to cart
    function save_cart() {
       // print_r($_POST);
        $data = array();
        $product_id = $this->input->post('item_id');
        $get_prod = $this->Model_getrows->get_product_by_id($product_id); 
        $data=array(
            'id'=>$get_prod->id,
            'name'=>$get_prod->name,
            'price'=>$get_prod->price,
            'qty'=>'1',
            'image'=>$get_prod->image
        );
       $cart= $this->cart->insert($data); //print_r($this->cart->contents());
      if($cart)
      {
        echo 'Item added to Cart';
      }
      else
      {
        echo 'Item not added';
      }
      // redirect('menu');
    }
    function cart()
    {
        $data['cart_contents']=$this->cart->contents();
        $this->template->load('main2','front_end/cart',$data);
    }
    function update_cart() {
        $data = array();
        $data['qty'] = $this->input->post('qty');
        $data['rowid'] = $this->input->post('rowid');
        $update=$this->cart->update($data);#echo $this->db->last_query();
        if($update)
        {
            echo 'Item Quantity updated to the Cart';
        }
        else
        {
            echo 'Item Quantity not updated to the Cart';
        }
       //redirect('cart');
    }
    function remove_cart() {
        $data = $this->input->post('rowid');
        $remove=$this->cart->remove($data);
        if($remove)
        {
            echo 'Item has been removed.';
        }
        else
        {
            echo 'Item Quantity not updated to the Cart';
        }
        //redirect('cart');
    }
	function checkout()
    {
        $this->template->load('main2','front_end/checkout');
    }
    function registration()
    {
        $oupt['url']='checkout';
        $this->template->load('main2','front_end/registration',$oupt);
    }
    function registration_front()
    {
        $oupt['url']='login';
        $this->template->load('main2','front_end/registration',$oupt);
    }
    function register_action()
    {
        $url=$this->input->post('url');
        $register=$this->input->post('register');
        // print_r($register);
        $register['address']='';
         $insert=$this->Model_getrows->common_insert('register',$register);
         //echo $this->db->last_query();
        if($insert)
        {
            $logged_in_sess = array(
                        'user_id'=>$insert,
                        'user_name'=>$register['name'],
                        'user_email'=>$register['email'],
                        'user_contact'=>$register['phone'],
                        
                        'log_in' => TRUE
                    );
                    $this->session->set_userdata($logged_in_sess);
					//$user_data=$this->session->all_userdata();	
					$cart_contents=$this->cart->contents();
					if(!$cart_contents){
						redirect('/');
					} else {
						redirect('checkout');  
					}
        }
        else
        {
            echo 'n';
        }
    }
    function login_action()
    {
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $email_exists = $this->Model_getrows->check_email($email);
        if($email_exists==1)
        {
           $login = $this->Model_getrows->login($email, $password);
           if($login)
           {
               $logged_in_sess = array(
                        'user_id'=>$login['id'],
                        'user_name'  => $login['name'],
                        'user_email'     => $login['email'],
						'user_contact'=>$login['phone'],
                        'log_in' => TRUE
                    );
                $this->session->set_userdata($logged_in_sess);  
               //echo 's';
			   $cart_contents=$this->cart->contents();
			   if(!$cart_contents){
				redirect('/');
			   } else {
				   redirect('checkout');  
			   }
           }
           else
           {
               $this->data['errors'] = 'Incorrect username/password combination';
                echo 'Incorrect username/password combination';
           }
        }
        else
        {
            $this->data['errors'] = 'Email does not exists';
                echo 'Email does not exists';
        }
          
        
    }
    function login_action_front()
    {
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $email_exists = $this->Model_getrows->check_email($this->input->post('email'));
            if($email_exists == TRUE) {
                $login = $this->Model_getrows->login($this->input->post('email'), $this->input->post('password'));
//print_r($login);
                if($login) {
                    $logged_in_sess = array(
                        'user_id'=>$login['id'],
                        'user_name'  => $login['name'],
                        'user_email'     => $login['email'],
                        'phone'=>$login['phone'],
                        'address'=>$login['address'],
                        'log_in' => TRUE
                    );
                    $this->session->set_userdata($logged_in_sess);
                    redirect('Frontend/index');
                    // print_r($logged_in_sess);
                }
                else {
                    $this->data['errors'] = 'Incorrect username/password combination';
                    echo 'Incorrect username/password combination';
                }
            }
            else {
                $this->data['errors'] = 'Email does not exists';
                echo 'Email does not exists';
            }   
        }
        else {
            echo 'Please fill the fields';
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        ?>
        <script type="text/javascript">
            alert("Loguout successfully");
            window.location.replace('../');
        </script>
        <?php
        // redirect('index');
    }
    
    function checkout_action()
    { 
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $checkout_p=$this->session->all_userdata();
		$prod_array=array();
        $cart_contents=$this->cart->contents();
        //print_r($cart_contents);
        foreach($cart_contents as $cc)
        {
            $item_array=array(
                'prod_id'=>$cc['id'],
                'prod_name'=>$cc['name'],
                'qty'=>$cc['qty'],
                'price'=>$cc['price'],
                'image'=>$cc['image']
            );
            array_push($prod_array,$item_array);
        }
        $checkout=$this->input->post('checkout');
		#print_r($checkout);
        date_default_timezone_set("Asia/Qatar");
        $checkout['user_id']=$checkout_p['user_id'];
        $checkout['bill_no']=$bill_no;
        $checkout['checkout_time']=date('H:i:s');
        $checkout['checkout_date']=date('Y-m-d');
        $checkout['checkout_items']=json_encode($prod_array,true);
        $checkout['status']='';
		$checkout['place']=$checkout['address'];
        #print_r($checkout); 
        $checko=$this->Model_getrows->common_insert('checkout',$checkout);
        if ($checko) {
            $this->cart->destroy();
?>
        <script>
        alert("successfully order");
        window.location.replace('../');
        </script>
<?php
        }
        else
        {
            echo "Error!!";
        }
    }
    function reservation_form()
    {
    //Prefedined Variables  
    $to = "skct.nizam@gmail.com";
    // Email Subject
    $subject = "Contact from your website.";
    // This IF condition is for improving security  and Prevent Direct Access to the Mail Script.
    if($_POST) {
    // Collect POST data from form
    $name = stripslashes($_POST['name']);
    $email = stripslashes($_POST['email']);
    $phone = stripslashes($_POST['phone']);
    $message= stripslashes($_POST['message']);
    $capcity=stripslashes($_POST['capacity']);
    //$date_time=explode(' ',$_POST['dt']);
    $data['customer_name']=$name;$data['customer_phone']=$phone;$data['capacity']=$capcity;
    $data['cust_email']=$email;$data['table_no']='';$data['status']=1;
    $data['reserv_date']=$_POST['dt'];
    $data['reserv_time']=$_POST['time'];
    // print_r($data);
     $insert=$this->Model_getrows->common_insert('order_table',$data);
     if($insert){
    // Collecting all content in HTML Table
    $content='<table width="100%">
    <tr><td  align "center"><b>Contact Details</b></td></tr>
    <tr><td>Name:</td><td> '.$name.'</td></tr>
    <tr><td>Email:</td><td> '.$email.' </td></tr>
    <tr><td>Subject:</td><td> '.$phone.'</td></tr>
    <tr><td>Message:</td> <td> '.$message.'</td></tr>
    <tr><td>Date:</td> <td> '.date('d/m/Y').'</td></tr>
    </table> ';
    // Define email variables
    $headers = "From:".$email."\r\n";
    $headers .= "Reply-to:".$email."\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8';
    if( ! empty($name) && ! empty($email) && ! empty($content) ) {
    // Sending Email 
    if( mail($to, $subject, $content, $headers) ) {
    print "<p>Thank you, we will getback to you shortly</p><br>";
    return true;
    }
    else {
    print "<p>Some errors to send the mail.</p>";
    return false;
    }
    }
    else {
    print "<p>Some errors to send the mail.</p>";
    return false;
    }
    }//insert query
    else
    {
        //error while insertting 
    }
    }
    }
    function contact_form()
    {
        //Prefedined Variables  
        $to = "skct.nizam@gmail.com";
        // Email Subject
        $subject = "Contact from your website.";
        // This IF condition is for improving security  and Prevent Direct Access to the Mail Script.
        if($_POST) {
        // Collect POST data from form
        $name = stripslashes($_POST['name']);
        $email = stripslashes($_POST['email']);
        $phone = stripslashes($_POST['phone']);
        $message= stripslashes($_POST['message']);
        // Collecting all content in HTML Table
        $content='<table width="100%">
        <tr><td  align "center"><b>Contact Details</b></td></tr>
        <tr><td>Name:</td><td> '.$name.'</td></tr>
        <tr><td>Email:</td><td> '.$email.' </td></tr>
        <tr><td>Subject:</td><td> '.$phone.'</td></tr>
        <tr><td>Message:</td> <td> '.$message.'</td></tr>
        <tr><td>Date:</td> <td> '.date('d/m/Y').'</td></tr>
        </table> ';
        // Define email variables
        $headers = "From:".$email."\r\n";
        $headers .= "Reply-to:".$email."\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8';
        if( ! empty($name) && ! empty($email) && ! empty($content) ) {
        // Sending Email 
        if( mail($to, $subject, $content, $headers) ) {
        print "<p>Thank you, we will getback to you shortly</p><br>";
        return true;
        }
        else {
        print "<p>Some errors to send the mail.</p>";
        return false;
        }
        }
        else {
        print "<p>Some errors to send the mail.</p>";
        return false;
        }
        }
    }	
}
?>