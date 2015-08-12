<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * IMPORTANT :  There isn't any need to modify this template file, most edits can't be done via hooks
 *              and filters or the partial template parts at partials/footer/.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */ ?>

            <?php wpex_hook_main_bottom(); ?>

        </div><!-- #main-content --><?php // main-content opens in header.php ?>
                
        <?php wpex_hook_main_after(); ?>

        <?php wpex_hook_wrap_bottom(); ?>

    </div><!-- #wrap -->

    <?php wpex_hook_wrap_after(); ?>

</div><!-- .outer-wrap -->

<?php wp_footer(); ?>

</body>
</html>