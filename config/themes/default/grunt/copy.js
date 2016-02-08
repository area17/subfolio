// Full list of files that must be include into server theme
var includes_in_prod = [
  '*', 'fonts/**', 'images/**', 'layouts/**', 'pages/**', 'cms/**', 'color/**'
]

// Full list of files that must be exclude from the server theme
var exclude_from_prod = [
  '!dist',
  '!gruntfile.js',
  '!node_modules',
  '!grunt',
  '!.gitignore',
  '!README.md',
  '!.htaccess',
  '!package.json'
];

var includes_in_prod = includes_in_prod.concat(exclude_from_prod);

module.exports = {
  staging: {
    files: [
      {src: includes_in_prod, dest: 'dist/'}
    ]
  }
};
