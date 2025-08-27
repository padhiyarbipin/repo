<?php get_header(); ?>

<main>
    <!-- START ERROR PAGE SECTION -->
    <section class="error-page-section">
        <div class="container">
            <div class="add-content"></div>
            <div class="error-404 not-found">
                <h1>A página que procura não existe</h1>
                <p>Experimente uma das seguintes alternativas</p>
                <div class="not-found-btn">
                    <a href="<?php echo home_url(); ?>" class="home-btn"><i class="fa fa-home"></i>Início</a>
                    <span class="search-icon not-found-serch-btn" style="cursor:pointer;"><i class="fa-solid fa-magnifying-glass"></i>Pesquisar</span>
                    <div style="display:none;" class="popup-search">
                        <div class="popup-search-inner">
                            <div class="input-field">
                                <input type="text" class="live-search" placeholder="o que procura?" autocomplete="off" />
                                <span class="close-search" style="cursor:pointer;">&times;</span>
                            </div>
                            <div class="search-results" style="display:none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end ERROR PAGE SECTION -->
</main>

<?php get_footer(); ?>