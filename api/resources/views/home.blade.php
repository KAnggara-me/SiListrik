<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
  <meta name="author" content="name">
  <meta name="description" content="description here">
  <meta name="keywords" content="keywords,here">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
  <!--Replace with your tailwind.css once created-->
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  <!--Totally optional :) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

</head>

<body class="mt-12 bg-gray-800 font-sans leading-normal tracking-normal">

  <header>
    <!--Nav-->
    <nav aria-label="menu nav" class="fixed top-0 z-20 mt-0 h-auto w-full bg-gray-800 px-1 pt-2 pb-1 md:pt-1">

      <div class="flex flex-wrap items-center">
        <div class="flex flex-shrink justify-center text-white md:w-1/3 md:justify-start">
          <a href="#" aria-label="Home">
            <span class="pl-2 text-xl"><i class="em em-grinning"></i></span>
          </a>
        </div>

        <div class="flex flex-1 justify-center px-2 text-white md:w-1/3 md:justify-start">
          <span class="relative w-full">
            <input aria-label="search" type="search" id="search" placeholder="Search"
              class="w-full appearance-none rounded border border-transparent bg-gray-900 py-3 px-2 pl-10 leading-normal text-white transition focus:border-gray-400 focus:outline-none">
            <div class="search-icon absolute" style="top: 1rem; left: .8rem;">
              <svg class="pointer-events-none h-4 w-4 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
              </svg>
            </div>
          </span>
        </div>

        <div class="flex w-full content-center justify-between pt-2 md:w-1/3 md:justify-end">
          <ul class="list-reset flex flex-1 items-center justify-between md:flex-none">
            <li class="flex-1 md:mr-3 md:flex-none">
              <a class="inline-block py-2 px-4 text-white no-underline" href="#">Active</a>
            </li>
            <li class="flex-1 md:mr-3 md:flex-none">
              <a class="hover:text-underline inline-block py-2 px-4 text-gray-400 no-underline hover:text-gray-200" href="#">link</a>
            </li>
            <li class="flex-1 md:mr-3 md:flex-none">
              <div class="relative inline-block">
                <button onclick="toggleDD('myDropdown')" class="drop-button py-2 px-2 text-white"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, User <svg class="inline h-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg></button>
                <div id="myDropdown" class="dropdownlist invisible absolute right-0 z-30 mt-3 overflow-auto bg-gray-800 p-3 text-white">
                  <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                  <a href="#" class="block p-2 text-sm text-white no-underline hover:bg-gray-800 hover:no-underline"><i class="fa fa-user fa-fw"></i> Profile</a>
                  <a href="#" class="block p-2 text-sm text-white no-underline hover:bg-gray-800 hover:no-underline"><i class="fa fa-cog fa-fw"></i> Settings</a>
                  <div class="border border-gray-800"></div>
                  <a href="#" class="block p-2 text-sm text-white no-underline hover:bg-gray-800 hover:no-underline"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>

    </nav>
  </header>


  <main>

    <div class="flex flex-col md:flex-row">
      <nav aria-label="alternative nav">
        <div class="fixed bottom-0 z-10 mt-12 h-20 w-full content-center bg-gray-800 shadow-xl md:relative md:h-screen md:w-48">

          <div class="content-center justify-between text-left md:fixed md:left-0 md:top-0 md:mt-12 md:w-48 md:content-start">
            <ul class="list-reset flex flex-row px-1 pt-3 text-center md:flex-col md:py-3 md:px-2 md:text-left">
              <li class="mr-3 flex-1">
                <a href="#" class="block border-b-2 border-gray-800 py-1 pl-1 align-middle text-white no-underline hover:border-pink-500 hover:text-white md:py-3">
                  <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Tasks</span>
                </a>
              </li>
              <li class="mr-3 flex-1">
                <a href="#" class="block border-b-2 border-gray-800 py-1 pl-1 align-middle text-white no-underline hover:border-purple-500 hover:text-white md:py-3">
                  <i class="fa fa-envelope pr-0 md:pr-3"></i><span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Messages</span>
                </a>
              </li>
              <li class="mr-3 flex-1">
                <a href="#" class="block border-b-2 border-blue-600 py-1 pl-1 align-middle text-white no-underline hover:text-white md:py-3">
                  <i class="fas fa-chart-area pr-0 text-blue-600 md:pr-3"></i><span class="block pb-1 text-xs text-white md:inline-block md:pb-0 md:text-base md:text-white">Analytics</span>
                </a>
              </li>
              <li class="mr-3 flex-1">
                <a href="#" class="block border-b-2 border-gray-800 py-1 pl-0 align-middle text-white no-underline hover:border-red-500 hover:text-white md:py-3 md:pl-1">
                  <i class="fa fa-wallet pr-0 md:pr-3"></i><span class="block pb-1 text-xs text-gray-400 md:inline-block md:pb-0 md:text-base md:text-gray-200">Payments</span>
                </a>
              </li>
            </ul>
          </div>


        </div>
      </nav>
      <section>
        <div id="main" class="main-content mt-12 flex-1 bg-gray-100 pb-24 md:mt-2 md:pb-5">

          <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 text-2xl text-white shadow">
              <h1 class="pl-2 font-bold">Analytics</h1>
            </div>
          </div>

          <div class="flex flex-wrap">
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-green-600 bg-gradient-to-b from-green-200 to-green-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-green-600 p-5"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">Total Revenue</h2>
                    <p class="text-3xl font-bold">$3249 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-pink-500 bg-gradient-to-b from-pink-200 to-pink-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-pink-600 p-5"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                    <p class="text-3xl font-bold">249 <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-yellow-600 bg-gradient-to-b from-yellow-200 to-yellow-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-yellow-600 p-5"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">New Users</h2>
                    <p class="text-3xl font-bold">2 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-blue-500 bg-gradient-to-b from-blue-200 to-blue-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-blue-600 p-5"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">Server Uptime</h2>
                    <p class="text-3xl font-bold">152 days</p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-indigo-500 bg-gradient-to-b from-indigo-200 to-indigo-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-indigo-600 p-5"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">To Do List</h2>
                    <p class="text-3xl font-bold">7 tasks</p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Metric Card-->
              <div class="rounded-lg border-b-4 border-red-500 bg-gradient-to-b from-red-200 to-red-100 p-5 shadow-xl">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pr-4">
                    <div class="rounded-full bg-red-600 p-5"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                  </div>
                  <div class="flex-1 text-right md:text-center">
                    <h2 class="font-bold uppercase text-gray-600">Issues</h2>
                    <p class="text-3xl font-bold">3 <span class="text-red-500"><i class="fas fa-caret-up"></i></span></p>
                  </div>
                </div>
              </div>
              <!--/Metric Card-->
            </div>
          </div>


          <div class="mt-2 flex flex-grow flex-row flex-wrap">

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Graph Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h class="font-bold uppercase text-gray-600">Graph</h>
                </div>
                <div class="p-5">
                  <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                  <script>
                    new Chart(document.getElementById("chartjs-7"), {
                      "type": "bar",
                      "data": {
                        "labels": ["January", "February", "March", "April"],
                        "datasets": [{
                          "label": "Page Impressions",
                          "data": [10, 20, 30, 40],
                          "borderColor": "rgb(255, 99, 132)",
                          "backgroundColor": "rgba(255, 99, 132, 0.2)"
                        }, {
                          "label": "Adsense Clicks",
                          "data": [5, 15, 10, 30],
                          "type": "line",
                          "fill": false,
                          "borderColor": "rgb(54, 162, 235)"
                        }]
                      },
                      "options": {
                        "scales": {
                          "yAxes": [{
                            "ticks": {
                              "beginAtZero": true
                            }
                          }]
                        }
                      }
                    });
                  </script>
                </div>
              </div>
              <!--/Graph Card-->
            </div>

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Graph Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                </div>
                <div class="p-5">
                  <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                  <script>
                    new Chart(document.getElementById("chartjs-0"), {
                      "type": "line",
                      "data": {
                        "labels": ["January", "February", "March", "April", "May", "June", "July"],
                        "datasets": [{
                          "label": "Views",
                          "data": [65, 59, 80, 81, 56, 55, 40],
                          "fill": false,
                          "borderColor": "rgb(75, 192, 192)",
                          "lineTension": 0.1
                        }]
                      },
                      "options": {}
                    });
                  </script>
                </div>
              </div>
              <!--/Graph Card-->
            </div>

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Graph Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                </div>
                <div class="p-5">
                  <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                  <script>
                    new Chart(document.getElementById("chartjs-1"), {
                      "type": "bar",
                      "data": {
                        "labels": ["January", "February", "March", "April", "May", "June", "July"],
                        "datasets": [{
                          "label": "Likes",
                          "data": [65, 59, 80, 81, 56, 55, 40],
                          "fill": false,
                          "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                          "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                          "borderWidth": 1
                        }]
                      },
                      "options": {
                        "scales": {
                          "yAxes": [{
                            "ticks": {
                              "beginAtZero": true
                            }
                          }]
                        }
                      }
                    });
                  </script>
                </div>
              </div>
              <!--/Graph Card-->
            </div>

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Graph Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                </div>
                <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                  <script>
                    new Chart(document.getElementById("chartjs-4"), {
                      "type": "doughnut",
                      "data": {
                        "labels": ["P1", "P2", "P3"],
                        "datasets": [{
                          "label": "Issues",
                          "data": [300, 50, 100],
                          "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                        }]
                      }
                    });
                  </script>
                </div>
              </div>
              <!--/Graph Card-->
            </div>

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Table Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                </div>
                <div class="p-5">
                  <table class="w-full p-5 text-gray-700">
                    <thead>
                      <tr>
                        <th class="text-left text-blue-900">Name</th>
                        <th class="text-left text-blue-900">Side</th>
                        <th class="text-left text-blue-900">Role</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td>Obi Wan Kenobi</td>
                        <td>Light</td>
                        <td>Jedi</td>
                      </tr>
                      <tr>
                        <td>Greedo</td>
                        <td>South</td>
                        <td>Scumbag</td>
                      </tr>
                      <tr>
                        <td>Darth Vader</td>
                        <td>Dark</td>
                        <td>Sith</td>
                      </tr>
                    </tbody>
                  </table>

                  <p class="py-2"><a href="#">See More issues...</a></p>

                </div>
              </div>
              <!--/table Card-->
            </div>

            <div class="w-full p-6 md:w-1/2 xl:w-1/3">
              <!--Advert Card-->
              <div class="rounded-lg border-transparent bg-white shadow-xl">
                <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 uppercase text-gray-800">
                  <h2 class="font-bold uppercase text-gray-600">Advert</h2>
                </div>
                <div class="p-5 text-center">


                  <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CK7D52JJ&placement=wwwtailwindtoolboxcom" id="_carbonads_js"></script>


                </div>
              </div>
              <!--/Advert Card-->
            </div>


          </div>
        </div>
      </section>
    </div>
  </main>




  <script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
      document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
      var input, filter, ul, li, a, i;
      input = document.getElementById(myDropMenuSearch);
      filter = input.value.toUpperCase();
      div = document.getElementById(myDropMenu);
      a = div.getElementsByTagName("a");
      for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
          a[i].style.display = "";
        } else {
          a[i].style.display = "none";
        }
      }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
        var dropdowns = document.getElementsByClassName("dropdownlist");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (!openDropdown.classList.contains('invisible')) {
            openDropdown.classList.add('invisible');
          }
        }
      }
    }
  </script>


</body>

</html>
