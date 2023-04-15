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



    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Karne</h5>

                    <!-- Primary Color Bordered Table -->
                    <table class="table table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ameliyat</th>
                            <th scope="col">Girişler</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data["data"] as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->getOperation->name}}</td>
                                <td>{{$item->getSurgeons()->count()}}
                                    <button type="button" onclick="showSurgeons({{$item->id}})"
                                            class="btn btn-info btn-sm ms-2">Detay
                                    </button>
                                </td>
                                <td>
                                    <button type="button" onclick="addSurgeonToOperation({{$item->id}})"
                                            class="btn btn-success"><i class="bi bi-check-circle"></i>
                                    </button>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <!-- End Primary Color Bordered Table -->

                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="addSurgeonToOperationModal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ameliyat Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('addSurgeonToSectorOperation')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row-mb-3">
                            <input type="number" hidden name="sector_operation_id">

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Cerrah</label>
                            <div class="col-sm-10">
                                <select style="width: 100%" class="select2 form-select" name="surgeon_id">
                                    @foreach($data["surgeons"] as $surgeon)
                                        <option value="{{$surgeon->id}}">{{$surgeon->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    <div class="modal fade " id="showSurgeonsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Girişler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @csrf
                <div class="modal-body">
                    <table class="table table-bordered border-primary">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Giriş Yapan Cerrah</th>
                            <th>Zaman</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table_body_surgeons">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include("footer")
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@include("scripts")
<script>
    function addSurgeonToOperation(sector_operation_id) {
        $("[name='sector_operation_id']").val(sector_operation_id);
        $('#addSurgeonToOperationModal').modal('show');
    }

    function showSurgeons(sector_operation_id) {
        getSurgeonsWithSectorOperationId(sector_operation_id);
    }
</script>
<script>
    function getSurgeonsWithSectorOperationId(id) {
        $.ajax({
            type: "GET",
            url: '{{route('getSurgeonsWithSectorOperationId')}}',
            data: {
                id: id
            },
            success: function (response) {

                makeTableFromResponse(response);
                $('#showSurgeonsModal').modal('show');
            }
        });
        console.log(id)
    }

    function makeTableFromResponse(response) {
        $('#table_body_surgeons').children().remove();
        var text = "";
        for (let i = 0; i < response.length; i++) {
            text += "<tr id='surgeon_row_" + response[i].id + "'>";
            text += "<th>" + response[i].id + "</th>";
            text += "<th>" + response[i].surgeon + "</th>";
            text += "<th>" + response[i].date.date + "</th>";
            text += '<th scope="row"><button type="button" onClick="deleteSurgeonFromSectorOperation(' + response[i].id + ')" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button></th>';
            text += "</tr>";
        }
        console.log(text);
        $('#table_body_surgeons').append(text);
    }

    function deleteSurgeonFromSectorOperation(sector_operation_user_id) {
        $.ajax({
            type: "DELETE",
            url: '{{route('deleteSurgeonFromSectorOperation')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response)
                if (response.status) {
                    $('#surgeon_row_' + sector_operation_user_id).remove()
                    location.reload();

                }
            },
            data: {
                id: sector_operation_user_id
            },
        });
        console.log(sector_operation_user_id);

    }

</script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
</body>

</html>
