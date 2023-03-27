@extends('layouts.html_structure')

@section('included-css')
<style>
.floating { 
    width: 50vw;
    animation-name: floating;
    animation-duration: 3s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
    /* margin-left: 30px;
    margin-top: 5px; */
}
 
@keyframes floating {
    0% { transform: translate(0,  0px); }
    50%  { transform: translate(0, 15px); }
    100%   { transform: translate(0, -0px); }
}
.big-container{
    position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
}
</style>
@endsection

@section('container')
<div class="container">
    <div class="row big-container">
        <div class="col-6 floating">
            <div class="text-center">
                <img src="{{ url('/img/disconnect.svg') }}" class="img-fluid" alt="...">
            </div>
        </div>
        <div class="col-12 mt-5 text-center">
            <h2 class="text-center fw-bold">Waduh, tujuanmu nggak ada!</h2>
            <a class="btn text-white mt-3" style="background-color: #13542D" href="/login">Kembali</a>
        </div>
    </div>
</div>
@endsection
