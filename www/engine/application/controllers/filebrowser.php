<?php defined('SYSPATH') or die('No direct script access.');
class Filebrowser_Controller extends Website_Controller {

  public function login() {
    // if user is logged in, redirect refering page    

		$validation = Validation::factory($_POST)
			->pre_filter('trim', TRUE)
			->add_rules('username','required')
			->add_rules('password', 'required');

		$login = View::factory('login');
	  $login->login_failed = false;

		if ($_POST) {
			if ( ! $validation->validate()) {
  		  $login->login_failed = true;
				$form = $validation->as_array();
				$errors = $validation->errors('custom_error');
			} else {
				$username = $validation->username;
				$password = $validation->password;
				if ($this->auth->login($username, $password, true)) {
					// Login successful, redirect
					Session::instance()->set_flash('flash', 'Login complete.');		
					url::redirect('/');
				} else {
    		  $login->login_failed = true;
					Session::instance()->set_flash('flash', 'Login Failed');		
				}
			}
		} else {
		  $login->login_failed = false;
		}
  	$this->template->content .= $login;
  }

  public function logout() {
    $this->auth->logout(true);
		Session::instance()->set_flash('flash', 'Logout complete.');		
		url::redirect('/');
  }

  public function denied() {
		$denied = View::factory('denied');
  	$this->template->content .= $denied;
  }

  public function notfound() {
		$notfound = View::factory('notfound');
  	$this->template->content .= $notfound;
  }

  public function access($path='') {
    $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : '';

    $this->filebrowser->set_path($path);
    $this->access->load_access($this->filebrowser->get_folder());

    if ($this->access->is_restricted()) {
      // if user is not logged in redirect to login screen
      if (!$this->auth->logged_in()) {
        url::redirect("/login"); 
      }
    }

    if ($this->access->check_access($this->auth->get_user())) {
      // CHECK IF I HAVE ACCESS TO path
      $file = $this->filebrowser->fullfilepath;
      
      header('Content-Description: File Transfer');
      header('Content-Type: ' . mime_content_type($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      ob_clean();
      flush();
      readfile($file);
      exit;  
		} else {
      url::redirect("/denied"); 
		}
  }

  public function index() {
    $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : '';
    
    $this->filebrowser->set_path($path);
    $this->access->load_access($this->filebrowser->get_folder());
    
    if ($this->access->is_restricted()) {
      // if user is not logged in redirect to login screen
      if (!$this->auth->logged_in()) {
        url::redirect("/login"); 
      }
    }

    if ($this->access->check_access($this->auth->get_user())) {
      if ($this->filebrowser->is_file()) {
        $file = $this->filebrowser->get_file();
        
        $kind = $this->filebrowser->get_kind($file->name);
    		$content = View::factory('content_'.$kind);
    		$this->template->content = $content;
      } else {

    		$top = View::factory('content_listing_top');
    		$this->template->content .= $top;
  
    		$gallery = View::factory('gallery');
    		$gallery->files   = $this->filebrowser->get_file_list("img");
    		$this->template->content .= $gallery;
  
    		$listing = View::factory('content_listing');
    		$listing->files   = $this->filebrowser->get_file_list();
    		$listing->folders = $this->filebrowser->get_folder_list();
    		$this->template->content .= $listing;

    		$bottom = View::factory('content_listing_bottom');
    		$this->template->content .= $bottom;

  		}
		} else {
      url::redirect("/denied"); 
		}
    
  }
}



if(!function_exists('mime_content_type')) {

    function mime_content_type($filename) {

        $mime_types = array(

            'log' => 'text/plain',
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
}
