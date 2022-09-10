<nav aria-label="alternative nav">
  <div class="fixed bottom-0 z-10 mt-12 h-20 w-full content-center bg-gray-800 shadow-xl md:relative md:h-screen md:w-48">
    <div class="content-center justify-between text-left md:fixed md:left-0 md:top-0 md:mt-12 md:w-48 md:content-start">
      <ul class="list-reset flex flex-row px-1 pt-3 text-center md:flex-col md:py-3 md:px-2 md:text-left">
        <li class="mr-3 flex-1">
          <a href="home" class="{{ $active === 'home' ? 'border-blue-600' : 'border-gray-800' }} block border-b-2 py-1 pl-1 align-middle text-white no-underline hover:text-white md:py-3">
            <i class="fas fa-chart-area {{ $active === 'home' ? 'text-blue-600' : '' }} pr-0 md:pr-3">
            </i><span class="block pb-1 text-xs text-white md:inline-block md:pb-0 md:text-base md:text-white">Analytics</span>
          </a>
        </li>

        <li class="mr-3 flex-1">
          <a href="notif" class="{{ $active === 'notif' ? 'border-pink-600' : 'border-gray-800' }} block border-b-2 py-1 pl-1 align-middle text-white no-underline hover:border-pink-500 hover:text-white md:py-3">
            <i class="fas fa-bell {{ $active === 'hotif' ? 'text-pink-600' : '' }} pr-0 md:pr-3"></i>
            <span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Notification</span>
          </a>
        </li>

        <li class="mr-3 flex-1">
          <a href="setting" class="{{ $active === 'setting' ? 'border-amber-600' : 'border-gray-800' }} block border-b-2 py-1 pl-0 align-middle text-white no-underline hover:border-amber-500 hover:text-white md:py-3 md:pl-1">
            <i class="fa fa-cog {{ $active === 'setting' ? 'text-amber-600' : '' }} pr-0 md:pr-3"></i>
            <span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Setting</span>
          </a>
        </li>

        <li class="mr-3 flex-1">
          <a href="logs" class="{{ $active === 'logs' ? 'border-green-600' : 'border-gray-800' }} block border-b-2 py-1 pl-0 align-middle text-white no-underline hover:border-green-500 hover:text-white md:py-3 md:pl-1">
            <i class="fa fa-clock {{ $active === 'logs' ? 'text-green-600' : '' }} pr-0 md:pr-3"></i>
            <span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Logs</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
