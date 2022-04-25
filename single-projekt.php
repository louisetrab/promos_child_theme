<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>

 <section id="primary" class="content-area">
     <main id="main" class="site-main">

    <article>

            <img src="" alt="">
            <h2 class="navn"></h2>
            <p class="undertitel"></p>
            <p class="korttekst"></p>

    </article>

<main>
<script>
    let projekter;
    const dbUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt/"+<?php echo get_the_ID() ?>;

    async function getJson() {
        const data = await fetch(dbUrl);
        projekter = await data.json();
        console.log(projekter);
        visProjekter();
    }

    function visProjekter() {
        let temp = document.querySelector("template");
        let container = document.querySelector(".projektcontainer")
        projekter.forEach(projekt => {
            let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".undertitel").textContent = projekt.undertitel;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = "restdb-single.html?id="+projekt._id;
            })
            container.appendChild(klon);
        })
    }

    getJson();

    </script>

    </main><!-- #main -->
    </section><!-- #primary -->

    <?php
    get_footer();

    // ------- NANNA -----

    get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <article id="singleview">
      <img id="pic" src="" alt="">
      <h2></h2>
      <p class="info"></p>
      <p class="info_3"></p>
      <p class="pris"></p>
    </article>
</main>
    <script>
      
      let ret;

      const url = "https://nannatorp.dk/kea/09_cms/babushka_wp/wordpress/wp-json/wp/v2/ret/"+<?php echo get_the_ID() ?>;
    

      async function hentData() {
        console.log("hentData");

        const data = await fetch(url);
        ret = await data.json();
        visRetter();
      }
      function visRetter() {
          console.log(ret.billede.guid);
          
          document.querySelector("#pic").src = ret.billede.guid;
        document.querySelector("h2").textContent = ret.title.rendered;
        document.querySelector(".info").textContent = ret.beskrivelse;
        document.querySelector(".info_3").textContent =
          "Oprindelsesregion: " + ret.oprindelsesregion; 
        document.querySelector(".pris").textContent =
          "Pris: " + ret.pris + ",-";
      }
      hentData();

      document.querySelector("button").addEventListener("click", () => {
        history.back();
      });
    </script>
	</div><!-- #primary -->

<?php
get_footer();