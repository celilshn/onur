<!DOCTYPE html>
<html lang="en">

<head>
    @include("head")
</head>

<body>

<!-- ======= Header ======= -->
@include("main.header")
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include("sidebar")
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ameliyatlar</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ameliyat Ekle</h5>

                    <!-- Primary Color Bordered Table -->
                    <form method="POST" action="{{route('addOperation')}}">
                        @csrf
                        <div>
                            <label for="inputText" >Text</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </form>
                    <!-- End Primary Color Bordered Table -->

                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ameliyatlar</h5>
                    <!-- Primary Color Bordered Table -->
                    <table class="table table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr id="tr{{$item->id}}">
                                <th scope="row">{{$item->id}}</th>
                                <th scope="row">{{$item->name}}</th>
                                <th scope="row"><button type="button" onclick="deleteOperation({{$item->id}})" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button></th>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Primary Color Bordered Table -->

                </div>
            </div>
        </div>

    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include("footer")
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@include("scripts")
<script>
    function deleteOperation(id){
        $.ajax({
            type: "DELETE",
            url: '{{route('deleteOperation')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (response) {
              console.log(response)
                if (response.status){
                    $('#tr'+id).remove()
                }
            },
            data: {
                id:id
            },
        });
        console.log(id)
    }
</script>

</body>

</html>
