
<div class="row">
    <div class="col-lg-12">
        <p>Made by <a href="http://thomaspark.co" rel="nofollow">Codeigniter</a>. Contact him at <a href="mailto:thomas@bootswatch.com">livecn@163.com</a>.</p>
        <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>
        <?php if (ENVIRONMENT == 'development'): ?>
            <p class="pull-right text-muted">
                CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
                Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
                Memory Usage: <strong>{memory_usage}</strong>
            </p>
        <?php endif; ?>
        <p class="text-muted">&copy; 2017 All rights reserved.</p>
    </div>
</div>