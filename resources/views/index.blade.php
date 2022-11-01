<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('Css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('Css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Css/style.css')}}">
</head>

<body class="bg-light">
    <div class="container my-5 ">
        <div class="w-50 m-auto shadow h-100 bg-white p-5 rounded ">
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="u-name mb-4">
                    <label for="ProductName">ProductName:</label>
                    <input name="productName" id="ProductName" type="text" class="form-control">
                    <p id="alert" class="alert alert-danger p-0 text-center" style="display:none;"></p>
                </div>

                <label for="ProductCategory">ProductCategory:</label>
                <input name="productCategory" id="ProductCategory" type="text" class="form-control mb-4">

                <label for="ProductPrice">ProductPrice:</label>
                <input name="productPrice" id="ProductPrice" type="text" class="form-control mb-4">

                <label for="ProductDescription">ProductDescription:</label>
                <textarea name="productDescription" name="ProductDescription" id="ProductDescription" class="form-control mb-4" cols="30" rows="5"></textarea>
                <button id="setData" class="btn btn-info mt-4">Add Product</button>
            </form>
        </div>
    </div>

    <div class="container">

        <form class="d-flex justify-content-center" action="{{route('product.search')}}" method="GET">
            <input id="search" name="search" class="form-control w-25" type="text" class="form-control mb-4" placeholder="search...">
            <button class="btn btn-warning ml-1">Search</button>
        </form>

        <table class="table table-hover my-5 text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>description</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->productName}}</td>
                    <td>{{$product->productCategory}}</td>
                    <td>{{$product->productPrice}}$</td>
                    <td>{{$product->productDescription}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$product->id}}">
                            Update
                        </button>

                        <!-- Modal -->
                        <div class="modal fade text-left" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action='{{url("/product/update/$product->id")}}' method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="u-name mb-4">
                                                <label for="ProductName">ProductName:</label>
                                                <input name="productName" value="{{$product->productName}}" id="ProductName" type="text" class="form-control">
                                                <p id="alert" class="alert alert-danger p-0 text-center" style="display:none;"></p>
                                            </div>

                                            <label for="ProductCategory">ProductCategory:</label>
                                            <input name="productCategory" value="{{$product->productCategory}}" id="ProductCategory" type="text" class="form-control mb-4">

                                            <label for="ProductPrice">ProductPrice:</label>
                                            <input name="productPrice" id="ProductPrice" value="{{$product->productPrice}}" type="text" class="form-control mb-4">

                                            <label for="ProductDescription">ProductDescription:</label>
                                            <textarea  name="ProductDescription" id="ProductDescription" class="form-control mb-4" cols="30" rows="5">{{$product->productDescription}}</textarea>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                <button type="submit" class="btn btn-info">Update Change</button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </td>
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="{{asset('JS/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="{{asset('JS/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('JS/main.js')}}"></script>
</body>

</html>