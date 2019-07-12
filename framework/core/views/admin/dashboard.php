<div class="wrap">
    <h2>Theme Options</h2>
    <form method="post" action="options.php?page=mytheme-settings">
        <?php
            settings_fields( 'general-settings' );
            settings_fields( 'layout-settings' );

            do_settings_sections( 'mytheme-settings' );

        submit_button();
        ?>
    </form>
</div>