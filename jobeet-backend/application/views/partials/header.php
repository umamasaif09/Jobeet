
<header class="site-header">
    <a href="<?php echo site_url("jobs/index"); ?>" class="site-logo logo-text">
        Jobeet
    </a>
    <div class=header-actions>
        <form method = "GET" action="<?php echo site_url("jobs/search"); ?>" class="search-form">
        <input type="text" name="keyword" placeholder = "Live Search" value="<?php echo htmlspecialchars($this->input->get("keyword")?? "")?>" required>
        <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <a href="<?php echo site_url("jobs/createJob"); ?>" class="btn btn-primary post-job-btn">
            Post a Job
        </a>

    </div>
    

</header>    


    