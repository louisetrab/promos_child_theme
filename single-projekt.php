<?php

/**
 * The template for displaying front page
 
 */

    get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <article id="singleview">
            <img src="" alt="">
            <h2 class="navn"></h2>
            <p class="undertitel"></p>
            <p class="korttekst"></p>
    </article>
</main>
    <script>
      
      let projekt;

      const url = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt/"+<?php echo get_the_ID() ?>;
    

      async function hentData() {
        console.log("hentData");

        const data = await fetch(url);
        projekt = await data.json();
        visProjekter();
      }
      function visProjekter() {
          console.log(projekt.billede.guid);
          
        document.querySelector("img").src = projekt.billede.guid;
        document.querySelector("h2").textContent = projekt.title.rendered;
        document.querySelector(".undertitel").textContent = projekt.undertitel;
        document.querySelector(".korttekst").textContent = projekt.korttekst; 
    
      }
      hentData();

      document.querySelector("button").addEventListener("click", () => {
        history.back();
      });
    </script>
	</div><!-- #primary -->

<?php
get_footer();
