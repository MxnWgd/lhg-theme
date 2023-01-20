<?php
if (!class_exists('WP_Customize_Image_Control')) {
  return null;
}

class Person_Selector extends WP_Customize_Control {
  public function enqueue() {
    wp_enqueue_style('person-select-style', get_template_directory_uri() . '/customize/person-select.css');
    wp_enqueue_script('person-select-script', get_template_directory_uri() . '/customize/person-select.js', array('jquery'), rand(), true);
  }

  public function render_content() {
    ?>
    <label>
      <span class='customize-control-title'>Personenauswahl</span>
    </label>
    <span class="customize-control-description">Wähle hier die gewünschten sichtbaren Personen aus und ändere ihre Reihenfolge.</span>
    <div class="person-selector">
      <ul class="persons-list"></ul>

      <div class="available-persons">
        <strong>Person hinzufügen:</strong>

        <ul class="available-persons-list">
          <?php
            $existing_persons = $this->value() != '' ? explode(',', $this->value()) : array();

            $query_args = array(
              'post_type' => array('persons'),
              'posts_per_page' => -1,
            );

            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
              $av_person_query = $query->posts;

              foreach ($av_person_query as $p) {
                if (in_array($p->ID, $existing_persons)) {
                  continue;
                }

                ?>
                <li class="available-persons-element" person-id="<?php echo $p->ID; ?>" onclick="addPerson(event, '<?php echo $p->ID; ?>')">
                  <div class="available-persons-thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url($p->ID, 'thumbnail'); ?>');"></div>
                  <span class="available-persons-name"><?php echo $p->post_title; ?></span>
                </li>
                <?php
              }
            }
          ?>
        </ul>
      </div>

      <button type="button" name="button" id="resetPersons" onclick="deleteAllPersons()">Alle Personen entfernen/zurücksetzen</button>
    </div>


    <input class="wp-editor-area" id="personsInput" type="hidden" <?php $this->link(); ?> >
    <?php
  }
}





?>
