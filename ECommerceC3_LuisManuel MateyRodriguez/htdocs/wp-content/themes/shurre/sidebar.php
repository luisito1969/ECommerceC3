<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ShUrRe
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div id="secondary" class="left widget-area col s12 m4 l3" role="complementary">
		<h1 class="texto2">ShUrRe</h1>

		<?php dynamic_sidebar ( 'sidebar-1' );?>

		<h2>Comparte tus recetas</h2>

		<nav>
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>

    </div>
  </nav>


</aside><!-- #secondary -->
