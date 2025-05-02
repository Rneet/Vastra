@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/600x400" class="img-fluid" alt="{{ $product['name'] }}">
            </div>
            <div class="row mt-3">
                <div class="col-3">
                    <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Thumbnail">
                </div>
                <div class="col-3">
                    <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Thumbnail">
                </div>
                <div class="col-3">
                    <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Thumbnail">
                </div>
                <div class="col-3">
                    <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Thumbnail">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h2 mb-3">{{ $product['name'] }}</h1>
                    <div class="mb-3">
                        <span class="text-primary h3">${{ number_format($product['price'], 2) }}</span>
                        <span class="text-muted ms-2"><del>${{ number_format($product['price'] * 1.2, 2) }}</del></span>
                        <span class="badge bg-success ms-2">20% OFF</span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="text-warning me-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-muted">(24 reviews)</span>
                        </div>
                    </div>
                    <p class="mb-4">{{ $product['description'] }}</p>
                    
                    <div class="mb-4">
                        <h5>Select Color</h5>
                        <div class="d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="color" id="color1" checked>
                                <label class="form-check-label" for="color1">Black</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="color" id="color2">
                                <label class="form-check-label" for="color2">White</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="color" id="color3">
                                <label class="form-check-label" for="color3">Blue</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Select Size</h5>
                        <select class="form-select">
                            <option selected>Select Size</option>
                            <option value="s">Small</option>
                            <option value="m">Medium</option>
                            <option value="l">Large</option>
                            <option value="xl">Extra Large</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Quantity</h5>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button">-</button>
                            <input type="text" class="form-control text-center" value="1">
                            <button class="btn btn-outline-secondary" type="button">+</button>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg">Add to Cart</button>
                        <button class="btn btn-outline-secondary btn-lg">Add to Wishlist</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mt-5">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Specifications</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <h4>Product Description</h4>
                    <p>{{ $product['description'] }}</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl.</p>
                    <p>Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl.</p>
                </div>
                <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    <h4>Product Specifications</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Brand</th>
                                <td>Brand Name</td>
                            </tr>
                            <tr>
                                <th scope="row">Material</th>
                                <td>Premium Quality</td>
                            </tr>
                            <tr>
                                <th scope="row">Dimensions</th>
                                <td>10 x 15 x 5 inches</td>
                            </tr>
                            <tr>
                                <th scope="row">Weight</th>
                                <td>2.5 lbs</td>
                            </tr>
                            <tr>
                                <th scope="row">Warranty</th>
                                <td>1 Year</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <h4>Customer Reviews</h4>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning me-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="h5 mb-0">4.5 out of 5</span>
                        </div>
                        <p>Based on 24 reviews</p>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title">Great product!</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">By John Doe on March 15, 2023</h6>
                            <p class="card-text">This product exceeded my expectations. The quality is excellent and it works perfectly for what I needed.</p>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title">Good value for money</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">By Jane Smith on February 28, 2023</h6>
                            <p class="card-text">I'm very satisfied with this purchase. It's not perfect but definitely worth the price.</p>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title">Decent product</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">By Mike Johnson on January 10, 2023</h6>
                            <p class="card-text">It's a decent product but there's room for improvement. The material could be better quality.</p>
                        </div>
                    </div>
                    
                    <h5>Write a Review</h5>
                    <form>
                        <div class="mb-3">
                            <label for="reviewRating" class="form-label">Rating</label>
                            <select class="form-select" id="reviewRating">
                                <option value="5">5 Stars - Excellent</option>
                                <option value="4">4 Stars - Good</option>
                                <option value="3">3 Stars - Average</option>
                                <option value="2">2 Stars - Poor</option>
                                <option value="1">1 Star - Very Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reviewTitle" class="form-label">Review Title</label>
                            <input type="text" class="form-control" id="reviewTitle">
                        </div>
                        <div class="mb-3">
                            <label for="reviewContent" class="form-label">Review</label>
                            <textarea class="form-control" id="reviewContent" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
