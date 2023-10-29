
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5" id="loginModalLabel">Login to iDisqus Forums</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="container" class="container text-center">
          <form action="./partials/_handleLogin.php" method="post" class="d-flex flex-column align-items-center mt-4">
            <div class="mb-3 col-md-8">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="mb-3 col-md-8">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              <p class="mt-2">Forgot Password? <a class="text-warning" data-bs-toggle="modal" data-bs-target="#signupModal" style="cursor: pointer;">Click Here</a></p>
            </div>

            <button type="submit" class="btn btn-dark col-md-8" data-bs-theme="dark">Login</button>
          </form>
          <p class="mt-2">Not Registered? <a class="text-warning" data-bs-toggle="modal" data-bs-target="#signupModal" style="cursor: pointer;">Sign Up</a></p>
        </div>

      </div>
      <div class="modal-footer bg-danger">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>