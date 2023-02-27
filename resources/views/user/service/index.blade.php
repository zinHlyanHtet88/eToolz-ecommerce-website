@extends('welcome')

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="">How It Works</div>
    <h4 class="fw-bold " style="color: blue;margin-top: 20px;">When You Buy Online</h4>
    <hr class="container" style="margin-bottom: 50px;border: 1px solid #D3D3D3">
    <div class="row gap-4">
        <div class=" col border border-1 rounded px-3 py-4" style="background-color: #fefefe">
            <h6 class="mb-2">Digital Payment Options</h6>
            <p class="text-muted" style="font-size: 12px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus neque odio ipsam porro repellendus voluptate labore consequuntur, quisquam et obcaecati. Dolorem accusamus aliquam minima laudantium facilis repudiandae, non consequatur dolores.</p>
            <a href="">See More</a>

        </div>
        <div class=" col border border-1 rounded px-3 py-4">
            <h6>Delivery</h6>
            <p class="text-muted " style="font-size: 12px;margin-bottom: 50px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Necessitatibus, maxime esse culpa cum neque qui error nostrum modi, odit.</p>
            <a href="" >Read more about delivery policy</a>
        </div>
        <div class="col border border-1 rounded px-3 py-4">
            <h6>After Sale Services</h6>
            <p class="text-muted" style="font-size: 12px">Apple official warranty = 2 years warranty + Factory fault will be replaced with new device within 7 days.</p>
        </div>
    </div>
</div>
@endsection
