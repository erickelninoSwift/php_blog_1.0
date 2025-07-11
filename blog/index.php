  <?php include "./includes/home_header.php" ?>
  <!-- Main Content-->

  <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
          <div class="col-md-10 col-lg-8 col-xl-7">
              <?php if(isset($_SESSION['username']) && isset($_SESSION['email'])){
                echo 'Hello, ' . $_SESSION['username'];
              } ?>
              <!-- Post preview-->
              <div class="post-preview">
                  <a href="posts/post.html">
                      <h2 class="post-title">Man must explore, and this is exploration at its greatest</h2>
                      <h3 class="post-subtitle">Problems look mighty small from 150 miles up</h3>
                  </a>
                  <p class="post-meta">
                      Posted by
                      <a href="#!">Start Bootstrap</a>
                      on September 24, 2022
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <!-- Post preview-->
              <div class="post-preview">
                  <a href="post.html">
                      <h2 class="post-title">I believe every human has a finite number of heartbeats. I don't intend
                          to waste any of mine.</h2>
                  </a>
                  <p class="post-meta">
                      Posted by
                      <a href="#!">Start Bootstrap</a>
                      on September 18, 2022
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <!-- Post preview-->
              <div class="post-preview">
                  <a href="post.html">
                      <h2 class="post-title">Science has not yet mastered prophecy</h2>
                      <h3 class="post-subtitle">We predict too much for the next year and yet far too little for the
                          next ten.</h3>
                  </a>
                  <p class="post-meta">
                      Posted by
                      <a href="#!">Start Bootstrap</a>
                      on August 24, 2022
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <!-- Post preview-->
              <div class="post-preview">
                  <a href="post.html">
                      <h2 class="post-title">Failure is not an option</h2>
                      <h3 class="post-subtitle">Many say exploration is part of our destiny, but it’s actually our
                          duty to future generations.</h3>
                  </a>
                  <p class="post-meta">
                      Posted by
                      <a href="#!">Start Bootstrap</a>
                      on July 8, 2022
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <!-- Pager-->

          </div>
      </div>
  </div>
  <!-- Footer-->
  <?php include "./includes/home_footer.php"; ?>