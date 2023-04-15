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
                    <h5 class="card-title">Bölüme Ameliyat Ekle</h5>
                    <!-- Primary Color Bordered Table -->
                    <form method="POST" action="{{route('addSectorOperation')}}">
                        @csrf
                        <div class="row">
                            <label for="select2">Bölüm</label>
                            <select class="select2 form-select" name="sector_id">
                                @foreach($data["sectors"] as $sector)
                                    <option value="{{$sector->id}}">{{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-3">
                            <label for="select2">Ameliyat</label>
                            <select class="select2 form-select" name="operation_id_list[]" multiple="multiple">
                                @foreach($data["operations"] as $operation)
                                    <option value="{{$operation->id}}">{{$operation->name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <button class="btn btn-success btn-submit">Submit</button>
                            </div>
                        </div>
                        <!-- End Primary Color Bordered Table -->
                    </form>

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
                            <th scope="col">Bölüm</th>
                            <th scope="col">Ameliyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data["sector_operations"] as $item)
                            <tr id="tr{{$item->id}}">
                                <th scope="row">{{$item->id}}</th>
                                <th scope="row">{{$item->getSector->name}}</th>
                                <th scope="row">{{$item->getOperation->name}}</th>
                                <th scope="row">
                                    <button type="button" onclick="deleteOperation({{$item->id}})"
                                            class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                                </th>
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
    function deleteOperation(id) {
        $.ajax({
            type: "DELETE",
            url: '{{route('deleteOperation')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response)
                if (response.status) {
                    $('#tr' + id).remove()
                }
            },
            data: {
                id: id
            },
        });
        console.log(id)
    }
</script>

</body>

</html>
