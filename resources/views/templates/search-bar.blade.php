   <!-- search bar -->
   <div class="container mt-5 d-flex justify-content-end">
       <div class="input-group search-bar">
           <input type="text" class="form-control" placeholder="Cari produk favoritmu disini..." />
           <button class="btn btn-secondary" type="button">
               <i class="fa-solid fa-magnifying-glass"></i>
           </button>
       </div>
       <div class="ms-4 my-auto shopping text-dark">
           <a href="{{url('/shopping-cart')}}">
               <i class="fa-solid fa-bag-shopping h2 text-dark rm my-auto"></i>

           </a>
       </div>
   </div>