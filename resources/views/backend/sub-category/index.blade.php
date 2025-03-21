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
											<a href="{{ route('sub-category.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Sub Category List</li>
									</ol>
								</nav>

								<a href="{{ route('sub-category.create') }}" class="btn btn-primary px-5 radius-30">+ Add Sub Category</a>
							</div>

                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product Category</th>
                            <th>Product Sub Category</th>
                            <th>Sub Category Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                              @foreach ($sub_categories as $category_name => $grouped_sub_categories)
                                  @foreach ($grouped_sub_categories as $key => $sub_category)
                                      <tr data-category="{{ $category_name }}">
                                          <td>{{ $loop->iteration }}</td> 
                                          <td>{{ $category_name }}</td> 
                                          <td>{{ $sub_category->sub_category_name }}</td>
                                          <td>
                                              @if ($sub_category->image)
                                                  <img src="{{ asset('/uploads/sub-category/' . $sub_category->image) }}" alt="Sub Category Image" width="50" height="50">
                                              @else
                                                  No Image
                                              @endif
                                          </td>
                                          <td>
                                              <a href="{{ route('sub-category.edit', $sub_category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                              <form action="{{ route('sub-category.destroy', $sub_category->id) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                              </form>
                                          </td>
                                      </tr>
                                  @endforeach
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