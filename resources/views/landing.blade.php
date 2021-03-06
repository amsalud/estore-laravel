<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EStore | Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    </head>
    <body>
        <header class="with-background">
            <header>
            @include('partials.nav')
            </header>
            <div class="hero container">
                <div class="hero-copy">
                    <h1>Laravel Ecommerce Demo</h1>
                    <p>Includes multiple products, categories, a shopping cart and a checkout system with Stripe integration.</p>
                    <div class="hero-buttons">
                        <a href="#" class="button-white">Blog Post</a>
                        <a href="#" class="button-white">GitHub</a>
                    </div>
                </div> <!-- end hero-copy -->

                <div class="hero-image">
                    <img src="img/macbook-pro-laravel.png" alt="hero image">
                </div> <!-- end hero-image -->
            </div> <!-- end hero -->
        </header>

        <div class="featured-section">

            <div class="container">
                <h1 class="text-center">Laravel Ecommerce</h1>

                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="text-center button-container">
                    <a href="#" class="button">Featured</a>
                    <a href="#" class="button">On Sale</a>
                </div>

                {{-- <div class="tabs">
                    <div class="tab">
                        Featured
                    </div>
                    <div class="tab">
                        On Sale
                    </div>
                </div> --}}

                <div class="products text-center">
                    @foreach($products as $product)
                    <div class="product">
                        <a href="{{route('shop.show', $product['slug'])}}"><img src="{{$product->getImagePath()}}" alt="product"></a>
                        <a href="{{route('shop.show', $product['slug'])}}"><div class="product-name">{{$product['name']}}</div></a>
                        <div class="product-price">{{$product->getFormattedPrice()}}</div>
                    </div>
                    @endforeach
                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{route('shop.index')}}" class="button">View more products</a>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->

        <div class="blog-section">
            <div class="container">
                <h1 class="text-center">From Our Blog</h1>

                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="blog-posts">
                    @foreach($blogPosts as $blogPost)
                    <div class="blog-post">
                        <a href="{{$blogPost['link']}}" target="_blank"><img src="{{$blogPost['_embedded']['wp:featuredmedia'][0]['source_url']}}" alt="Blog Image"></a>
                        <a href="{{$blogPost['link']}}" target="_blank"><h2 class="blog-title">{{$blogPost['title']['rendered']}}</h2></a>
                        <div class="blog-description">{!! Str::limit($blogPost['content']['rendered'], 300)!!}</div>
                    </div>
                    @endforeach
                </div>
            </div> <!-- end container -->
        </div> <!-- end blog-section -->

        @include('partials.footer')


    </body>
</html>
