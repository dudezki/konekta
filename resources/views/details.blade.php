@extends('layout')
@section('title', 'Product Details')
@section('content')
    <style>
        @font-face {
            font-family: 'Montserrat';
            src: url('{{ asset("fonts/Montserrat-Regular.otf") }}') format('opentype');
        }

        @font-face {
            font-family: 'Montserrat-Bold';
            src: url('{{ asset("fonts/Montserrat-Bold.otf") }}') format('opentype');
        }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 5% 5% 20px;
            width: 90%;
        }

        footer {
            background: #f8f9fa;
            padding: 50px 5%;
            margin-top: auto;
            width: 100%;
            box-sizing: border-box;
        }


        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 0.9rem;
        }

        .container {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            margin-bottom: 20px;
            min-height: 100%;
        }
        
        .content{
            flex: 1;
        }

        .product-img {
            width: 500px;
            text-align: left;
            position: relative;
        }

        .product-img img {
            width: 500px;
            height: auto;
            border-radius: 8px;
        }

        .product-info {
            width: 500px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            position: sticky;
            top: 20px;
        }

        .merchant-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            padding: 0;
            border: none;
            width: 100%;
            max-width: 100%;
        }

        .merchant-avatar {
            width: 100px !important;
            height: 100px !important;
            border-radius: 50% !important;
            object-fit: cover;
        }

        .merchant-details {
            flex-grow: 1;
        }

        .merchant-name {
            font-size: 0.8rem;
            color: #666;
            margin: 0;
        }

        .business-section {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .business-name {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: #333;
        }

        .merchant-actions {
            display: flex;
            gap: 8px;
        }

        .reviews-section {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 100px; /* Add space between reviews and footer */
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .reviews-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin: 0;
            background: #e8f4ff;
            padding: 8px 20px;
            border-radius: 20px;
        }

        .review-sort {
            position: relative;
            display: inline-block;
        }

        .sort-button {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .review-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
        }

        .reviewer-avatar {
            width: 60px !important;
            height: 60px !important;
            border-radius: 50% !important;
            object-fit: cover;
        }

        .review-content-wrapper {
            flex-grow: 1;
        }

        .reviewer-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .review-rating {
            color: #ffd700;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .review-text {
            color: #444;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .review-actions {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .review-action-btn {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            padding: 0;
        }

        .review-action-btn:hover {
            color: #333;
        }

        .review-action-btn i {
            font-size: 1.1rem;
        }

        .review-action-count {
            color: #666;
        }

        .review-action-btn.liked {
            color: #2ecc71;
        }

        .review-action-btn.disliked {
            color: #e74c3c;
        }

        .review-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .review-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 10px 0;
            min-height: 100px;
            font-family: inherit;
        }

        .review-form button {
            background: #2b9348;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .review-form button:hover {
            background: #238636;
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            font-size: 1.5rem;
            cursor: pointer;
            color: #ddd;
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: #ffd700;
        }

        .view-shop-btn {
            background-color: #3498db;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            height: 40px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background: white;
            color: #333;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .action-btn:hover, .view-shop-btn:hover {
            opacity: 0.9;
        }

        .quantity-selector {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 15px 0;
            font-size: 16px;
            appearance: none;
            background: url("data:image/svg+xml,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='%23000000' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>") no-repeat;
            background-position: calc(100% - 12px) center;
            background-color: white;
        }

        .product-description{
            width: 500px;
        }
        
        .merchant-info {
            width: 100%;
            max-width: 100%;
        }

        .rating {
            display: flex;
            flex-direction: row;
            margin-bottom: 10px;
        }

        .star {
            font-size: 2rem;
            cursor: pointer;
            color: gray;
        }
        
        .btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: darkgreen;
        }
    </style>    

    <main>
        <section class="container"> 
            <div class="product-img">
                <img src="{{ asset('images/' . $product->image) }}">
                <div class="product-description">
                    <p>{{$product->description}}</p>
                </div>
                <div class="merchant-info">
                    <img src="{{ asset('images/prof pic.jpg') }}" alt="Merchant Avatar" class="merchant-avatar">
                    <div class="merchant-details">
                        <p class="merchant-name">Product by:</p>
                        <div class="business-section">
                            <p class="business-name">{{ $product->merchant->business_name ?? 'Juhan' }}</p>
                            <a href="{{ route('seller.profile', ['id' => $product->merchant_id]) }}" class="view-shop-btn">
                                <i class="fas fa-store"></i> View Shop
                            </a>
                        </div>
                        <div class="merchant-actions">
                            <button class="action-btn">
                                <i class="fas fa-comment"></i> Chat
                            </button>
                            <button class="action-btn">
                                <i class="fas fa-share-alt"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h2>1KG Fresh {{$product->name}} from Cabanbanan Oton, Iloilo</h2>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <h1><strong>₱{{$product->price}}</strong></h1>
            
                <form action="{{ route('cart.add.post', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3 form-group">
                        <select name="quantity" id="quantity" class="quantity-selector">
                            <option value="" disabled selected>Select Quantity</option>
                            @for ($i = 1; $i <= $product->stock; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn mb-3">+ Add to Cart</button>
                </form>
                <button class="btn">Buy Now</button>

                @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
            </div>
        </section>
    </main>

    <section class="reviews-section">
        <div class="reviews-header">
            <h3 class="reviews-title">Reviews</h3>
            <div class="review-sort">
                <button class="sort-button">
                    Latest <i class="fas fa-chevron-down"></i>
                </button>
            </div>
        </div>

        @auth
            @if(!auth()->user()->is_merchant)
                <div class="review-form" id="reviewForm" style="display: none;">
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="rating-input">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5">★</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4">★</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3">★</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2">★</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1">★</label>
                        </div>
                        <textarea name="comment" placeholder="Share your experience with this product..." required></textarea>
                        <button type="submit">Submit Review</button>
                    </form>
                </div>
            @endif
        @endauth

        @foreach($product->reviews as $review)
            <div class="review-item">
                <img src="{{ asset('images/avatar.png') }}" alt="{{ $review->user->name }}" class="reviewer-avatar">
                <div class="review-content-wrapper">
                    <div class="reviewer-name">{{ $review->user->name }}</div>
                    <div class="review-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <div class="review-text">
                        {{ $review->comment }}
                    </div>
                    <div class="review-actions">
                        <button class="review-action-btn" onclick="handleReviewAction('like', {{ $review->id }})">
                            <i class="far fa-thumbs-up"></i>
                            <span class="review-action-count" id="like-count-{{ $review->id }}">
                                {{ $review->likes_count ?? 0 }}
                            </span>
                        </button>
                        <button class="review-action-btn" onclick="handleReviewAction('dislike', {{ $review->id }})">
                            <i class="far fa-thumbs-down"></i>
                            <span class="review-action-count" id="dislike-count-{{ $review->id }}">
                                {{ $review->dislikes_count ?? 0 }}
                            </span>
                        </button>
                        <button class="review-action-btn">
                            <i class="far fa-comment"></i> Reply
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        function toggleReviewForm() {
            const form = document.getElementById('reviewForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                let value = this.getAttribute('data-value');
                document.querySelectorAll('.star').forEach(s => {
                    s.style.color = s.getAttribute('data-value') <= value ? 'gold' : 'gray';
                });
            });
        });

        function handleReviewAction(action, reviewId) {
            if (!document.cookie.includes('laravel_session')) {
                window.location.href = '{{ route("login") }}';
                return;
            }

            fetch(`/reviews/${reviewId}/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const countElement = document.getElementById(`${action}-count-${reviewId}`);
                    countElement.textContent = data.count;
                    
                    const button = countElement.parentElement;
                    if (data.userAction) {
                        button.classList.add(action === 'like' ? 'liked' : 'disliked');
                    } else {
                        button.classList.remove(action === 'like' ? 'liked' : 'disliked');
                    }
                }
            });
        }
    </script>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
