<div class="row col-md-12" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <section class="login-form">
        <form action="/" method="post" name="logForm" role="login">
          <img src="http://i.imgur.com/RcmcLv4.png" class="img-responsive" alt="" />
          <input type="email" name="email" placeholder="Email" class="form-control input-lg">
          <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password">
          <button type="button" name="login" class="btn btn-lg btn-primary btn-block">Log in</button>
          <?php 
            if($this->data['notice']) {
              echo '<div class="alert alert-danger">invalid Login</div>';
            }
            else{
              echo '<div></div>';
            }
          ?>
        </form>
      </section>  
      </div>