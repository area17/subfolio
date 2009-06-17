require 'rake/packagetask'

# read engine version to be used for packaging.
version = File.read('engine/VERSION.txt')

# Generate .zip files from the codebase using the version.
Rake::PackageTask.new('subfolio', version) do |pkg|
  pkg.need_tar = true

  pkg.package_files = FileList['config/**/*', 'engine/**/*','directory',
    'README.txt', 'INSTALL.txt', 'LICENSE.txt',
    '.htaccess', 'htaccess']

  pkg.package_files.exclude('.gitignore')
  pkg.package_files.exclude('engine/application/logs/*')
  pkg.package_files.exclude('engine/install/demo/*')
  pkg.package_files.exclude('config/settings/settings.yml')
  pkg.package_files.exclude('config/settings/language.yml')
  pkg.package_files.exclude('config/settings/filekinds.yml')
  pkg.package_files.exclude('config/users/users.yml')
  pkg.package_files.exclude('config/users/groups.yml')
  pkg.package_files.exclude('directory/*')

end

task :copyfiles do
  puts "Copying Files..."
  cp "config/settings/settings.sample.yml", "pkg/subfolio-#{version}/config/settings/settings.yml", :verbose => true
  cp "config/settings/language.sample.yml", "pkg/subfolio-#{version}/config/settings/language.yml", :verbose => true
  cp "config/settings/filekinds.sample.yml", "pkg/subfolio-#{version}/config/settings/filekinds.yml", :verbose => true

  cp "config/users/users.sample.yml", "pkg/subfolio-#{version}/config/users/users.yml", :verbose => true
  cp "config/users/groups.sample.yml", "pkg/subfolio-#{version}/config/users/groups.yml", :verbose => true
  
  rm "pkg/subfolio-#{version}.tgz"
end

task :default => ['package', 'copyfiles', 'package']