<?php
/* 
Template Name:home Page

*/
get_header();
?>
<section class="banner-section" style=" background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/1.png');">
  <div class="container-fluid">
    <div class="banner-padding">
      <div class="btn-back">
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/Arrow.png');" alt=""> BACK TO WORK</a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class=" banner-padding banner-content">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.png');" alt="" class="img-woodbine">
          <h1>A Legacy Reinvented</h1>
          <div class="author-content">
            <p>The team at Idea Theorem™ took the time to really understand our business needs and challenges, and ultimately produced a solution which was excellent. Their UX research and design is incredibly thorough and it shows in the final product. We didn’t hesitate beginning another project with them once our first website build was complete.</p>
            <div class="author-detail">
              <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.png');" alt="">
              </div>
              <div>
                <h5>Andrew Fuss</h5>
                <p>Senior Marketing Manager</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
       
       </div>
    </div>
  </div>
</section>

<section class="challenge-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <h3>The <span style="color:#FA4321">Challenge</span></h3>
        <p>Established in 1881 as the Ontario Jockey Club, the prestigious Woodbine Entertainment Group is home to Toronto’s only Casino and Race Track for recreational gambling. It also houses a variety of venues for events including restaurants and bars delivering experiences ranging from old-world charm to swanky cosmopolitan vibes. Being the most preferred destination for all kinds of social and private events, Woodbine felt like it needed to revamp their digital presence to consolidate their numer-uno status.</p>
      </div>
      <div class="col-lg-8">
        <div class="challenge-image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.png');" alt="">
        </div>
      </div>
    </div>
  </div>
</section>
<?php
get_footer();
?>
