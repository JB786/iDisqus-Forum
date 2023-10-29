
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up to iDisqus Forums</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="container" class="container text-center">
          <form action="./partials/_handleSignup.php" method="post" class="d-flex flex-column align-items-center">
            <div class="my-3 col-md-8">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3 col-md-8">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3 col-md-8">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-8">
              <label for="cpassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="cpassword" name="cpassword" aria-describedby="cpasswordHelp">
              <div id="cpasswordHelp" class="form-text">Must Be Same As Above Entered Password</div>
            </div>
            <button type="submit" class="btn btn-dark col-md-8" data-bs-theme="dark">Submit</button>
          </form>
          <p class="mt-2">Already Have an Account? <a class="text-warning" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Login</a></p>
        </div>

      </div>
      <div class="modal-footer bg-danger">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>