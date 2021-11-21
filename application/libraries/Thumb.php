<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thumb {

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('image_lib');
    }

    public function create($picPath, $picName) {

        $config =array();

        $config['image_library'] = 'gd2';
        $config['source_image'] = $picPath;
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = TRUE;
        $config['width']     = 100;
        $config['height']   = 100;
        $config['new_image'] =  $picName;

        // $CI->image_lib->clear();
        $this->CI->image_lib->initialize($config); 

        if(!$this->CI->image_lib->resize()){
            $this->CI->session->set_flashdata('flashError',  $this->CI->image_lib->display_errors());
            return False;
        }
        $this->CI->image_lib->clear();
        Return True;

    }

    public function resize($picPath, $x, $y) {

        $config1 = Array();

        $config1['image_library'] = 'gd2';
        $config1['source_image']    = $picPath;
        $config1['maintain_ratio'] = TRUE;

        if($x!=0)
            $config1['width']    = $x;

        if($y!=0)
            $config1['height']  = $y;

        // $CI->image_lib->clear();
        $this->CI->image_lib->initialize($config1); 

        if(!$this->CI->image_lib->resize()){
            $this->CI->session->set_flashdata('flashError',  $this->CI->image_lib->display_errors());
            $this->CI->image_lib->clear();
            return False;
        }
        $this->CI->image_lib->clear();
        Return True;
    }

    public function buat_kecil($data, $dest, $srcpath, $width) {

				/* PATH */
				$source             = $srcpath.$data['file_name'] ;
				$destination_thumb	= $dest ;			 
				// Permission Configuration
				chmod($source, 0777) ;
	 
				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
	 
				/// Limit Width Resize
				$limit_thumb    = $width ;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use ;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '100%' ;
				$img['source_image'] = $source ;
				$img['new_image']    = $destination_thumb ;
	 
				// Do Resizing
				$this->CI->image_lib->initialize($img);
        if(!$this->CI->image_lib->resize()){
            $this->CI->session->set_flashdata('flashError',  $this->CI->image_lib->display_errors());
            return False;
        }
				$this->CI->image_lib->clear() ;
        Return True;
    }

    public function buat_avatar($data, $dest, $width) {

				/* PATH */
				$source             = "./aset/admin/dist/img/".$data['file_name'] ;
				$destination_thumb	= $dest ;			 
				// Permission Configuration
				chmod($source, 0777) ;
	 
				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
	 
				/// Limit Width Resize
				$limit_thumb    = $width ;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use ;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '100%' ;
				$img['source_image'] = $source ;
				$img['new_image']    = $destination_thumb ;
	 
				// Do Resizing
				$this->CI->image_lib->initialize($img);
        if(!$this->CI->image_lib->resize()){
            $this->CI->session->set_flashdata('flashError',  $this->CI->image_lib->display_errors());
            return False;
        }
				$this->CI->image_lib->clear() ;
        Return True;
    }
	
}
// END Thumb Class

/* End of file Thumb.php */
/* Location: ./application/libraries/Thumb.php */