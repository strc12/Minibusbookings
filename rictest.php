<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Bootstrap 5 Password Toggle</title>

<!-- Bootstrap 5 -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>

<!-- Bootstrap Icons -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

<style>
body {
  background-color: #f8f9fa;
}

.login-card {
  max-width: 420px;
  width: 100%;
}

.password-wrapper {
  position: relative;
}

.password-toggle {
  position: absolute;
  top: 50%;
  right: 15px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 1.2rem;
  color: #6c757d;
}

.password-toggle:hover {
  color: #212529;
}
</style>
</head>

<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">

  <div class="card shadow login-card">
    <div class="card-body p-4">

      <h2 class="text-center mb-4">
        Login
      </h2>

      <form>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">
            Email
          </label>

          <input
            type="email"
            class="form-control"
            id="email"
            placeholder="Enter email"
            value="fds"
          >
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label for="password" class="form-label">
            Password
          </label>

          <div class="password-wrapper">

            <input
              type="password"
              class="form-control pe-5"
              id="password"
              placeholder="Enter password"
              value="fdsdf"
            >

            <i
              class="bi bi-eye password-toggle"
              id="togglePassword"
            ></i>

          </div>
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="btn btn-primary w-100"
        >
          Sign In
        </button>

      </form>

    </div>
  </div>

</div>

<script>
const password =
document.getElementById("password");

const toggle =
document.getElementById("togglePassword");

toggle.addEventListener("click", () => {

if (password.type === "password") {
    password.type = "text";
} else {
    password.type = "password";
}

toggle.classList.toggle("bi-eye");

toggle.classList.toggle("bi-eye-slash");

});
</script>

</body>
</html>