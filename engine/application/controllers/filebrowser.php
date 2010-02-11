<?php defined('SYSPATH') or die('No direct script access.');
class Filebrowser_Controller extends Website_Controller {

  public function hash($password=null) {
    if ($password == null) {
      print "Password Hash: Coming soon!";
    } else {
      print $this->auth->hash($password);
    }
    exit();
  }

  public function login() {
    // if user is logged in, redirect refering page    

    $validation = Validation::factory($_POST)
      ->pre_filter('trim', TRUE)
      ->add_rules('username','required')
      ->add_rules('password', 'required');

    $return_path = $this->session->get('return_path') ? $this->session->get('return_path') : '/';

    $login = View::factory('pages/login');
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
          Session::instance()->set_flash('flash', SubfolioLanguage::get_text('login_complete'));		
          url::redirect($return_path);
          exit();
        } else {
          $login->login_failed = true;
          Session::instance()->set_flash('error', SubfolioLanguage::get_text('login_failed'));		
        }
      }
    } else {
      $login->login_failed = false;
    }
    $this->template->content = $login;
  }

  public function logout() {
    $this->auth->logout(true);
    $this->session->create();
    Session::instance()->set_flash('flash', SubfolioLanguage::get_text('logout_complete'));		
    url::redirect('/');
    exit();
  }

  public function denied() {
    $denied = View::factory('pages/denied');
    $this->template->content = $denied;
  }

  public function notfound() {
    $notfound = View::factory('pages/notfound');
    $this->template->content = $notfound;
  }

  public function access($path='') {
    $path = isset($_GET['path']) ? $_GET['path'] : '';

    $this->filebrowser->set_path($path);
    $this->access->load_access($this->filebrowser->get_folder());

    if ($this->access->is_restricted()) {
      // if user is not logged in redirect to login screen
      if (!$this->auth->logged_in()) {
        $this->session->keep_flash();
        $this->session->set('return_path', $path);
        url::redirect("/login"); 
        exit();
      }
    }

    if ($this->access->check_access($this->auth->get_user())) {
      if ($this->filebrowser->is_file()) {

        // CHECK IF I HAVE ACCESS TO path
        $file = $this->filebrowser->fullfilepath;

        $cache_for = 3600 * 1;	
        $gmt_mtime = gmdate('D, d M Y H:i:s', (time() + $cache_for)) . ' GMT';

        if (isset($_GET['download'])) {
          header('Content-Disposition: attachment; filname="' . basename($file) .'"; ');
          header('Content-Type: application/octet-stream');
        } else {
          header('Content-Description: File Transfer');
          header('Content-Type: ' . self::mime_content_type($file));
        }

        header('Content-Transfer-Encoding: binary');
        header('Expires: '.$gmt_mtime);
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_end_clean();
        //readfile($file);

        $fp = fopen($file, "rb");
        while (!feof($fp)){
          print(@fread($fp, 4096));
          flush();
        }
        fclose($fp);
        exit;  
      } else {
        // must be a folder
        // $archive = $this->filebrowser->create_archive(true);
        // $folder = basename($this->filebrowser->get_folder());
        // $archive->download($folder.".zip");
        url::redirect("/denied"); 
        exit();
      }
    } else {
      url::redirect("/denied"); 
      exit();
    }
  }

  public function index() {
    $path = isset($_GET['path']) ? $_GET['path'] : '';

    $this->filebrowser->set_path($path);

    if ($this->filebrowser->exists()) {

      $this->access->load_access($this->filebrowser->get_folder());

      if ($this->access->is_restricted()) {
        // if user is not logged in redirect to login screen
        if (!$this->auth->logged_in()) {
          $this->session->set('return_path', $path);
          $this->session->keep_flash();
          url::redirect("/login"); 
          exit();
        }
      }

      if ($this->access->check_access($this->auth->get_user())) {
        $is_folder = false;
        $single = $this->filebrowser->is_file();
        $folder = $this->filebrowser->get_folder();

        if (!$single) {
          $fkind = $this->filekind->get_kind_by_file($folder);
          $kind = isset($fkind['kind']) ? $fkind['kind'] : '';
          if ($kind == "site") {
            $single = true;
            $is_folder = true;
          } else if ($kind == "slide") {
            $slide_files  = $this->filebrowser->get_file_list();
            $slide_files  = $this->filebrowser->sort($slide_files);

            if (sizeof($slide_files) > 0) {
              $url          = Subfolio::$filebrowser->get_link($slide_files[0]->name);
              url::redirect($url);
              exit();
            }
          }
        }

        $replace_dash_space = view::get_option('replace_dash_space', true);
        $replace_underscore_space = view::get_option('replace_underscore_space', true);
        $display_file_extensions = view::get_option('display_file_extensions', true);

        if ($single) {
          $file = $this->filebrowser->get_file();

          if ($is_folder) {
          } else {
            $fkind = $this->filekind->get_kind_by_file($file->name);
            $kind = isset($fkind['kind']) ? $fkind['kind'] : '';
          }

          if (View::view_exists('pages/filekinds/'.$kind)) {
            $content = View::factory('pages/filekinds/'.$kind);
            $content->file = $file;
            if (isset($folder)) $content->folder = $folder;
          } else {
            $content = View::factory('pages/filekinds/default');
            $content->file = $file;
          }
          
          if ($folder <> '.') {
            $title_path = $folder."/".$file->name;
          } else {
            $title_path = $file->name;
          }
          
          $this->template->page_title = FileFolder::make_title_display($title_path, $replace_dash_space, $replace_underscore_space, $display_file_extensions);
          
          $this->template->content = $content;
        } else {

          $folder = $this->filebrowser->get_folder();

          $content = View::factory('pages/listing');
          $this->template->content = $content;

          if ($folder <> "") {
            $this->template->page_title = $folder;
            $this->template->page_title = FileFolder::make_title_display($folder, $replace_dash_space, $replace_underscore_space, $display_file_extensions);
          
          }
        }
      } else {
        $content = View::factory('pages/denied');
        $this->template->content = $content;
      }
    } else {
      $content = View::factory('pages/notfound');
      $this->template->content = $content;
    }
  }

  private static function mime_content_type($filename) {
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
          //'tiff' => 'image/tiff',
          //'tif' => 'image/tiff',
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
      } elseif (function_exists('finfo_open')) {
          $finfo = finfo_open(FILEINFO_MIME);
          $mimetype = finfo_file($finfo, $filename);
          finfo_close($finfo);
          return $mimetype;
      } else {
          return 'application/octet-stream';
      }
  }

}
