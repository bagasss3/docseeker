       <!-- navbar  -->
       <div id="topheader" class="container d-flex justify-content-between mt-4 navbar__nav" id="menu">
           <a href="" class="text-white my-auto nav__menu h6" data-target="shop-brand">
               SHOP BY BRAND
           </a>
           <a href="{{ url('/product/?category=women') }}" class="text-white my-auto nav__menu h6" data-target="ladies"
               data-locations="category=women">
               LADIES
           </a>
           <a href="{{ url('/product/?category=men') }}" class="text-white my-auto nav__menu h6" data-target="mens"
               data-locations="category=men">
               MEN’S
           </a>
           <a href="{{ url('/product/?category=bags') }}" class="text-white my-auto nav__menu h6" data-target="bags"
               data-locations="category=bags">
               BAGS
           </a>
           <a href="{{ url('/') }}" class="my-auto nav__menu active" data-intersection="welcome">
               <img src="{{url('../assets/img/Logo.png')}}" alt="" height="48px" />
           </a>

           <a href="{{ url('/product/?category=shoes') }}" class="text-white my-auto nav__menu h6" data-target="shoes"
               data-locations="category=shoes">
               SHOES
           </a>
           <a href="{{ url('/product/?category=glasses') }}" class="text-white my-auto nav__menu h6"
               data-target="sunglasses" data-locations="category=glasses">
               SUNGLASSES
           </a>
           <a href="" class="text-white my-auto nav__menu h6" data-target="sale">
               SALE
           </a>
           @auth
               <form action="/logout" method="post" class="my-auto">
                   @csrf
                   <div class="dropdown ">
                       <a class="text-white " type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                           aria-expanded="false">
                           <i class="fa-solid fa-user h3"></i>
                       </a>
                       <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                           <li>
                               <a class="dropdown-item" type="button" href={{ url('/profile') }}>Profile</a>
                           </li>
                           <li>
                               <a class="dropdown-item" type="button" href={{ url('/address') }}>Daftar Alamat</a>
                           </li>
                           <li>
                               <button type="submit" class="dropdown-item">Logout</button>
                           </li>
                       </ul>
                   </div>

               </form>
           @else
               <a href="{{ url('/login') }}" class="text-white my-auto">
                   <i class="fa-solid fa-user h3"></i>
               </a>
           @endauth
       </div>
