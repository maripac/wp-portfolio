<?php
/**
 * template-grid-images.php
 *
 * Template Name: Grid Images Page
 */
?>

<?php get_header(); ?>
<!--wrapper-main-->
<!--<div class="wrapper-main">-->
<?php
$item_img_home = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/home.png';
$item_img_snippets = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/code003.png';
$item_img_portfolio = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/portfolio005.png';
$item_img_tag = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/tag012.png';
$item_img_about = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/about007.png';
$item_img_note = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/notebook-cover003.png';
$item_img_jekyll = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/jekyll.png';
?>


<div class="grid-items-lines">
  <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'About' ) ) ); ?>" class="grid-item">
    <img src="<?php echo $item_img_about; ?>" alt="">
    <h1>About</h1>
    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
  </a>
  <a href="https://gostak.io" target="_blank" class="grid-item grid-item-big">
    <img src="<?php echo $item_img_jekyll; ?>" alt="">
    <h1>Documentación de procesos en Jekyll</h1>
    <p>Lorem ipsum consectetur dolor sit amet, consectetur adipisicing elit. Rem, illum.</p>
  </a>

  <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Posts' ) ) ); ?>" class="grid-item">
    <img src="<?php echo $item_img_note; ?>" alt="">
    <h1>Blog</h1>
    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
  </a>

  <a href="<?php bloginfo('url'); ?>/snippets" class="grid-item">
    <img src="<?php echo $item_img_snippets; ?>" alt="">
    <h1>Snippets</h1>
    <p>Lorem ipsum consectetur dolor sit amet, consectetur adipisicing elit. Rem, illum.</p>
  </a>
  <a href="<?php bloginfo('url'); ?>/portfolio" class="grid-item">
    <img src="<?php echo $item_img_portfolio; ?>" alt="">
    <h1>Portfolio</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, illum.</p>
  </a>



  <?php //start by fetching the terms for the animal_cat taxonomy
      $termsl = get_terms( 'languages', array(
          'orderby'    => 'count',
          'hide_empty' => 0
      ) );
      ?>

      <?php
      // now run a query for each animal family
      foreach( $termsl as $term ) {
       
          // Define the query
          $args = array(
              'post_type' => array('snippets', 'post'),
                  'languages' => $term->slug
          );
          $query = new WP_Query( $args );
          $term_link = get_term_link( $term );
                   
          // output the term name in a heading tag 
          echo '<a href="' . esc_url( $term_link ) . '" class="grid-item grid-item-big">';               
          //echo'<h2>' . $term->name . '</h2>';
          echo '<img src ="' . get_theme_root_uri() . '/Digstatic-o-theme/assets/images/tag012.png" />'; 
          // output the post titles in a list
          echo '<p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>';
          echo '<h1>' . $term->name . '</h1>';
          echo '</a>';
           
              // Start the Loop
              while ( $query->have_posts() ) : $query->the_post(); ?>
       
              <!--<li class="animal-listing" id="post-<?php the_ID(); ?>">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>-->
              <a id="post-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" class="grid-item">
                <img src="<?php echo $item_img_tag; ?>" alt="">
                <h1><?php the_title(); ?></h1>
                <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
              </a>
               
              <?php endwhile;
           
          echo '<div class="right-cover"></div><div class="bottom-cover"></div></div>';
           
          // use reset postdata to restore orginal query
          wp_reset_postdata();
       
      } ?>
      
<?php get_footer(); ?>
