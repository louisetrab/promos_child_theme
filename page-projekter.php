<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>
<template>
    <article id="wrapper">
                    
        <div>
            <h2 class="projektnavn"></h2>
            <img src="" alt="">
            <p class="verdensml"></p>
            <p class="korttekst"></p>
            <button class="mere">Læs mere -></button>
        </div>
    </article>
</template>

 <section id="primary" class="content-area">
<main id="main" class="site-main">
    
     <div class="container">
        <div class="row">
			<div class="breadcrumbs-wrap">
				<?php do_action('promos_breadcrumb_options_hook'); ?> <!-- Breadcrumb hook -->
			</div>
			<div id="primary" class="col-lg-9 content-area">
				<section id="wp-main" class="wp-site-main">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				</section><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
    <p class="klasseoverskrift">Vælg skoletrin</p>
<nav id="ktFiltrering" class="kteffekter"></nav>
<nav id="vmFiltrering" class="hide grid"></nav>
<section class="projektcontainer">
</section>
</main><!-- #main -->

<script>
    let ktProjekter;
    let projekter;
    let categories;
    let filterVmProjekt = "alle";
    let filterKtProjekt = "alle";
    let klassetrin;

    const dbUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt?per_page=100";
    const catUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/categories?per_page=100";
        const ktUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/klassetrin?per_page=100";

    async function getJson() {
        const data = await fetch(dbUrl);
        const catdata = await fetch(catUrl);
        const ktdata = await fetch(ktUrl);
        projekter = await data.json();
        categories = await catdata.json();
        klassetrin = await ktdata.json();
        console.log(categories);
        //visProjekter();
      
        opretKtKnapper();
          opretVmKnapper();
    }


    function opretKtKnapper() {
  klassetrin.forEach(trin =>{
    document.querySelector("#ktFiltrering").innerHTML += `<button class="vmfilter ktfilter" data-kt="${trin.id}">${trin.name}</button>`
  })
  addEventListenersToKtButton();
}
function addEventListenersToKtButton() {
  document.querySelectorAll("#ktFiltrering button").forEach(elm =>{
    elm.addEventListener("click", ktFiltrering);
  })
  
};

    function opretVmKnapper() {
  categories.forEach(cat =>{
    document.querySelector("#vmFiltrering").innerHTML += `<button class="filter" data-vm="${cat.id}"><img src="${cat.billede.guid}"></button>`
  })
  addEventListenersToVmButton();
}
function addEventListenersToVmButton() {
  document.querySelectorAll("#vmFiltrering button").forEach(elm =>{
    elm.addEventListener("click", vmFiltrering);
  })
  
};

function ktFiltrering(){
     filterKtProjekt = this.dataset.kt;
  console.log(filterKtProjekt);

  visKtProjekter();

}

function visKtProjekter() {
  console.log(visKtProjekter);
  let temp = document.querySelector("template");
  let container = document.querySelector(".projektcontainer");
  container.innerHTML = "";


ktProjekter= projekter.filter(projekt =>projekt.klassetrin.includes(parseInt(filterKtProjekt))) ;
console.log("ktProjekter:", ktProjekter);


  projekter.forEach(projekt => {
    if ( filterKtProjekt == "alle" || projekt.klassetrin.includes(parseInt(filterKtProjekt))){
      let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".verdensml").textContent = projekt.verdensml;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.link;})
            container.appendChild(klon);
        }
        })

        document.querySelector("#vmFiltrering").classList.remove("hide");


    }


function vmFiltrering() {
  filterVmProjekt = this.dataset.vm;
  console.log(filterVmProjekt);

  visProjekter();
}

function visProjekter() {
  console.log(visProjekter);
  let temp = document.querySelector("template");
  let container = document.querySelector(".projektcontainer");
  container.innerHTML = "";
  ktProjekter.forEach(projekt => {
    if ( filterVmProjekt == "alle" || projekt.categories.includes(parseInt(filterVmProjekt))){
      let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".verdensml").textContent = projekt.verdensml;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.link;})
            container.appendChild(klon);
        }
        })
    }
getJson();

    </script>
    </section> <!-- #primary -->

    <?php
    get_footer();
