require 'rake/packagetask'

# read engine version to be used for packaging.
version = File.read('engine/VERSION.TXT')

# Generate .zip files from the codebase using the version.
Rake::PackageTask.new('subfolio', version) do |pkg|
  pkg.need_tar = true

  pkg.package_files = FileList['config/**/*', 'engine/**/*','directory',
    'README.TXT', 'LICENSE.TXT', 'CHANGELOG.TXT',
    '.htaccess', 'htaccess']

  pkg.package_files.exclude('.gitignore')
  pkg.package_files.exclude('.htaccess')
  pkg.package_files.exclude('engine/application/logs/*')
  pkg.package_files.exclude('engine/install/*')
  pkg.package_files.exclude('config/settings/settings.yml')
  pkg.package_files.exclude('config/settings/language.yml')
  pkg.package_files.exclude('config/settings/filekinds.yml')
  pkg.package_files.exclude('config/users/users.yml')
  pkg.package_files.exclude('config/users/groups.yml')
  pkg.package_files.exclude('config/themes/default/options.yml')
  pkg.package_files.exclude('config/themes/mobile/options.yml')
  pkg.package_files.exclude('engine/info/checker.php')
  pkg.package_files.exclude('directory/*')

end

task :copyfiles do
  puts "Copying Files..."
  cp "config/settings/settings.sample.yml", "pkg/subfolio-#{version}/config/settings/settings.yml", :verbose => true
  cp "config/settings/language.sample.yml", "pkg/subfolio-#{version}/config/settings/language.yml", :verbose => true
  cp "config/settings/filekinds.sample.yml", "pkg/subfolio-#{version}/config/settings/filekinds.yml", :verbose => true

  cp "pkg/subfolio-#{version}/config/themes/default/options.sample.yml", "pkg/subfolio-#{version}/config/themes/default/options.yml", :verbose => true
  cp "pkg/subfolio-#{version}/config/themes/mobile/options.sample.yml", "pkg/subfolio-#{version}/config/themes/mobile/options.yml", :verbose => true

  cp "config/users/users.sample.yml", "pkg/subfolio-#{version}/config/users/users.yml", :verbose => true
  cp "config/users/groups.sample.yml", "pkg/subfolio-#{version}/config/users/groups.yml", :verbose => true

  cp "engine/install/demo/-t-welcome.txt", "pkg/subfolio-#{version}/directory/-t-welcome.txt", :verbose => true
  cp "engine/install/demo/-b-copyright.txt", "pkg/subfolio-#{version}/directory/-b-copyright.txt", :verbose => true
  cp "engine/install/demo/Quick_start.txt", "pkg/subfolio-#{version}/directory/Quick_start.txt", :verbose => true
  cp "engine/install/demo/support.subfolio.com.link", "pkg/subfolio-#{version}/directory/support.subfolio.com.link", :verbose => true
  
  rm "pkg/subfolio-#{version}.tgz"
end

task :default => ['package', 'copyfiles', 'package']
