<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ShUrRe
 */

 get_header(); ?>
  <div class="row">
    <div id="primary" class="right content-area col s12 m8 l9">
      <main id="main" class="site-main" role="main">
		<nav>
	    <div class="nav-wrapper">
	      <ul id="nav-mobile" class="left hide-on-med-and-down">
	        <li><a href="sass.html"><i class="material-icons left">person_pin</i>Platos</a></li>
	        <li><a href="badges.html"><i class="material-icons left">label</i>Ocasiones</a></li>
	        <li><a href="collapsible.html"><i class="material-icons left">language</i>Regiones</a></li>
          <li><a href="collapsible.html"><i class="material-icons left">contacts</i>Acerca de...</a></li>
          <li><a href="collapsible.html"><i class="material-icons left">description</i>Registrate</a></li>
	      </ul>
	    </div>
	  </nav>

  <div class="card">
    <div class="row">

      <div class="">
        <h1 class="texto1"><i class="material-icons left">person_pin</i>Nuevos Post de Platos</h1>
      </div>

            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <img src="<?php bloginfo('template_url');?>/img/Pastel de Carne de Pavo.jpg"/>
                  <span class="card-title">Pastel de Carne de Pavo</span>
                </div>
                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information.
                  I am convenient because I require little markup to use effectively.</p>


                  <div class="chip">
                    <i class="material-icons left">person_pin</i>
                    Almuerzo
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">label</i>
                    Informal
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">language</i>
                    Japón
                  </div>

                </div>

                <br/>
                <br/>
                <div class="card-action">
                  <a href="<?php bloginfo('template_url');?>/recetas/Recetas1.php"> IR A LA RECETA</a>
                </div>
              </div>
             </div>



            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <img src="<?php bloginfo('template_url');?>/img/Pizza de Vegetales a la Parrilla.jpg"/>
                  <span class="card-title">Pizza de Vegetales a la Parrilla</span>
                </div>
                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information.
                  I am convenient because I require little markup to use effectively.</p>
                  <div class="chip">
                    <i class="material-icons left">person_pin</i>
                    Almuerzo
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">label</i>
                    Informal
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">language</i>
                    Japón
                  </div>
                </div>
                <br/>
                <br/>
                <div class="card-action">
                  <a href="#">IR A LA RECETA</a>
                </div>
              </div>
            </div>

            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <img src="<?php bloginfo('template_url');?>/img/Pollo Cordon Bleu con Salsa.jpg"/>
                  <span class="card-title">Pollo Cordon Bleu con Salsa</span>
                </div>

                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information.
                  I am convenient because I require little markup to use effectively.</p>

                  <div class="chip">
                    <i class="material-icons left">person_pin</i>
                    Almuerzo
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">label</i>
                    Informal
                  </div>
                  <br/>

                  <div class="chip">
                    <i class="material-icons left">language</i>
                    Japón
                  </div>
                </div>
                <br/>
                <br/>
                <div class="card-action">
                  <a href="#">IR A LA RECETA</a>
                </div>
              </div>
            </div>

          </div>
        </div>



  <?php if ( have_posts() ) : ?>

  <?php /* Start the Loop */ ?>
  <?php while ( have_posts() ) : the_post(); ?>

  <?php
  /* Include the Post-Format-specific template for the content.
  * If you want to override this in a child theme, then include a file
  * called content-___.php (where ___ is the Post Format name) and that will be used instead.
  */
  get_template_part( 'content', get_post_format() );
  ?>

  <?php endwhile; ?>

  <?php the_posts_navigation(); ?>

  <?php else : ?>

  <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

  </main><!-- #main -->
  </div><!-- #primary -->

  <?php get_sidebar(); ?>
  </div><!-- /row -->
 <?php get_footer(); ?>
