require 'rake/packagetask'

# read engine version to be used for packaging.
version = File.read('engine/VERSION.txt')

# Generate .zip files from the codebase using the version.
Rake::PackageTask.new('subfolio', version) do |pkg|
  pkg.need_zip = true

  pkg.package_files = FileList['config/**/*', 'engine/**/*',
    'directory/README.txt', 'README.txt', 'INSTALL.txt', 'LICENSE.txt',
    '.htaccess']

  pkg.package_files.exclude('engine/application/logs/*')
end
