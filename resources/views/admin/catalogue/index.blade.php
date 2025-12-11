{{-- @extends('layout.master')
@section('title', 'catalogue')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($allproducts as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100" style="width: 18rem;">
                <img src="{{asset('storage/' . $product->picture)}}" class="card-img-top" alt="{{ $product->name }}" style="height: 210px; object-fit: cover">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Category: {{$product->category}}</li>
                    <li class="list-group-item">Description: {{$product->description}}</li>
                </ul>
                <div class="card-body d-flex justify-content-between">
                    <a href="{{route('admin.detail', $product->id)}}" class="btn btn-primary">Check</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}


@extends('layout.master')
@section('title', 'catalogue')
@section('content')

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: #000;
        background-image: url("../../../assets/images/shade.png");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top center; /* penting biar ga ada gap di atas */
        font-family: Arial, sans-serif;
      }

      :root {
        --For-Font: linear-gradient(
          180deg,
          #716c66 -18.71%,
          #dba890 42.11%,
          #ffe4c7 99.67%
        );
      }

      h1 {
        padding-bottom: 30px;
        background: var(--For-Font);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-align: center;
        margin: 0;
        padding-top: 12vh;
        font-size: 32px;
      }

      .tool-card {
        margin: 25px auto;
        width: 550px;
        margin-top: 24px;
        padding: 16px 20px;
        border-radius: 18px;
        background: linear-gradient(90deg, #363636 0%, #141313 100%);
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.65);
        color: #ffffff;
      }

      .tool-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 13px;
      }

      .tool-info span {
        display: block;
      }
      
      .empty-message {
        color: white;
        text-align: center;
        font-size: 18px;
        padding: 60px 20px;
        margin-top: 40px;
      }

      .tool-check-btn {
        padding: 10px 24px;
        border-radius: 999px;
        border: none;
        background: #f6cfad;
        color: #2c1a14;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease,
          background 0.15s ease;
        white-space: nowrap;
      }

      .tool-check-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.4);
        background: #f9d8bb;
      }

      .tool-check-btn:active {
        transform: translateY(0);
        box-shadow: none;
      }
    </style>
  </head>
  <body>
    <header>
      <!-- navbar -->
    </header>

    <main class="bg-shade">
      <section>
        <h1>Requested Tools</h1>
      </section>

    @if(!$allproducts->isEmpty())

        @foreach ($allproducts as $product)
        
        <section>
            <div class="tool-card">
            <div class="tool-info">
                <span>Tool Name: {{$product->name}}</span>
                <span>Date Sent: {{ $product->created_at->format('M d, Y') }}</span>
                <span>Author: {{$product->user->name}}</span>
            </div>

            <a href="{{ route('admin.detail', $product->id) }}" class="tool-check-btn">CHECK</a>
            </div>
        </section>

        @endforeach
    @else
        <p class="empty-message">No tools requested.</p>
    @endif

    <footer>
      <!-- footer -->
    </footer>
  </body>
</html>

@endsection