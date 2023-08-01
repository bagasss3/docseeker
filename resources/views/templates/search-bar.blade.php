   <!-- search bar -->
   <div class="container mt-5 d-flex justify-content-end">
    <form class="search-bar" action="/search" method="get">
        <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Cari produk favoritmu disini..." />
                <button class="btn btn-secondary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
        </div>
    </form>
       <div class="ms-4 my-auto shopping text-dark">
           <a href="{{url('/shopping-cart')}}">
               <i class="fa-solid fa-bag-shopping h2 text-dark rm my-auto"></i>
           </a>
       </div>
   </div>