<?php 

include_once ('UserSession.php');

if (isset($_SESSION['emp_number']))
{

?>

<header aria-label="Site Header" class="shadow-sm">
  <div class="mx-auto max-w-screen-xl p-4">
    <div class="flex items-center justify-between gap-4 lg:gap-10">
      <nav
        aria-label="Site Nav"
        class="hidden gap-8 text-sm font-medium md:flex md:items-center"
      >
        <a class="text-gray-500" href="./">Home</a>
        <a class="text-gray-500" href="">Time Sheet</a>
      </nav>

      <a
          class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white"
          href="./app/UserLogout.php"
        >
          Logout
        </a>
      
      <div class="lg:hidden">
        <button class="rounded-lg bg-gray-100 p-2 text-gray-600" type="button">
          <span class="sr-only">Open menu</span>
          <svg
            aria-hidden="true"
            class="h-5 w-5"
            fill="none"
            stroke="currentColor"
            viewbox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M4 6h16M4 12h16M4 18h16"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>

<?php } else { ?>
<?php } ?>