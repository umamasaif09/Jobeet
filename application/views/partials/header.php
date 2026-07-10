
    <div class="container">
        <header>
            <a href="<?php echo site_url("jobs/index"); ?>">
                <h1>Jobeet</h1>
            </a>

        <nav class="top-bar">

            <form method = "GET" action="<?php echo site_url("jobs/search"); ?>" class="search-form">
            <input type="text" name="keyword" placeholder = "Live Search" required>
            <button type="submit" class="btn-primary">Search Keyword</button>
            </form>
        
            <a href="<?php echo site_url("jobs/createJob"); ?>" class="btn-primary">
                Post a Job
            </a>
        </nav>
    </header>    
</div>

    