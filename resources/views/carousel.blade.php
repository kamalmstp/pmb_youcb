<div class="content pt-2 mb-2">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($slider as $i => $item)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i==0 ? 'active' : '' }}"></li>
                @endforeach                    
            </ol>
            <div class="carousel-inner">
                @foreach ($slider as $i => $item)
                    <div class="carousel-item {{ $i==0 ? 'active' : '' }}">
                        <img class="d-block w-100 rounded " src="{{ asset('slider/'.$item->gambar) }}" alt="First slide">
                    </div>      
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

