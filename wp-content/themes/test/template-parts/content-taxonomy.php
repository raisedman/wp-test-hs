 <h3><?php the_title() ?></h3>
 <div><?php $taxonomie=get_the_terms(get_the_ID(),'taxonomy');?>
        <p>
        <?php foreach( $taxonomie as $tax ){
                echo ($tax->name);
                echo ('<br>');
            }?>
        </p>
 </div>
