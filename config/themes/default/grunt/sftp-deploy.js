module.exports = {
  staging: {
    auth: {
      host: 'area17.com',
      port: 22,
      authKey: 'staging'
    },
    src: 'dist/',
    dest: 'public_html/dev.area17.com/subfoliodemo/config/themes/default/',
    serverSep: '/',
    concurrency: 4,
    progress: true
  }
};
