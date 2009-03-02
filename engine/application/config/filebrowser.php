<?php defined('SYSPATH') OR die('No direct access allowed.');

$site_folder = dirname(APPPATH).'/../';

$users_folder    = $site_folder.'config/users/';
$settings_folder = $site_folder.'config/settings/';

$config['site_name'] = 'Subfolio Portable';
$config['site_domain'] = 'www.subfolio.com';
$config['theme'] = 'default';
$config['directory'] = $site_folder.'directory';
$config['access_file']     = '-access';
$config['properties_file'] = '-properties';

$config['thumbnail_width'] = 320;
$config['thumbnail_height'] = 240;

# NOTE IF YOU CHANGE THIS YOU WILL NEED TO REGENERATE YOUR PASSWORD LIST

$config['auth_session'] = 'some_random_string';
$config['auth_salt'] = 'some_random_string';

$config['users_yaml_file']  = $users_folder."users.yml";
$config['groups_yaml_file'] = $users_folder."groups.yml";

//Load settings from yaml file
$settings_file  = $settings_folder."settings.yml";
$settings = Spyc::YAMLLoad($settings_file);

//rint_r($settings);

$config['site_name'] = isset($settings['site_name']) ? $settings['site_name'] : $config['site_name'];
$config['site_domain'] = isset($settings['site_domain']) ? $settings['site_domain'] : $config['site_domain'];

$config['theme'] = isset($settings['theme']) ? $settings['theme'] : $config['theme'];
$config['directory'] = isset($settings['directory']) ? $site_folder.$settings['directory'] : $config['directory'];

$config['access_file'] = isset($settings['access_file']) ? $settings['access_file'] : $config['access_file'];
$config['properties_file'] = isset($settings['properties_file']) ? $settings['properties_file'] : $config['properties_file'];

$config['users_yaml_file'] = isset($settings['users_yaml_file']) ? $users_folder.$settings['users_yaml_file'] : $config['users_yaml_file'];
$config['groups_yaml_file'] = isset($settings['groups_yaml_file']) ? $users_folder.$settings['groups_yaml_file'] : $config['groups_yaml_file'];

$config['thumbnail_width'] = isset($settings['thumbnail_width']) ? $config_folder.$settings['thumbnail_width'] : $config['thumbnail_width'];
$config['thumbnail_height'] = isset($settings['thumbnail_height']) ? $config_folder.$settings['thumbnail_height'] : $config['thumbnail_height'];
