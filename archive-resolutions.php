<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">Beschlusssammlung</h1>

    <div class="resolution-filter">
      <h3>Filtern</h3>

      <form class="resolution-filter-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
        <?php
          $all_applicants = get_categories(array(
            'taxonomy' => 'applicants',
            'orderby' => 'name'
          ));

          if (sizeof($all_applicants) > 0) {
        ?>
          <select class="resolution-filter-select" name="applicants" id="applicantsSelect" onchange="jQuery('#filter').submit();">
            <option value="all">Alle Antragsteller</option>

            <?php
              foreach ($all_applicants as $value) {
                ?><option value="<?php echo $value->cat_ID ?>"><?php echo $value->name ?></option><?php
              }
            ?>
          </select>
        <?php } else { ?>
          <input type="hidden" name="applicants" id="applicantsSelect" value="all">
        <?php } ?>

        <?php
          $all_assemblies = get_categories(array(
            'taxonomy' => 'assembly',
          ));

          function hierarchical_categories($cat, $level = 0) {
            $next = get_categories(array(
              'hide_empty'=> false,
              'taxonomy' => 'assembly',
              'orderby' => 'name',
              'order' => 'ASC',
              'parent' => $cat,
            ));

            if ($next) {
              foreach($next as $cat) {
                ?>
                <option value="<?php echo $cat->cat_ID ?>">
                  <?php for ($i=0; $i < $level; $i++) {
                    ?>&nbsp;&nbsp;&nbsp;<?php
                  } ?>
                  <?php echo $cat->name; ?>
                </option>
                <?php
                hierarchical_categories($cat->term_id, $level + 1);
              }
            }
          }

          if (sizeof($all_assemblies) > 0) { ?>
            <select class="resolution-filter-select" name="assembly" id="assemblySelect" onchange="jQuery('#filter').submit();">
              <option value="all">Alle Versammlungen</option>
              <?php hierarchical_categories(0); ?>
            </select>
          <?php } else { ?>
            <input type="hidden" name="assembly" id="assemblySelect" value="all">
          <?php } ?>

          <?php
            $all_tags = get_categories(array(
              'taxonomy' => 'resolutiontags',
              'orderby' => 'name'
            ));

            if (sizeof($all_tags) > 0) {
          ?>
          <select class="resolution-filter-select" name="tags" id="tagsSelect" onchange="jQuery('#filter').submit();">
            <option value="all">Alle Schlagworte</option>

            <?php
              foreach ($all_tags as $value) {
                ?><option value="<?php echo $value->cat_ID ?>"><?php echo $value->name ?></option><?php
              }
            ?>
          </select>
        <?php } else { ?>
          <input type="hidden" id="tagsSelect" name="tags" value="all">
        <?php } ?>

        <button class="resolution-search-button" type="button" name="Suche" id="openSearchButton"><i class="fas fa-search"></i>&nbsp;&nbsp;Textsuche</button>

        <input type="hidden" name="action" value="resolutionfilter">
      </form>

      <form class="resolution-search-form hide" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="post" id="resolutionsearch">

        <button type="button" name="Suche schließen" id="closeSearchButton">&lt;</button>
        <input type="search" name="search" value="" placeholder="Suche nach Beschlussinhalten..." id="resolutionSearchForm">
        <button type="submit" name="Suchen" id="searchSubmitButton">Suchen</button>

        <input type="hidden" name="action" value="resolutionsearch">
      </form>
    </div>

    <div class="posts-list-wrapper" id="response">
      
    </div>

    <form class="load-more-posts" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="post" id="resolutionLoadPosts">
      <!-- <button type="submit" name="Weitere Posts laden" title="Weitere Posts laden">Weitere Posts laden</button> -->
      <input type="hidden" name="action" value="resolutions">
    </form>
  </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/resolution-archive.js"></script>

<?php get_footer(); ?>
