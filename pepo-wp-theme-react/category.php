<?php get_header(); ?>

<section id="content"></section>

<?php get_footer(); ?>

<script>
  System.config({
    transpiler: 'babel',
    baseURL: '',
    map: {
      babel: 'https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js',
      react: 'https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react.js',
      'react-dom': 'https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react-dom.js'
    }
  });
  SystemJS.import('/wp-content/themes/pepo-wp-theme/assets/scripts/index.js').then(function (m) {
  // (the bundle itself is an empty module m)
  return SystemJS.import('module-from-bundle');
})

</script>
