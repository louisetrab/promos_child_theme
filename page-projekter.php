<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>
<template>
    <article>
                    
        <div>
            <img src="" alt="">
            <h2 class="navn"></h2>
            <p class="undertitel"></p>
            <p class="korttekst"></p>
        </div>
    </article>
</template>

 <section id="primary" class="content-area">
<main id="main" class="site-main">

<section class="projektcontainer">
</section>
</main><!-- #main -->

<script>
    let projekter;
    const dbUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt?per_page=100";

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
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.links;
            })
            container.appendChild(klon);
        })
    }

    getJson();

    </script>
    </section><!-- #primary -->

    <?php
    get_footer();

    // ------ NANNA ------

    get_header();
?>
	
      <template>
        <article>
          <img src="" alt="" />
          <h2></h2>
          <p class="info"></p>
          <p class="pris"></p>
        </article>
      </template>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <nav id="filtrering"> <button data-ret="alle">Alle retter</button> </nav>
      <section class="retcontainer" ></section>
	  </main><!-- #main -->
<script>
  let retter;
  let categories;
  let filterRet = "alle";

	const url = "https://nannatorp.dk/kea/09_cms/babushka_wp/wordpress/wp-json/wp/v2/ret";
	const caturl = "https://nannatorp.dk/kea/09_cms/babushka_wp/wordpress/wp-json/wp/v2/categories";

  async function hentData() {
  const data = await fetch(url);
  const catdata = await fetch(caturl);
  retter = await data.json();
  categories = await catdata.json();
  console.log(categories);
  visRetter();
  opretKnapper();
}

function opretKnapper() {
  categories.forEach(cat =>{
    document.querySelector("#filtrering").innerHTML += `<button class="filter" data-ret="${cat.id}">${cat.name}</button>`
  })
  addEventListenersToButton();
}
function addEventListenersToButton() {
  document.querySelectorAll("#filtrering button").forEach(elm =>{
    elm.addEventListener("click", filtrering);
  })
  
};

function filtrering() {
  filterRet = this.dataset.ret;
  console.log(filterRet);

  visRetter();
}

function visRetter() {
  console.log(visRetter);
  let temp = document.querySelector("template");
  let container = document.querySelector(".retcontainer");
  container.innerHTML = "";

  retter.forEach(ret => {
    if ( filterRet == "alle" || ret.categories.includes(parseInt(filterRet))){
      let klon = temp.cloneNode(true).content;
      klon.querySelector("h2").textContent = ret.title.rendered;
      klon.querySelector(".info").textContent = ret.beskrivelse;
      klon.querySelector(".pris").textContent = ret.pris;
      klon.querySelector("img").src = ret.billede.guid;

      klon.querySelector("article").addEventListener("click", () => {
        location.href = ret.link;
        });

      container.appendChild(klon);
    }
  });
}
hentData();

</script>
		
	</div><!-- #primary -->

<?php
get_footer();
