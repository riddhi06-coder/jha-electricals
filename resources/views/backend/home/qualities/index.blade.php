<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->

    
     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb mb-0">
										<li class="breadcrumb-item">
											<a href="{{ route('home-quality.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Qualities List</li>
									</ol>
								</nav>

								<a href="{{ route('home-quality.create') }}" class="btn btn-primary px-5 radius-30">+ Add Qualities</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Quality</th>
                            <th>Icons</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($quality as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>{{ $item->quality }}</td> 
                                    <td>
                                        <div style="background-color: black;">
                                            <img src="{{ asset('uploads/home/quality-icons/' . $item->quality_icon) }}" alt="Quality Icon" style="max-width: 50px; height: auto;">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('home-quality.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('home-quality.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>