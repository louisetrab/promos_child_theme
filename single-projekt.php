<?php

/**
 * The template for displaying front page
 
 */

    get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <section id="singleview">
          <h2 class="projektnavn"></h2>
          <img class="billede1" src="" alt="">
        <div class="div_wrapper">
            <p class="verdensml"></p>
            <p class="skolenavn"></p>
            <p class="uddannelsestrin"></p>
            <p class="kontaktperson"></p>
            <p class="email"></p>
            <p class="trin1">Uddannelsestrin</p>
            <p class="trin2">Skolenavn</p>
            <p class="trin3">Kontaktperson</p>
            <p class="trin4">E-mail</p>
        </div>
        </section>

        <section id="singleview2">
              <h2 class="trin5">Om Projektet</h2>
            <p class="langtekst"></p>
            <p class="trin6">Til lærerne</p>
            <p class="laerer"></p>
            <p class="trin7">Til eleverne</p>
            <p class="elev"></p>

</section>
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
          
        document.querySelector(".projektnavn").textContent = projekt.title.rendered;
        document.querySelector(".billede1").src = projekt.billede.guid;
        document.querySelector(".verdensml").textContent = projekt.verdensml;
        document.querySelector(".skolenavn").textContent = projekt.skolenavn;
        document.querySelector(".uddannelsestrin").textContent = projekt.uddannelsestrin;
        document.querySelector(".kontaktperson").textContent = projekt.kontaktperson;
        document.querySelector(".email").textContent = projekt.email;
        document.querySelector(".langtekst").textContent = projekt.langtekst;
        document.querySelector(".laerer").textContent = projekt.laerer;
        document.querySelector(".elev").textContent = projekt.elev;
    
      }
      hentData();

      document.querySelector("button").addEventListener("click", () => {
        history.back();
      });
    </script>
	</div><!-- #primary -->

<?php
get_footer();