<?php 

error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

include_once ('./session.php');

if (!isset($_SESSION['id'])) {

} else {

?>

<header class="shadow-sm">
    <div class="max-w-screen-xl p-4 mx-auto">
      <div class="flex items-center justify-between gap-4 lg:gap-10">
        <nav class="hidden gap-8 font-medium md:flex">
          <a class="text-gray-500 border-b-2 border-white border-spacing-2 hover:border-blue-600 duration-200" href="./index.php">Home</a>
        </nav>
        <form action="" method="post" class="flex items-center space-x-2">
          <a href="./reservations.php" class="px-5 py-2 text-sm font-medium text-white bg-gray-400 rounded-md border-2 border-gray-400 hover:bg-white hover:text-gray-400 duration-200">
            Calendar
          </a>
          <button type="submit" name="userLogout"
             class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-md border-2 border-blue-600 hover:bg-white hover:text-blue-600 duration-200"
             href="">
            Logout
          </button>
        </form>
      </div>
    </div>
  </header>

<?php } ?>