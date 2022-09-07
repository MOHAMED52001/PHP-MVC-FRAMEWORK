<form action="" method="post" class="container">
    <h1>Create an account</h1>

    <div class="row">
        <div class="col form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="fname">
            <label for="floatingInput">First Name : </label>
        </div>
        <div class="col form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="lname">
            <label for="floatingInput">Last Name : </label>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="passwd">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="cmpasswd">
        <label for="floatingPassword">Confirm Password</label>
    </div>
    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>