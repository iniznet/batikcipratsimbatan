<!-- Product Card -->
<div class="flex flex-col duration-300 shadow-md cursor-pointer hover:-translate-y-1">
  <!-- Preview -->
  <div class="relative inline h-48 group">
      <!-- Thumbnail -->
      <img class="absolute object-cover w-full h-full rounded-t"
          src="https://images.unsplash.com/photo-1627384113858-ce93ff568d1f?auto=format&fit=crop&w=1170&q=80"
          alt="Product Preview" />

          <!-- Hover Bar -->
          <div class="absolute bottom-0 flex flex-row justify-end w-full h-16 px-3 space-x-2 transition-all duration-200 ease-in-out delay-100 opacity-0 bg-none group-hover:opacity-100 group-hover:bg-gradient-to-t from-black/20 via-gray-800/20 to-transparent">

              <!-- Add to Bookmarks Button -->
              <button class="px-1 my-auto transition-colors duration-200 rounded-full bg-gray-50/10 h-9 w-9 hover:bg-gray-50/20">
                  <i class="text-xl text-gray-200 transition-all duration-200 mdi mdi-playlist-plus hover:text-white"
                      title="Add to Bookmarks"></i>
              </button>

              <!-- Add to Favorites Button -->
              <button class="px-1 my-auto transition-colors duration-200 rounded-full bg-gray-50/10 h-9 w-9 hover:bg-gray-50/20">
                  <i class="p-1 text-xl text-gray-200 transition-all duration-200 mdi mdi-heart hover:text-white"
                      title="Add to Favorites"></i>
              </button>
          </div>
  </div>

  <!-- Body -->
  <div class="flex flex-col p-3 bg-white rounded-b">
      <!-- Title -->
      <div class="text-sm font-semibold text-gray-900 truncate hover:underline">
          Awesome Fantastic Super Uber Harika Merveilleux Pro Ultra Max Plus Plus Makeup Stuff
      </div>

      <!-- Author - Category -->
      <div class="mt-1 text-gray-400 truncate text-xxs">
          by

          <!-- Author -->
          <a class="font-semibold hover:underline"> EgoistDeveloper </a>

          in
          <!-- Category -->
          <a class="font-semibold hover:underline"> e-commerce </a>
      </div>

      <!-- Price -->
      <div class="mt-4 mb-1 text-sm font-bold text-gray-600">
          $23
      </div>

      <!-- Body -->
      <div class="flex flex-row mt-2">
          <!-- Detail Column -->
          <div class="flex flex-col flex-auto">
              <!-- Rating -->
              <div class="flex flex-row group">
                  <i class="text-xs transition-all duration-200 mdi mdi-star text-amber-400 hover:text-amber-500"
                      title="Worst"></i>

                  <i class="text-xs transition-all duration-200 mdi mdi-star text-amber-400 hover:text-amber-500"
                      title="Bad"></i>

                  <i class="text-xs transition-all duration-200 mdi mdi-star text-amber-400 hover:text-amber-500"
                      title="Not Bad"></i>

                  <i class="text-xs transition-all duration-200 mdi mdi-star text-amber-400 hover:text-amber-500"
                      title="Good"></i>

                  <i class="text-xs transition-all duration-200 mdi mdi-star text-amber-400 hover:text-amber-500"
                      title="Awesome"></i>

                  <div class="ml-1 text-gray-400 text-xxs hover:underline">
                      (45)
                  </div>
              </div>

              <!-- Statistic -->
              <div class="mt-1 text-gray-400 text-xxs" title="34k Downlaods in this year">
                  34k Downloads
              </div>
          </div>

          <!-- Button Column -->
          <div class="flex flex-row justify-end flex-auto">
              <!-- Cart Button -->
              <a class="flex px-3 py-2 my-auto mr-2 text-xs transition-all duration-200 border border-amber-500 group hover:bg-amber-500 rounded-xss">

                  <!-- Icon -->
                  <i class="delay-100 mdi mdi-cart-outline text-amber-700 group-hover:text-white"></i>
              </a>

              <!-- Preview Link Button -->
              <a class="flex px-3 py-2 my-auto text-xs transition-all duration-200 border border-amber-500 group hover:bg-amber-500 rounded-xss">

                  <!-- Icon -->
                  <i class="delay-100 mdi mdi-eye-outline text-amber-700 group-hover:text-white"></i>
              </a>
          </div>
      </div>
  </div>
</div>
