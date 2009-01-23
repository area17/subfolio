<?php defined('SYSPATH') OR die('No direct access allowed.');

$config['site_name'] = 'filebrowser2.dev.area17.com';
$config['theme'] = 'default';
$config['directory'] = dirname(APPPATH).'/../directory';
$config['access_file']     = '.fbaccess';
$config['properties_file'] = '.fbproperties';

# NOTE IF YOU CHANGE THIS YOU WILL NEED TO REGENERATE YOUR PASSWORD LIST

$config['auth_session'] = 'some_random_string';
$config['auth_salt'] = 'some_random_string';

$config['users_yaml_file']  = APPPATH."config/users.yaml";
$config['groups_yaml_file'] = APPPATH."config/groups.yaml";