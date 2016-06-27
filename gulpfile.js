var Elixir = require('laravel-elixir');
var package = require('package.json');

Elixir(function(mix) {
  mix.scripts('./assets/src/js/app.js', './assets/dist/js/plugin.js');
  mix.sass('./assets/src/sass/app.sass', './assets/dist/css/plugin.css');
});
