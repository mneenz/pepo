<?php get_header(); ?>

<div id="bg"></div>

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

  // loads
  System.import('/wp-content/themes/pepo-wp-theme-react/assets/scripts/index.js');

</script>
