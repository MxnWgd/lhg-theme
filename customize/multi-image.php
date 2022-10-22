<?php
if (!class_exists('WP_Customize_Image_Control')) {
  return null;
}

class Multi_Image_Selector extends WP_Customize_Control {
  public function enqueue() {
    wp_enqueue_style('multi-image-style', get_template_directory_uri() . '/customize/multi-image.css');
    wp_enqueue_script('multi-image-script', get_template_directory_uri() . '/customize/multi-image.js', array('jquery'), rand(), true);
  }

  public function render_content() {
    wp_enqueue_media();

    ?>
    <label>
      <span class='customize-control-title'>Ausgewähle Bilder</span>
    </label>
    <span class="customize-control-description">Lege hier die Bilder für die Slideshow fest. Auf anderen Unterseiten wird das erste Bild der Slideshow angezeigt.</span>
    <div>
      <ul class='images'></ul>
    </div>
    <div class='actions'>
      <a class="button-secondary upload">Hinzufügen</a>
    </div>

    <input class="wp-editor-area" id="imagesInput" type="hidden" <?php $this->link(); ?>>
    <?php
  }
}
 ?>
