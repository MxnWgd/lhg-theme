<?php
  $result = '<article id="person-' . $person->ID . '" class="persons-wrapper">';
    $result .= '<div ';
    $result .= !empty(get_the_post_thumbnail_url($person->ID, 'large')) ? 'style="background-image: url(' . get_the_post_thumbnail_url($person->ID, 'large') . '); background-size: cover;"' : '';
    $result .= ' class="persons-wrapper-thumbnail"></div>';

    $result .= '<div class="persons-wrapper-background">';
      $result .= '<h1 class="persons-wrapper-title">' . $person->post_title . '</h1>';
      $result .= '<p class="persons-wrapper-position">' . get_post_meta($person->ID, 'position', true) . '</p>';
      $result .= '<p class="persons-wrapper-subtitle">' . get_post_meta($person->ID, 'subtitle', true) . '</p>';
    $result .= '</div>';

    $result .= '<div class="persons-wrapper-sm">';
      $result .= get_post_meta($person->ID, 'mail', true) != null ? '<a title="E-Mail schreiben" class="persons-wrapper-sm-icon" target="_blank" href="mailto:' . get_post_meta($person->ID, 'mail', true) . '" rel="noreferrer"><i class="fas fa-envelope"></i></a>' : '';
      $result .= get_post_meta($person->ID, 'facebook', true) != null ? '<a title="Facebook-Profil" class="persons-wrapper-sm-icon" target="_blank" href="' . get_post_meta($person->ID, 'facebook', true) . '" rel="noreferrer"><i class="fab fa-facebook-square"></i></a>' : '';
      $result .= get_post_meta($person->ID, 'instagram', true) != null ? '<a title="Instragram-Account" class="persons-wrapper-sm-icon" target="_blank" href="' . get_post_meta($person->ID, 'instagram', true) . '" rel="noreferrer"><i class="fab fa-instagram"></i></a>' : '';
      $result .= get_post_meta($person->ID, 'twitter', true) != null ? '<a title="Twitter-Profil" class="persons-wrapper-sm-icon" target="_blank" href="' . get_post_meta($person->ID, 'twitter', true) . '" rel="noreferrer"><i class="fab fa-twitter"></i></a>' : '';
    $result .= '</div>';

    if (get_post_meta($person->ID, 'description', true) != null) {
      $result .= '<details class="person-wrapper-description">';
        $result .= '<summary><span class="expand-icon-ud"></span></summary>';
        $result .= '<div>' . get_post_meta($person->ID, 'description', true) . '</div>';
      $result .= '</details>';
    }
  $result .= '</article>';


 ?>
