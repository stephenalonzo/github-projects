<?php 

require_once ('./header.php');
require_once ('../controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>Login - Admin | Department of Lands and Natural Resources</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

  <link rel="stylesheet" href="../font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../dist/inter.css">
  <link rel="stylesheet" href="../dist/output.css">
  <!--Required .js file to load nav &amp; footer-->
  <!-- <script src="../js/scrollToTop.js"></script> -->
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
    window.history.forward();

    function noBack() {
      window.history.forward();
    }
  </script>
</head>

<body>
  <main class="page-container">
    <div class="page-wrapper">
      <section class="login px-4 py-6">
        <div class="container mx-auto xl:max-w-screen-lg">

          <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <div class="max-w-lg mx-auto">

              <form action="" method="POST" class="p-8 mt-6 mb-0 space-y-4 rounded-lg shadow-2xl">

                <div>
                  <label for="email" class="text-sm font-medium">Username</label>

                  <div class="relative mt-1">
                    <input
                           type="text"
                           name="user"
                           class="w-full p-4 pr-12 text-sm border-gray-200 rounded-lg shadow-sm"
                           placeholder="Enter username" />
                  </div>
                </div>

                <div>
                  <label for="password" class="text-sm font-medium">Password</label>

                  <div class="relative mt-1">
                    <input
                           type="password"
                           name="password"
                           class="w-full p-4 pr-12 text-sm border-gray-200 rounded-lg shadow-sm"
                           placeholder="Enter password" />

                  </div>
                </div>

                <button
                        type="submit"
                        name="userLogin"
                        class="block w-full px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-md border-2 border-blue-600 hover:bg-white hover:text-blue-600 duration-200">
                  Sign in
                </button>
              </form>
            </div>
          </div>

        </div>
      </section>
      <div class="relative">
        <button type="button"
                class="bg-dlnrpurple-1 py-4 px-6 fixed bottom-8 right-6 drop-shadow-md z-50 scrollToTopBtn"
                id="scrollToTop">
          <i class="fas fa-arrow-to-top text-white text-xl"></i>
        </button>
      </div>
    </div>
    <div class="footer-load sticky-footer"></div>
  </main>
</body>

</html>