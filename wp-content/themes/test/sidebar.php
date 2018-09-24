<?php
/**
 * Created by PhpStorm.
 * User: skuzn
 * Date: 11.09.2018
 * Time: 17:14
 */
if(is_active_sidebar('right_sidebar')): ?>
    <aside>
        <?php dynamic_sidebar('right_sidebar'); ?>
    </aside>
<? endif; ?>

