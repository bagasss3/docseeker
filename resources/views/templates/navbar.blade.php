       <!-- navbar  -->
       <div class="container d-flex justify-content-between mt-4">
           <a href="" class="text-white my-auto">
               <h6 class="">SHOP BY BRAND</h6>
           </a>
           <a href="{{url('/product/?category=women')}}" class="text-white my-auto">
               <h6 class="">LADIES</h6>
           </a>
           <a href="{{url('/product/?category=men')}}" class="text-white my-auto">
               <h6 class="">MEN’S</h6>
           </a>
           <a href="{{url('/product/?category=bags')}}" class="text-white my-auto">
               <h6 class="">BAGS</h6>
           </a>
           <a href="{{url('/')}}" class="my-auto">
               <img src="../assets/img/Logo.png" alt="" height="48px" />
           </a>

           <a href="{{url('/product/?category=shoes')}}" class="text-white my-auto">
               <h6 class="">SHOES</h6>
           </a>
           <a href="{{url('/product/?category=glasses')}}" class="text-white my-auto">
               <h6 class="">SUNGLASSES</h6>
           </a>
           <a href="" class="text-white my-auto">
               <h6 class="">SALE</h6>
           </a>
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{url('/login')}}" class="text-white my-auto">
                    <i class="fa-solid fa-user h3"></i>
                </a>
            @endauth
       </div>