<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>
<template>
    <article>
        <div>
            <h2 class="navn"></h2>
            <img src="" alt="">
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
        //visProjekter();
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
    </section><!-- #primary -->

    <?php
    get_footer();