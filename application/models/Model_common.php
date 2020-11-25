<?php
class Model_common extends CI_model
{
    function css($filename_css)
    {
        return base_url().'assets/css/'.$filename_css;
    }
    
    function js($filename_js)
    {
      return base_url().'assets/js/'.$filename_js;
    }
    
    function images($filename_images)
    {
      return base_url().'assets/images/'.$filename_images;
    }
    
    function fonts($filename_fonts)
    {
      return base_url().'assets/fonts/'.$filename_fonts;
    }
    function front_assets_js($file)
    {
        return base_url().'front/assets/js/'.$file;
    }
    function front_assets_css($file)
    {
        return base_url().'front/assets/css/'.$file;
    }
    function front_assets_img($file)
    {
        return base_url().'front/assets/img/'.$file;
    }
    function front_assets_fonts($file)
    {
        return base_url().'front/assets/fonts/'.$file;
    }
    function front_images($file)
    {
        return base_url().'front/img/'.$file;
    }

}
?>