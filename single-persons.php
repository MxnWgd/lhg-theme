<?php get_header(); ?>

<div class="content-wrapper">
  <div class="post">
    <?php while (have_posts()) { the_post(); ?>
      <article class="single-wrapper">
        <?php if (get_the_post_thumbnail_url() != '') { ?>
          <div class="persons-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');" title="Bild von <?php the_title(); ?>"></div>
        <?php } ?>

        <div class="persons-meta">
          <?php if (get_post_meta(get_the_ID(), 'position', true) != null) { ?>
            <h3 class="persons-subtitle"><?php echo get_post_meta(get_the_ID(), 'position', true); ?></h3>
          <?php } ?>

          <h1 class="persons-title"><?php the_title(); ?></h1>

          <?php if (get_post_meta(get_the_ID(), 'subtitle', true) != null) { ?>
            <h3 class="persons-subtitle"><?php echo get_post_meta(get_the_ID(), 'subtitle', true); ?></h3>
          <?php } ?>
        </div>

        <div class="persons-contact-meta">
          <?php if (get_post_meta(get_the_ID(), 'mail', true) != null) { ?>
            <a title="E-Mail schreiben" class="persons-contact-meta-icon mail-encrypted" data-enc-email="<?php echo str_rot13(get_post_meta(get_the_ID(), 'mail', true)) ?>" href="javascript:;" rel="noreferrer"><i class="fas fa-envelope"></i> E-Mail</a>
          <?php } ?>

          <?php if (get_post_meta(get_the_ID(), 'phone', true) != null) { ?>
            <a title="Anrufen" class="persons-contact-meta-icon" href="tel:<?php echo get_post_meta(get_the_ID(), 'phone', true) ?>" rel="noreferrer"><i class="fas fa-phone-alt"></i> Telefon</a>
          <?php } ?>

          <?php if (get_post_meta(get_the_ID(), 'facebook', true) != null) { ?>
            <a title="Facebook-Profil" class="persons-contact-meta-icon" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'facebook', true) ?>" rel="noreferrer"><i class="fab fa-facebook-square"></i></a>
          <?php } ?>

          <?php if (get_post_meta(get_the_ID(), 'instagram', true) != null) { ?>
            <a title="Instagram-Account" class="persons-contact-meta-icon" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'instagram', true) ?>" rel="noreferrer"><i class="fab fa-instagram"></i></a>
          <?php } ?>

          <?php if (get_post_meta(get_the_ID(), 'twitter', true) != null) { ?>
            <a title="Twitter-Profil" class="persons-contact-meta-icon" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'twitter', true) ?>" rel="noreferrer"><i class="fab fa-twitter"></i></a>
          <?php } ?>

          <?php if (get_post_meta(get_the_ID(), 'linkedin', true) != null) { ?>
            <a title="LinkedIn-Profil" class="persons-contact-meta-icon" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'linkedin', true) ?>" rel="noreferrer"><i class="fab fa-linkedin"></i></a>
          <?php } ?>
        </div>

        <div class="post-content">
          <?php echo get_post_meta(get_the_ID(), 'description', true); ?>
        </div>
      </article>
    <?php } ?>
  </div>
</div>

<?php get_footer(); ?>
