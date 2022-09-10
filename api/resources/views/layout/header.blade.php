<header>
  <!--Nav-->
  <nav aria-label="menu nav" class="fixed top-0 z-20 mt-0 h-auto w-full bg-gray-800 px-1 pt-2 pb-1 md:pt-1">
    <div class="flex flex-wrap items-center">
      <div class="jus flex w-full content-end pt-2 md:justify-end">
        <ul class="list-reset flex flex-1 items-center md:flex-none">
          <li class="flex-1 md:mr-3 md:flex-none">
            <div class="relative inline-block">
              <button onclick="toggleDD('myDropdown')" class="drop-button py-2 px-2 text-white">
                <i class="fa fa-user pr-0 md:pr-3"></i>
                Hi, {{ auth()->user()->username }}
                <svg class="inline h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </button>
              <div id="myDropdown" class="dropdownlist invisible absolute right-0 z-30 mt-3 overflow-auto bg-gray-800 p-3 text-white">
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit">
                    <i class="fas fa-sign-out-alt fa-fw"></i>Logout
                  </button>
                </form>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
