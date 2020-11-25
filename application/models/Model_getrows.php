<?php
class Model_getrows extends CI_model
{
    function get_items($fields,$tablename)
    {
        $this->db->select($fields);
        return $this->db->get($tablename)->result();
    }

    function get_menu($fields,$tablename,$where)
    {
        $this->db->select($fields);
        $this->db->where($where);
        return $this->db->get($tablename)->result();
    }
    function get_menu_by_categoryid_like($tablename,$like,$like_field)
    {
      $this->db->like($like_field,$like);
      return $this->db->get($tablename)->result();
    }
    function common_insert($table,$array)
    {
        $this->db->insert($table,$array);
		return $this->db->insert_id();
    }
    public function check_email($email) 
    {
        if($email) {
            $sql = 'SELECT * FROM register WHERE email = ?';
            $query = $this->db->query($sql, array($email));
            $result = $query->num_rows();
           //echo $this->db->last_query();
            return ($result==1) ? true : false;
        }
        return false;
    }
    function login($email, $password) {
        if($email && $password) {
            $sql = "SELECT * FROM register WHERE email = ? and password = ?";
            $query = $this->db->query($sql, array($email,$password));
            if($query->num_rows() == 1) {
                $result = $query->row_array();
                return $result; 
            }
            else {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    function cart_cnt($cookie)
    {
        $this->db->where('cookie',$cookie);
        return $this->db->get('cart')->num_rows();
    }
    public function get_product_by_id($id) {
        $this->db->select('*');
        $this->db->from('products');
        // $this->db->join('tbl_category', 'tbl_category.id=tbl_product.product_category');
        // $this->db->join('tbl_brand', 'tbl_brand.brand_id=tbl_product.product_brand');
        $this->db->order_by('products.id', 'DESC');
        // $this->db->where('products.publication_status', 1);
        $this->db->where('products.id', $id);
        $info = $this->db->get();
        return $info->row();
    }
    function get_all_products($select,$table)
    {
        $this->db->select($select);
        return $this->db->get($table)->result();
    }
    function get_all_categories()
    {
        return $this->db->get('category')->result();
    }
    function get_banner()
    {
        return $this->db->get('banners')->result();
    }
    function get_gallery()
    {
        return $this->db->get('images')->result();
    }
	function get_chefs()
    {
        return $this->db->get('chefs')->result();
    }
	function get_blogs()
    {
        return $this->db->get('blogs')->result();
    }
	public function get_blog_by_id($id) {
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('blogs.blog_id', $id);
        $info = $this->db->get();
        return $info->row();
    }
	public function get_productImage_by_Catid($id) {
        $this->db->select('id');
        $this->db->from('sub_category');
        $this->db->order_by(' sub_category.id', 'DESC');
        $this->db->where(' sub_category.category_id', $id);
        $info = $this->db->get()->row();
		//echo $info->id;
		$var='["'.$info->id.'"]';
		$this->db->select('image');
        $this->db->from('products');
        $this->db->order_by(' products.id', 'DESC');
        $this->db->where('category_id',$var);
        $info1 = $this->db->get();
        return $info1->row();
    }
	public function get_product_by_Catid($id) {
        $sql = "SELECT * FROM sub_category WHERE category_id=".$id;
        $query = $this->db->query($sql);	
		return $query->result();
    }
	public function get_product_by_SubCatid($id) {
		$var='["'.$id.'"]';
        $sql = "SELECT * FROM products WHERE category_id='".$var."'";
        $query = $this->db->query($sql);	
		$res = $query->result();
		return $res;
    }
}
?>