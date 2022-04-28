let mix = require('laravel-mix');
let path = require('path')

mix.js('resources/js/field.js', 'js').vue({ version: 3 })
  .webpackConfig({
    externals: {
      vue: 'Vue',
    },
    output: {
      uniqueName: 'optimistdigital/nova-drafts',
    }
})

mix.alias({
  'laravel-nova': path.join(__dirname, '../../vendor/laravel/nova/resources/js/mixins/packages.js'),
})
