var Elixir = require('laravel-elixir');

Elixir.config.assetsPath = 'assets/src';
Elixir.config.publicPath = 'assets/dist';

Elixir(function(mix) {
	mix.scripts('./assets/src/js/app.js', './assets/dist/js/plugin.js');
	mix.sass('./assets/src/sass/app.scss', './assets/dist/css/plugin.css');
});
